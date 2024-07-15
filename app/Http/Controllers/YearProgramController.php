<?php

namespace App\Http\Controllers;

use App\Models\StudentPyp;
use App\Models\TeacherPyp;
use App\Models\Homeroom;
use App\Models\User;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use App\Models\SubjectModel;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

class YearProgramController extends Controller
{
        public function yearProgram($userId)
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


            $role = User::find($authUserId)->role;

            if ($role == 0){  //admin
                return view('/admin/yearProgram/yp-admin', compact('teacher'));
            }
            
        }

        public function add($userId)
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
            $role = User::find($authUserId)->role;
    
            if ($role == 0){  //admin
                return view('admin/yearProgram/yp-admin-add', compact('teacher'));
            }
            
        }
}