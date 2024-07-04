<?php

namespace App\Http\Controllers;

use App\Models\StudentPyp;
use App\Models\TeacherPyp;
use App\Models\Homeroom;
use App\Models\User;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;



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

        $homerooms = Homeroom::with(['teacher', 'class'])
        ->where('teacher_pyp_id', $teacher->nip_pyp)
        ->get();

        $subjects = SubjectTeacher::with(['teacher', 'subject'])
        ->where('teacher_id', $teacher->nip_pyp)
        ->get();

        $role = User::find($authUserId)->role;

        if ($role == 0){  //admin
            return view('dash-admin', compact('teacher','homerooms', 'subjects','role'));
        }else if ($role == 1){ //myp
            return view('dash-teacher', compact('teacher', 'homerooms', 'subjects', 'role'));
        }else if ($role == 2){  //pyp
            return view('dash-teacher', compact('teacher', 'homerooms', 'subjects','role'));
        }
    }

    public function subjects($userId)
    {
        $authUserId = Auth::id();

        // Check if the authenticated user's ID matches the requested user ID
        // if ($authUserId != $userId) {
        //     // Redirect to the authenticated user's dashboard
        //     return redirect()->route('dashboard', ['userId' => $authUserId]);
        // }

        // Fetch the authenticated user
        $user = Auth::user();

        $teacher = $user->teacher;

        $homerooms = Homeroom::with(['teacher', 'class'])->get();

        $subjects = SubjectTeacher::with(['teacher', 'subject'])->get();

        $role = User::find($authUserId)->role;

        if ($role == 0){  //admin
            return view('subject-admin', compact('teacher','homerooms', 'subjects','role'));
        }else if ($role == 1){ //myp
            return view('dash-teacher', compact('teacher', 'homerooms', 'subjects', 'role'));
        }else if ($role == 2){  //pyp
            return view('subject-teacher', compact('teacher', 'homerooms', 'subjects','role'));
        }
    }

    public function homeroom($userId)
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

        $homerooms = Homeroom::with(['teacher', 'class'])->get();

        $students = StudentPyp::with(['homeroom', 'class'])->get();


        $role = User::find($authUserId)->role;

        // if ($role == 0){  //admin
            // return view('dash-admin', compact('teacher','homerooms', 'subjects','role'));
        // }else if ($role == 1){ //myp
        //     return view('dash-teacher', compact('teacher', 'homerooms', 'subjects'));
        // }else 
        if ($role == 2){  //pyp
            return view('homeroom-teacher', compact('teacher', 'homerooms','role'));
        }
    }


    public function teacher($userId)
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
            return view('teacher-admin', compact('teacher'));
        }
        
    }


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


        $role = User::find($authUserId)->role;

        if ($role == 0){  //admin
            return view('student-admin', compact('teacher'));
        }
        
    }

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
            return view('yp-admin', compact('teacher'));
        }
        
    }

    public function subjectDetail($id, $sub_id, $class_id)
    {
        $user = Auth::user();

        $teacher = $user->teacher;

        $role = $user->role;

        // Fetch the subject teacher record
        $subjectTeacher = SubjectTeacher::where('sub_teacher_id', $sub_id)
            ->where('teacher_id', $teacher->nip_pyp)
            ->firstOrFail();

        // Fetch the classes taught by this subject teacher
        $class = ClassModel::where('class_id', $class_id)->firstOrFail();


        return view('subject-detail', [
            'teacher' => $teacher,
            'subject' => $subjectTeacher->subject,
            'class' => $class,
            'students' => $class->students,
        ]);
    }

    public function gradeStudent($teacherId, $subjectId, $classId, $studentId)
    {
        $teacher = TeacherPyp::findOrFail($teacherId);
        $subjectTeacher = SubjectTeacher::where('sub_teacher_id', $subjectId)
            ->where('teacher_id', $teacher->nip_pyp)
            ->firstOrFail();
        $class = ClassModel::where('class_id', $classId)->firstOrFail();
        $student = StudentPyp::findOrFail($studentId);

        // Fetch the criteria for the subject
        $criteria = $subjectTeacher->subject->criteria;

        return view('sub-detail-pyp-grade', [
            'teacher' => $teacher,
            'subject' => $subjectTeacher->subject,
            'class' => $class,
            'student' => $student,
            'criteria' => $criteria,
        ]);
    }

    public function saveGrade(Request $request)
    {
        // $subjectId = $request->input('subject_id');
        $studentId = $request->input('student_id');
        
        $sc_pyp_id = $request->input('sc_pyp_id');

        $criteria = $request->input('criteria');


        foreach ($criteria as $criterionId => $grade) {

            if (is_array($grade)) {
                $description = $grade['description'] ?? '';
            } else {
                $description = $grade;
            }
            // Save each criterion grade
            DB::table('subject_crit_progress_pyp')->updateOrInsert(
                [
                    'student_id' => $studentId,
                    'sc_pyp_id' => $sc_pyp_id,
                ]
                ,
                [
                    
                    'description' => $description,
                ]
            );
        }

        return redirect()->back()->with('success', 'Grades saved successfully.');
    }



}
