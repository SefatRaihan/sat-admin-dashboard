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
use App\Models\LessonUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        'getChapter' => 'Chapter',
        'markComplete' => 'Mark Complete',
        'courseDelete' => 'Delete Course',
        'searchCourses' => 'Search Courses',
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
                  ->orWhere('description', 'like', "%{$search}%");
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
                $filePath = $uploadedFile->storeAs('course', $fileName, 'public');
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
                'total_duration' => isset($request->total_duration) && is_numeric($request->total_duration) ? (int) $request->total_duration : null,
                'total_lesson'   => $request->total_lesson ?? null,
                'total_chapter'  => $request->total_chapter ?? null,
                'thumbnail'      => $filePath ?? null,
                'is_exam_create' => $request->exam_checked ?? false,
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
        $course->load(['chapters']);

        // Manually load lessons by course for each chapter
        foreach ($course->chapters as $chapter) {
            $chapter->setRelation('lessons', $chapter->lessonsByCourse($course->id)->get());
        }

        return response()->json($course);
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
    public function update(Request $request, $courseId)
    {
        $validator = Validator::make($request->all(), [
            'audience'          => 'required|string',
            'sat_course_type'   => 'nullable|string',
            'title'             => 'required|string|max:255',
            'description'       => 'nullable|string|max:1000',
            'exam'              => 'nullable|numeric|exists:exams,id',
            'chapters'          => 'required|array',
            'chapters.*'        => 'exists:chapters,id',
            'lessons'           => 'required|array',
            'lessons.*'         => 'array',
            'lessons.*.*'       => 'exists:lessons,id',
            'total_duration'    => 'nullable|numeric',
            'total_chapter'     => 'nullable|numeric',
            'total_lesson'      => 'nullable|numeric',
            'thumbnail'         => 'nullable|file|mimes:jpeg,png|max:10240', // 10MB max
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();
        $course = Course::findOrFail($courseId);

        DB::beginTransaction();

        try {
            // Handle thumbnail upload
            $filePath = $course->thumbnail;
            if ($request->hasFile('thumbnail')) {
                $uploadedFile = $request->file('thumbnail');
                $fileName = time() . $this->generateCourseCode() . '.' . $uploadedFile->getClientOriginalExtension();
                $filePath = $uploadedFile->storeAs('course', $fileName, 'public');

                // Delete old thumbnail if it exists
                if ($course->thumbnail && Storage::disk('public')->exists($course->thumbnail)) {
                    Storage::disk('public')->delete($course->thumbnail);
                }
            }

            // Update the course details
            $course->update([
                'audience'       => $validated['audience'],
                'subject'        => $validated['sat_course_type'] ?? null,
                'title'          => $validated['title'],
                'description'    => $validated['description'] ?? null,
                'exam_id'        => isset($validated['exam']) && is_numeric($validated['exam']) ? (int) $validated['exam'] : null,
                'total_duration' => isset($validated['total_duration']) && is_numeric($validated['total_duration']) ? (int) $validated['total_duration'] : null,
                'total_lesson'   => isset($validated['total_lesson']) && is_numeric($validated['total_lesson']) ? (int) $validated['total_lesson'] : null,
                'total_chapter'  => isset($validated['total_chapter']) && is_numeric($validated['total_chapter']) ? (int) $validated['total_chapter'] : null,
                'thumbnail'      => $filePath,
                'is_exam_create' => $request->exam_checked ?? false,
            ]);

            // Delete existing chapters and lessons for the course
            DB::table('course_chapter')->where('course_id', $course->id)->delete();
            DB::table('chapter_lesson')->where('course_id', $course->id)->delete();

            // Attach new chapters
            foreach ($validated['chapters'] as $chapterId) {
                DB::table('course_chapter')->insert([
                    'course_id'  => $course->id,
                    'chapter_id' => $chapterId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Attach lessons to chapters
            foreach ($validated['chapters'] as $chapterId) {
                $lessonIds = $validated['lessons'][$chapterId] ?? [];

                if (!empty($lessonIds)) {
                    foreach ($lessonIds as $lessonId) {
                        // Check if the record exists
                        $existingRecord = DB::table('chapter_lesson')
                            ->where('course_id', $course->id)
                            ->where('chapter_id', $chapterId)
                            ->where('lesson_id', $lessonId)
                            ->first();

                        if ($existingRecord) {
                            // Update existing record
                            DB::table('chapter_lesson')
                                ->where('course_id', $course->id)
                                ->where('chapter_id', $chapterId)
                                ->where('lesson_id', $lessonId)
                                ->update(['updated_at' => now()]);
                        } else {
                            // Create new record
                            DB::table('chapter_lesson')->insert([
                                'course_id'  => $course->id,
                                'chapter_id' => $chapterId,
                                'lesson_id'  => $lessonId,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Course updated successfully'
            ], 200);

        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Course update failed',
                'error' => $e->getMessage()
            ], 500);
        }
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
        $exams = Lesson::select('id', 'title as text')->get();
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

    public function markComplete($courseId, $chapterId, $lessonId)
    {
        try {
            $user = Auth::user();
            $lesson = Lesson::findOrFail($lessonId);
            $course = Course::findOrFail($courseId);

            $lessonUser = LessonUser::where('user_id', $user->id)
                ->where('lesson_id', $lesson->id)
                ->where('course_id', $course->id)
                ->where('chapter_id', $chapterId)
                ->first();

            if (!$lessonUser) {
                LessonUser::create([
                    'user_id' => $user->id,
                    'lesson_id' => $lesson->id,
                    'course_id' => $course->id,
                    'chapter_id' => $chapterId,
                    'completed_at' => now(),
                ]);
            }

            $totalLessons = $course->total_lesson;
            $completedLessons = LessonUser::where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->count();

            $progress = round(($completedLessons / $totalLessons) * 100);

            if ($totalLessons == $completedLessons) {
                // Mark course as complete in course_user pivot table
                $user->courses()->syncWithoutDetaching([
                    $course->id => ['is_completed' => true, 'completed_at' => now()]
                ]);
            }

            return response()->json(['status' => 'success', 'message' => 'Lesson marked as complete.', 'progress' => $progress], 200);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function courseDelete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'courses' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $ids = $request->input('courses');
            Course::whereIn('uuid', $ids)->delete();

            return response()->json(['status' => 'success', 'message' => 'Courses deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function searchCourses(Request $request)
    {
        $user = auth()->user();
        $search = $request->query('search', '');
        $audience = $user->student->audience;
        $audienceWithDash = str_replace('-', ' ', $audience);

        // 1. All courses with search filter
        $allCourses = Course::where('audience', 'LIKE', "%{$audience}%")
        ->orWhere('audience', 'LIKE', "%{$audienceWithDash}%")->when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
        })->latest()->get();

        // 2. Completed courses (user-specific) with search filter
        $completeCourses = Course::where(function ($query) use ($audience, $audienceWithDash) {
            $query->where('audience', 'LIKE', "%{$audience}%")
                ->orWhere('audience', 'LIKE', "%{$audienceWithDash}%");
        })
        ->whereHas('users', function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->where('is_completed', true);
        })
        ->when($search, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->get();


        // 3. Incomplete courses (user-specific) with search filter
        $incompleteCourses = Course::where(function ($query) use ($audience, $audienceWithDash) {
            $query->where('audience', 'LIKE', "%{$audience}%")
                ->orWhere('audience', 'LIKE', "%{$audienceWithDash}%");
        })
        ->where(function ($query) use ($user, $search) {
            $query->whereHas('users', function ($q) use ($user) {
                    $q->where('user_id', $user->id)
                    ->where(function ($q2) {
                        $q2->where('is_completed', false)
                            ->orWhereNull('is_completed');
                    });
                })
                ->orWhereDoesntHave('users', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                });

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
                });
            }
        })
        ->latest()
        ->get();



        return response()->json([
            'allCourses' => $allCourses,
            'completeCourses' => $completeCourses,
            'incompleteCourses' => $incompleteCourses,
        ]);
    }
}
