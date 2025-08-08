<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Support\Str;
use App\Models\ExamQuestion;
use Illuminate\Http\Request;
use App\Models\DrillExamAttempt;
use Illuminate\Support\Facades\DB;
use App\Models\ExamAttemptQuestion;
use Illuminate\Support\Facades\Auth;
use App\Models\DrillExamAttemptQuestion;
use Illuminate\Support\Facades\Validator;

class DrillExamController extends Controller
{
    /**
     * Display the drill exam page.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();
        $data = [];
        if ($student->audience == 'High School' || $student->audience == 'college' || $student->audience == 'graduate') {
            $data = ['verbal' => 'Verbal', 'quanti' => 'Quant', 'mixed' => 'Mixed'];
        } else if ($student->audience == 'sat-2') {
            $data = ['physics' => 'Physics', 'chemistry' => 'Chemistry',  'maths' => 'Maths', 'biology' => 'Biology'];
        }

        return view('backend.fulltest.drill-exam', compact('data'));
    }


    public function prepare(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_type'    => 'required|string',
            'question_pool'    => 'required|string',
            'difficulty_level' => 'required|string',
            'total_questions'  => 'required|integer|min:1',
            'total_duration'   => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $userAudience = auth()->user()->audience;
        $questions = collect();

        switch ($request->question_pool) {
            case 'answeredUnanswered':
                $questionIds = ExamAttemptQuestion::whereHas('attempt', function ($query) {
                                    $query->where('user_id', auth()->id());
                                })->pluck('question_id')->unique();

                $questions = ExamQuestion::whereIn('id', $questionIds)
                    ->when($request->question_type === 'mixed', function ($query) use ($userAudience) {
                        $query->where('audience', $userAudience);
                    }, function ($query) use ($request) {
                        $query->where('sat_question_type', $request->question_type);
                    })
                    ->where('difficulty', $request->difficulty_level)
                    ->take($request->total_questions)
                    ->get();
                break;

            case 'unanswered':
                $questions = ExamQuestion::when($request->question_type === 'mixed', function ($query) use ($userAudience) {
                        $query->where('audience', $userAudience);
                    }, function ($query) use ($request) {
                        $query->where('sat_question_type', $request->question_type);
                    })
                    ->whereHas('unansweredQuestion')
                    ->where('difficulty', $request->difficulty_level)
                    ->take($request->total_questions)
                    ->get();
                break;

            case 'incorrect':
                // Step 1: All incorrect question IDs for the user
                $incorrectIds = ExamAttemptQuestion::whereHas('attempt', function ($query) {
                        $query->where('user_id', auth()->id());
                    })
                    ->where('is_correct', 0)
                    ->pluck('question_id')
                    ->unique();

                // Step 2: All correct question IDs for the user
                $correctIds = ExamAttemptQuestion::whereHas('attempt', function ($query) {
                        $query->where('user_id', auth()->id());
                    })
                    ->where('is_correct', 1)
                    ->pluck('question_id')
                    ->unique();

                // Step 3: Subtract correct from incorrect
                $questionIds = $incorrectIds->diff($correctIds);

                $questions = ExamQuestion::whereIn('id', $questionIds)
                            ->when($request->question_type === 'mixed', function ($query) use ($userAudience) {
                                $query->where('audience', $userAudience);
                            }, function ($query) use ($request) {
                                $query->where('sat_question_type', $request->question_type);
                            })
                            ->where('difficulty', $request->difficulty_level)
                            ->take($request->total_questions)
                            ->get();
                break;

            default:
                # code...
                break;
        }

        // $groupedQuestions = $questions->groupBy(function ($question) {
        //     return $question->sat_question_type ?? 'unknown';
        // });

        if ($questions->isEmpty()) {
            return response()->json(['message' => 'No questions found for the given criteria.'], 404);
        }

        return response()->json([
            'questions' => $questions,
            'total_questions' => $questions->count(),
            'question_type' => $request->question_type,
            'total_duration' => $request->total_duration,
            'start_time' => now()
        ], 200);
    }

    /**
     * Handle the submission of the drill exam.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        DB::beginTransaction();


            $responses = collect($request->responses);

            // Count correct answers
            $correctCount = $responses->where('is_correct', 1)->count();
            $inCorrectCount = $responses->where('is_correct', 0)->count();

            $answers = collect($request->responses)->mapWithKeys(function ($item) {
                return [$item['question_id'] => $item['answer']];
            });

             $attempt = DrillExamAttempt::create([
                'uuid'           => Str::uuid(),
                'user_id'        => auth()->id(),
                'start_time'     => $request->start_time,
                'remaining_time' => $request->total_duration * 60, // Convert minutes to seconds
                'exam_name'       => 'DE' . now()->format('ymdHis') . rand(1000, 9999),
                'answers'         => $answers,
                'status'          => 'completed',
                'score'           => $correctCount,
                'correct_answers' => $correctCount,
                'wrong_answers'   => $inCorrectCount,
                'end_time'        => now(),
            ]);


            foreach ($responses as $response) {
                DrillExamAttemptQuestion::create([
                    'uuid'           => Str::uuid(),
                    'attempt_id'     => $attempt->id,
                    'question_id'    => $response['question_id'],
                    'student_answer' => $response['answer'],
                    'is_correct'     => $response['is_correct'],
                    'time_spent'     => $response['time_spent'] ?? null, // Optional if tracked
                ]);
            }

        DB::commit();
        return response()->json(['msg' => 'Exam submitted successfully!', 'data' => $attempt], 201);
    }

    public function create()
    {
        return view('backend.drill-exam.create');
    }
}
