<?php

// app/Http/Controllers/ClassController.php

namespace App\Http\Controllers;

use App\Models\StudentPyp;
use App\Models\TeacherPyp;
use App\Models\Homeroom;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SubjectModel;
use App\Models\ClassModel;
use App\Models\StudentClass;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function show($id)
    {
        $class = ClassModel::findOrFail($id);

        $detail_class = DB::table('detail_class_pyp')
            ->where('class_id', $class->class_id)
            ->first();

        

        $year_prog = DB::table('year_program_pyp')
            ->where('id', $detail_class->year_program_pyp_id)
            ->first();

        
        // dd($year_prog);

        $units = DB::table('unit')
            ->where('year_program_pyp_id', $year_prog->id)
            ->get();

        // dd($units);

        // Assuming you have related models like students or subjects
        // Assuming $students is already fetched
        $students = $class->students;
        
        // $subjects = $class->subjects;
        foreach ($students as $student) {
            // Fetch existing attendance data for the student
            $attendance = DB::table('attendance_pyp')
                ->where('student_id', $student->nim_pyp)
                ->first(); // Assuming only one attendance record per student
    
        $student->attendance = $attendance; // Assigning attendance data to each student
        }
        return view('homeroom-teacher-pyp', compact('class', 'students', 'units'));
    }

    public function showMyp($id)
    {
        $user = Auth::user();
        $teacher = $user->teacher;
        $class = ClassModel::findOrFail($id);
        // Assuming you have related models like students or subjects
        // Assuming $students is already fetched
        $students = $class->students;
        // $subjects = $class->subjects;
        foreach ($students as $student) {
            // Fetch existing attendance data for the student
            $attendance = DB::table('attendance_myp')
                ->where('student_id', $student->nim_pyp)
                ->first(); // Assuming only one attendance record per student
    
        $student->attendance = $attendance; // Assigning attendance data to each student
        }
        return view('homeroom-teacher', compact('class', 'students', 'teacher'));
    }

    public function class($userId)
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
        $classes = ClassModel::get();
        $homeroom = Homeroom::get();
        $students = StudentClass::get();


        $role = User::find($authUserId)->role;

        if ($role == 0){  //admin
            return view('admin/class/class-admin', compact('teacher','classes','homeroom','students'));
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
        $teachers = TeacherPyp::get();
        $students = StudentPyp::get();


        $role = User::find($authUserId)->role;

        if ($role == 0){  //admin
            return view('admin/class/class-admin-add', compact('teacher','students','teachers'));
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

         // Create the class
        $class = new ClassModel();
        $class->class_name= $request->class_name;
        $class->save();

        // Assign homeroom
        $homeroom = new Homeroom();
        $homeroom->class_id = $class->class_id;
        $homeroom->teacher_pyp_id = $request->input('homeroom'); 
        $homeroom->save();

        $studentIds = json_decode($request->input('students_array'), true);
        if (is_array($studentIds)) {
            foreach ($studentIds as $studentId) {
                StudentClass::create([
                    'class_id' => $class->class_id,
                    'nim_pyp' => $studentId
                ]);
            }
        }

        if ($role == 0){  //admin
            return redirect()->route('class', ['userId' => $teacher->user_id])->with('status', 'Class added successfully!');
        }
        
    }


    public function detail($userId, $classId)
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

        // Get the subject with its criteria
        $selectedClass = ClassModel::find($classId);

        $role = User::find($authUserId)->role;

        if ($role == 0) {  // admin
            return view('admin/class/class-admin-detail', compact('teacher', 'selectedClass'));
        }
    }


}
