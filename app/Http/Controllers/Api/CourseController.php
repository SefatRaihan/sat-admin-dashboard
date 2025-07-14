<?php

namespace App\Http\Controllers\Api;

use App\Models\Exam;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Chapter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;

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
    public function index()
    {
        return view('backend.courses.index');
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
    public function store(StoreCourseRequest $request)
    {

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
        $exams = Lesson::select('id', 'title as text')->get();
        return response()->json($exams);
    }
}
