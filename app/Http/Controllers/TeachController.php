<?php

namespace App\Http\Controllers;

use App\Models\StudentPyp;
use App\Models\TeacherPyp;
use App\Models\Homeroom;
use App\Models\User;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeachController extends Controller
{
    public function show($userId)
    {
        // Fetch the first student as an example
        // $student = StudentPyp::first();
        // $teacher = TeacherPyp::first();
        // $homerooms = Homeroom::with(['teacher', 'class'])->get();

        // // Pass the student data to the view
        // return view('dash-teacher', compact('student', 'teacher', 'homerooms'));

        $authUserId = Auth::id();

        // Check if the authenticated user's ID matches the requested user ID
        if ($authUserId != $userId) {
            // Redirect to the authenticated user's dashboard
            return redirect()->route('dashboard', ['userId' => $authUserId]);
        }

        // Fetch the authenticated user
        $user = Auth::user();
        
        // $user = User::findOrFail($userId);

        $teacher = $user->teacher;

        $homerooms = Homeroom::with(['teacher', 'class'])->get();

        $subjects = SubjectTeacher::with(['teacher', 'subject'])->get();

        return view('dash-teacher', compact('teacher', 'homerooms', 'subjects'));
    }
}
