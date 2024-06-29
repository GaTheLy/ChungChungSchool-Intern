<?php

namespace App\Http\Controllers;

use App\Models\StudentPyp;
use App\Models\TeacherPyp;
use App\Models\Homeroom;
use App\Models\User;
use App\Models\Subject;
use App\Models\SubjectModel;
use App\Models\SubjectTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function subjects($userId)
    {
        $authUserId = Auth::id();

        // Check if the authenticated user's ID matches the requested user ID
        if ($authUserId != $userId) {
            // Redirect to the authenticated user's dashboard
            return redirect()->route('dashboard', ['userId' => $authUserId]);
        }

        // Fetch the authenticated user
        $user = Auth::user();

        $teacher = $user->teacher;
        $subjects = SubjectModel::all();


        $role = User::find($authUserId)->role;

        if ($role == 0){  //admin
            return view('subject-admin', compact('teacher','subjects'));
        }
        
    }

    public function subjectAdd($userId)
    {
        $authUserId = Auth::id();

        // Check if the authenticated user's ID matches the requested user ID
        if ($authUserId != $userId) {
            // Redirect to the authenticated user's dashboard
            return redirect()->route('dashboard', ['userId' => $authUserId]);
        }

        // Fetch the authenticated user
        $user = Auth::user();

        $teacher = $user->teacher;
        $subjects = SubjectModel::all();


        $role = User::find($authUserId)->role;

        if ($role == 0){  //admin
            return view('subject-admin-add', compact('teacher','subjects'));
        }
        
    }

    public function subjectAddMYP($userId)
    {
        $authUserId = Auth::id();

        // Check if the authenticated user's ID matches the requested user ID
        if ($authUserId != $userId) {
            // Redirect to the authenticated user's dashboard
            return redirect()->route('dashboard', ['userId' => $authUserId]);
        }

        // Fetch the authenticated user
        $user = Auth::user();

        $teacher = $user->teacher;
        $subjects = SubjectModel::all();


        $role = User::find($authUserId)->role;

        if ($role == 0){  //admin
            return view('subject-admin-add', compact('teacher','subjects'));
        }
        
    }


}
