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

class StudentController extends Controller
{
    public function student($userId)
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
        $students = StudentPyp::all();


        $role = User::find($authUserId)->role;

        if ($role == 0){  //admin
            return view('admin/student/student-admin', compact('teacher','students'));
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
            return view('admin/student/student-admin-add', compact('teacher'));
        }
        
    }

    public function submit(Request $request, $userId)
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
        

        $newStudent = new StudentPyp();

        $newStudent->nim_pyp = $request->nim_pyp;
        $newStudent->first_name = $request->first_name;
        $newStudent->last_name = $request->last_name; 
        $newStudent->dob = $request->dob; 
        $newStudent->fathers_name = $request->dad_name;
        $newStudent->mothers_name = $request->mom_name; 
        $newStudent->fathers_phone = $request->dad_phone;
        $newStudent->mothers_phone = $request->mom_phone;   
        $newStudent->parents_email = $request->email; 
        $newStudent->address = $request->address; 
        $newStudent->previous_school = $request->prev_school;
        $newStudent->level = $request->input('option');  
        $newStudent->entry_date = $request->entry_date; 

    
            if ($role == 0 && $newStudent->save()) { // admin
                return redirect()->route('student', ['userId' => $teacher->user_id])->with('status', 'Subject added successfully!');
            }
        
    }

    public function detail($userId, $studentId)
    {
        $authUserId = Auth::id();

        // Check if the authenticated user's ID matches the requested user ID
        log($authUserId);
        if ($authUserId != $userId) {
            // Redirect to the authenticated user's dashboard
            return redirect()->route('dashboard', ['userId' => $authUserId]);
        }

        // Fetch the authenticated user
        $user = Auth::user();

        // Get the teacher associated with the user
        $teacher = $user->teacher;

        // Get the subject with its criteria
        $selectedStudent = StudentPyp::find($studentId);

        $role = User::find($authUserId)->role;

        if ($role == 0) {  // admin
            return view('admin/student/student-admin-detail', compact('teacher', 'selectedStudent'));
        }
    }

    public function edit($userId, $studentId)
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
        $selectedStudent = StudentPyp::find($studentId);


        $role = User::find($authUserId)->role;

        if ($role == 0){  //admin
            return view('admin/student/student-admin-edit', compact('teacher' ,'selectedStudent'));
        }
        
    }

    public function editSubmit(Request $request, $userId, $studentId)
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
        

        $newStudent = StudentPyp::find($studentId);

        $newStudent->nim_pyp = $request->nim_pyp;
        $newStudent->first_name = $request->first_name;
        $newStudent->last_name = $request->last_name; 
        $newStudent->dob = $request->dob; 
        $newStudent->fathers_name = $request->dad_name;
        $newStudent->mothers_name = $request->mom_name; 
        $newStudent->fathers_phone = $request->dad_phone;
        $newStudent->mothers_phone = $request->mom_phone;   
        $newStudent->parents_email = $request->email; 
        $newStudent->address = $request->address; 
        $newStudent->previous_school = $request->prev_school;
        $newStudent->level = $request->input('option');  
        $newStudent->entry_date = $request->entry_date; 

    
            if ($role == 0 && $newStudent->save()) { // admin
                return redirect()->route('student', ['userId' => $teacher->user_id])->with('status', 'Subject added successfully!');
            }
        
    }

    public function delete($userId, $studentId)
    {
        $authUserId = Auth::id();

        // Check if the authenticated user's ID matches the requested user ID
        if ($authUserId != $userId) {
            // Redirect to the authenticated user's dashboard
            return redirect()->route('dashboard', ['userId' => $authUserId]);
        }

        // Fetch the authenticated user
        $user = Auth::user();

        // Get the teacher associated with the user
        $teacher = $user->teacher;
        $delStudent = StudentPyp::find($studentId); 

        // $delSub = SubjectModel::find($subjectId);

        $delStudent->delete();

        $role = User::find($authUserId)->role;

        if ($role == 0) {  // admin
            return redirect()->route('student', ['userId' => $teacher->user_id])->with('status', 'Subject deleted successfully!');
        }
    }
}
