<?php

namespace App\Http\Controllers;

use App\Models\StudentPyp;
use App\Models\TeacherPyp;
use App\Models\Homeroom;
use Illuminate\Http\Request;

class TeachController extends Controller
{
    public function index()
    {
        // Fetch the first student as an example
        $student = StudentPyp::first();
        $teacher = TeacherPyp::first();
        $homerooms = Homeroom::with(['teacher', 'class'])->get();

        // Pass the student data to the view
        return view('dash-teacher', compact('student', 'teacher', 'homerooms'));
    }
}
