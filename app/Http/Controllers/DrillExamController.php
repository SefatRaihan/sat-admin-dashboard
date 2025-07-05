<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DrillExamController extends Controller
{
    /**
     * Display the drill exam page.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();
        $data = [];
        if($student->audience == 'high-school' || $student->audience == 'college' || $student->audience == 'graduate')
        {
            $data = ['verbal' => 'Verbal', 'quanti' => 'Quant', 'mixed' => 'Mixed'];
        } else if($student->audience == 'sat-2')
        {
            $data = ['physics' => 'Physics','chemistry' => 'Chemistry',  'maths' => 'Maths', 'biology' => 'Biology'];
        } 

        return view('backend.fulltest.drill-exam', compact('data'));
    }

    /**
     * Handle the submission of the drill exam.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request)
    {
        // Validate and process the submitted data
        // ...

        return redirect()->route('drill-exam.index')->with('success', 'Exam submitted successfully!');
    }
}
