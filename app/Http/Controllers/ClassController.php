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
use App\Models\DetailClassMYP;
use App\Models\DetailClassPYP;
use App\Models\StudentClass;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function show($id)
    {
        $user = Auth::user();
        $teacher = $user->teacher;
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

        $atls = DB::table('approach_to_learning')
            ->where('year_program_pyp_id', $year_prog->id)
            ->get();

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
        return view('homeroom-teacher-pyp', compact('class', 'students', 'units', 'atls', 'teacher'));
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
        
        $assignedTeacherIds = Homeroom::pluck('teacher_pyp_id')->toArray();
        $teachers = TeacherPyp::whereNotIn('nip_pyp', $assignedTeacherIds)->get();
        // $teachers = TeacherPyp::get();
        // $students = StudentPyp::get();
        $assignedStudentIds = StudentClass::pluck('nim_pyp')->toArray();
        $students = StudentPyp::whereNotIn('nim_pyp', $assignedStudentIds)->get();

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

        // Fetch the latest class_id and increment it
        $latestClassId = ClassModel::max('class_id');
        $newClassId = $latestClassId ? $latestClassId + 1 : 1; // Start from 1 if no classes exist

        // Create the class with the new class_id
        $class = new ClassModel();
        $class->class_id = $newClassId; // Assign the incremented class_id
        $class->class_name = $request->class_name;
        $class->class_level = $request->class_level;
        $class->save();

         // Create the class
        // $class = new ClassModel();
        // $class->class_name= $request->class_name;
        // $class->save();

        // Assign homeroom
        $homeroom = new Homeroom();
        $homeroom->class_id = $newClassId;
        $homeroom->teacher_pyp_id = $request->input('homeroom'); 
        $homeroom->save();

        $studentIds = json_decode($request->input('students_array'), true);
        if (is_array($studentIds)) {
            foreach ($studentIds as $studentId) {
                StudentClass::create([
                    'class_id' => $newClassId,
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
        // $selectedClass = ClassModel::with('students')->find($classId);
        // dd($selectedClass->students);
        $selectedClass = ClassModel::with(['students' => function ($query) {
            $query->orderBy('first_name')->orderBy('middle_name')->orderBy('last_name');
        }])->find($classId);
        

        $role = User::find($authUserId)->role;

        if ($role == 0) {  // admin
            return view('admin/class/class-admin-detail', compact('teacher', 'selectedClass'));
        }
    }


    public function edit($userId, $classId)    {
        $authUserId = Auth::id();

        // Check if the authenticated user's ID matches the requested user ID
        if ($authUserId != $userId) {
            // Redirect to the authenticated user's dashboard
            return redirect()->route('dashboard', ['userId' => $authUserId]);
        }

        // Fetch the authenticated user
        $user = Auth::user();

        $teacher = $user->teacher;

        $selectedClass = ClassModel::with(['students' => function ($query) {
            $query->orderBy('first_name')->orderBy('middle_name')->orderBy('last_name');
        }])->find($classId);

        $assignedTeacherIds = Homeroom::pluck('teacher_pyp_id')->toArray();
        $teachers = TeacherPyp::whereNotIn('nip_pyp', $assignedTeacherIds)->get();
        // $teachers = TeacherPyp::get();
        // $students = StudentPyp::get();
        
        $assignedStudentIds = StudentClass::pluck('nim_pyp')->toArray();
        $students = StudentPyp::whereNotIn('nim_pyp', $assignedStudentIds)->get();

        $role = User::find($authUserId)->role;

        if ($role == 0){  //admin
            return view('admin/class/class-admin-edit', compact('teacher' ,'selectedClass','teachers','students'));
        }
        
    }

    public function deleteStudent(Request $request, $userId, $classId, $studentId)
    {
        $authUserId = Auth::id();

        // Check if the authenticated user's ID matches the requested user ID
        if ($authUserId != $userId) {
            // Redirect to the authenticated user's dashboard
            return redirect()->route('dashboard', ['userId' => $authUserId]);
        }

        // Fetch the authenticated user
        $user = Auth::user();
        $role = User::find($authUserId)->role;


        // Find the student-class relationship
        $studentClass = StudentClass::where('class_id', $classId)
                                    ->where('nim_pyp', $studentId)
                                    ->first();

        // dd($studentClass->id);
        
        if ($studentClass->id) {
            // Delete the relationship
            $studentClass->delete();
            if ($role == 0){  //admin
                return redirect()->back()->with('success', 'Student removed successfully.');
            }
        }

        return redirect()->back()->with('error', 'Student not found.');

        
        
    }

    public function editSubmit(Request $request, $userId,$classId)
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
        $class = ClassModel::find($classId);
        $class->class_name= $request->class_name;
        $class->save();

        // Assign homeroom
        if(Homeroom::where('class_id', $classId)->first()== null){
            $homeroom = new Homeroom();
            $homeroom->class_id = $class->class_id;
            $homeroom->teacher_pyp_id = $request->input('homeroom'); 
            $homeroom->save();
        }else{
            $homeroom = Homeroom::where('class_id', $classId)->first();
            $homeroom->teacher_pyp_id = $request->input('homeroom'); 
            $homeroom->save();
        }
        

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
            return redirect()->route('class', ['userId' => $teacher->user_id])->with('status', 'Class edited successfully!');
        }
        
    }

    public function delete(Request $request, $userId, $classId)
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

        // Remove all students associated with the class
        $students = StudentClass::where('class_id', $classId);
        if ($students) {
            $students->delete();
        }

        // Remove homeroom associated with the class
        $homeroom = Homeroom::where('class_id', $classId)->first();
        if ($homeroom) {
            $homeroom->delete();
        }

        // remove any detail class-yearprogram associated with the class
        $detailMYP = DetailClassMYP::where('class_id', $classId)->first();
        $detailPYP = DetailClassPYP::where('class_id', $classId)->first();
        if($detailMYP != null){
            $detailMYP->delete();
        } else if ($detailPYP != null){
            $detailPYP->delete();
        }


        // Delete the class
        $class = ClassModel::find($classId);
        if ($class) {
            $class->delete();
        }
        
        

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
            return redirect()->route('class', ['userId' => $teacher->user_id])->with('status', 'Class edited successfully!');
        }
        
    }

}
