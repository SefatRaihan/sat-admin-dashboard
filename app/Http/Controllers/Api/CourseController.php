<?php

namespace App\Http\Controllers\Api;

use App\Models\Exam;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Chapter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class CourseController extends Controller
{
    public static $visiblePermissions = [
        'index' => 'List',
        'create' => 'Create Form',
        'store' => 'Save',
        'show' => 'Details',
        'update' => 'Update',
        'destroy' => 'Delete',
        'getExam' => 'Exam',
        'getLesson' => 'Lesson',
        'getChapter' => 'Chapter'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $course = Course::latest();


        if ($request->filled('search')) {
            $search = $request->search;
            $course->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('duration', 'like', "%{$search}%");
            });
        }

        // Filter soft-deleted exams only if requested
        if ($request->has('with_deleted') && $request->with_deleted == true) {
            $exams = $exams->withTrashed();
        }

        $perPage = $request->get('per_page', 10);
        $courses = $course->paginate($perPage);

        return response()->json($courses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'audience'          => 'required|string',
            'sat_course_type'   => 'nullable|string',
            'title'             => 'required|string|max:255',
            'description'       => 'nullable|string|max:1000',
            'exam'              => 'nullable',
            'sat_course_type'   => 'nullable|string',
            'chapters'          => 'required|array',    
            'chapters.*'        => 'exists:chapters,id',
            'lessons'           => 'required|array',
            'lessons.*'         => 'array',
            'lessons.*.*'       => 'exists:lessons,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $validated = $validator->validated();
        DB::beginTransaction();

            $filePath = null;

            if (isset($request->thumbnail)) {
                $uploadedFile = $request->thumbnail;

                $fileName = time() . self::generateCourseCode() . '.' . $uploadedFile->getClientOriginalExtension();
                $filePath = $uploadedFile->storeAs('crouse', $fileName, 'public');
            }

        try {
              // ✅ Create the course
            $course = Course::create([
                'uuid'           => Str::uuid(),
                'code'           => $this->generateCourseCode(),
                'audience'       => $validated['audience'],
                'subject'        => $validated['sat_course_type'] ?? null,
                'title'          => $validated['title'],
                'description'    => $validated['description'] ?? null,
                'exam_id'        => isset($validated['exam']) && is_numeric($validated['exam']) ? (int) $validated['exam'] : null,
                'total_duration' => $request->total_duration ?? null,
                'total_lesson'   => $request->total_lesson ?? null,
                'total_chapter'  => $request->total_chapter ?? null,
                'thumbnail'      => $filePath ?? null,
            ]);

            // ✅ Attach chapters to course
            $course->chapters()->attach($validated['chapters']);

            // ✅ Attach lessons to chapters
            foreach ($validated['chapters'] as $chapterId) {
                $lessonIds = $validated['lessons'][$chapterId] ?? [];

                if (!empty($lessonIds)) {
                    DB::table('chapter_lesson')->upsert(
                        collect($lessonIds)->map(function ($lessonId) use ($chapterId, $course) {
                            return [
                                'course_id' => $course->id,
                                'chapter_id' => $chapterId,
                                'lesson_id' => $lessonId,
                                'updated_at' => now(),
                                'created_at' => now(),
                            ];
                        })->toArray(),
                        ['course_id', 'chapter_id', 'lesson_id'], // composite unique key for upsert
                        ['updated_at'] // columns to update on duplicate
                    );
                }
            }


            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Course creation Successful'
            ], 201);

        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Course creation failed',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }

    public function getExam()
    {
        $exams = Exam::select('id', 'title as text')->get();
        return response()->json($exams);
    }

    public function getChapter()
    {
        $exams = Chapter::select('id', 'title as text')->get();
        return response()->json($exams);
    }

    public function getLesson()
    {
        $exams = Lesson::select('id', 'file_name as text')->get();
        return response()->json($exams);
    }

    public function getLessonByIds(Request $request)
    {
        $idsArray = $request->input('ids', []);

        if (empty($idsArray)) {
            return response()->json([]);
        }

        // Fetch lessons by IDs
        $lessons = Lesson::whereIn('id', $idsArray)->get();
        return response()->json($lessons);
    }

    function generateCourseCode()
    {
        $date = now()->format('Ymd');
        $random = strtoupper(Str::random(4)); // 4-character random code
        return "CRS{$date}{$random}";
    }

}
