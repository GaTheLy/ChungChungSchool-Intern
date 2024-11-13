<?php

// app/Http/Controllers/ClassController.php

namespace App\Http\Controllers;

use App\Models\StudentPyp;
use App\Models\TeacherPyp;
use App\Models\Unit;
use App\Models\Homeroom;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SubjectModel;
use App\Models\ClassModel;
use App\Models\DetailClassMYP;
use App\Models\DetailClassPYP;
use App\Models\HomeroomComments;
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

        // $units = DB::table(table: 'unit')
        //     ->where('year_program_pyp_id', $year_prog->id)
        //     ->get();
        $units = Unit::with(['linesOfInquiry', 'keyConcepts'])
            ->where('year_program_pyp_id', $year_prog->id)
            ->get();

        
        $lines_of_inquiry = DB::table(table: 'lines_of_inquiry')->get();


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

        $comments = HomeroomComments::get();
        // dd($comments);
        $homeroom = Homeroom::with('teacher')
        ->where('class_id', $class->class_id)
        ->where('role', 'main') // role 0 = homeroom
        ->first();

        $coHomeroom = Homeroom::with('teacher')
            ->where('class_id', $class->class_id)
            ->where('role', 'co') // role 1 = co-homeroom
            ->first();

        $substituteHomeroom = Homeroom::with('teacher')
            ->where('class_id', $class->class_id)
            ->where('role', 'subs') // role 2 = substitute homeroom
            ->first();

        return view('homeroom-teacher-pyp', compact('class', 'students', 'units', 'atls', 'teacher','comments','lines_of_inquiry', 'homeroom', 'coHomeroom', 'substituteHomeroom'));
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
        $user = User::find($authUserId);
        if (!$user) {
            return redirect()->route('dashboard')->withErrors('User not found.');
        }
        $teacher = $user->teacher;
        $classes = ClassModel::with('homerooms.teacher', 'students')->get();

        $role = $user->role;

        if ($role == 0){  //admin
            return view('admin/class/class-admin', compact('teacher','classes'));
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
        $homeroom->role = 'main'; 
        $homeroom->save();

        $checkCoHomeroom = $request->input('co-homeroom');
        if ($checkCoHomeroom != "0"){
            $homeroom = new Homeroom();
            $homeroom->class_id = $newClassId;
            $homeroom->teacher_pyp_id = $request->input('co-homeroom'); 
            $homeroom->role = 'co'; 
            $homeroom->save();
        }

        $checkSubsHomeroom = $request->input('subs-homeroom');
        if ($checkSubsHomeroom != "0"){
            $homeroom = new Homeroom();
            $homeroom->class_id = $newClassId;
            $homeroom->teacher_pyp_id = $request->input('subs-homeroom'); 
            $homeroom->role = 'subs'; 
            $homeroom->save();
        }

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

        // Fetch the selected class with its students ordered by name
        $selectedClass = ClassModel::with(['students' => function ($query) {
            $query->orderBy('first_name')->orderBy('middle_name')->orderBy('last_name');
        }])->find($classId);

        // Fetch homeroom teachers by role
        $mainHomeroom = Homeroom::where('class_id', $classId)->where('role', 'main')->with('teacher')->first();
        $coHomeroom = Homeroom::where('class_id', $classId)->where('role', 'co')->with('teacher')->first();
        $subsHomeroom = Homeroom::where('class_id', $classId)->where('role', 'subs')->with('teacher')->first();

        $role = User::find($authUserId)->role;

        if ($role == 0) {  // admin
            return view('admin/class/class-admin-detail', compact('teacher', 'selectedClass', 'mainHomeroom', 'coHomeroom', 'subsHomeroom'));
        }
    }



    public function edit($userId, $classId) {
        $authUserId = Auth::id();
    
        // Check if the authenticated user's ID matches the requested user ID
        if ($authUserId != $userId) {
            // Redirect to the authenticated user's dashboard
            return redirect()->route('dashboard', ['userId' => $authUserId]);
        }
    
        // Fetch the authenticated user
        $user = Auth::user();
        $teacher = $user->teacher;
    
        // Fetch the selected class with students, ordered by name
        $selectedClass = ClassModel::with(['students' => function ($query) {
            $query->orderBy('first_name')->orderBy('middle_name')->orderBy('last_name');
        }])->find($classId);
    
        // Fetch homerooms assigned to the selected class
        $assignedHomerooms = Homeroom::with('teacher')
            ->where('class_id', $classId)
            ->get()
            ->groupBy('role');  // Group by role (main, co, subs)
    
        // Fetch all available teachers who are not yet assigned to a homeroom
        $assignedTeacherIds = Homeroom::pluck('teacher_pyp_id')->toArray();
        $teachers = TeacherPyp::whereNotIn('nip_pyp', $assignedTeacherIds)->get();
    
        // Fetch available students who are not yet assigned to the class
        $assignedStudentIds = StudentClass::pluck('nim_pyp')->toArray();
        $students = StudentPyp::whereNotIn('nim_pyp', $assignedStudentIds)->get();
    
        // Fetch user role
        $role = User::find($authUserId)->role;
    
        // Pass the grouped homerooms to the view
        if ($role == 0) {  // Admin
            return view('admin/class/class-admin-edit', compact(
                'teacher', 'selectedClass', 'teachers', 'students', 'assignedHomerooms'
            ));
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
        $mainHomeroomId = $request->input('homeroom');
            $mainHomeroom = Homeroom::where('class_id', $classId)->where('role', 'main')->first();
            if ($mainHomeroom) {
                // Update existing main homeroom
                $mainHomeroom->class_id = $classId;
                $mainHomeroom->teacher_pyp_id = $mainHomeroomId;
                $mainHomeroom->save();
            } else {
                // Create new main homeroom if not found
                $mainHomeroom = new Homeroom();
                $mainHomeroom->class_id = $classId;
                $mainHomeroom->teacher_pyp_id = $mainHomeroomId;
                $mainHomeroom->role = 'main';  // Assign as 'main'
                $mainHomeroom->save();
            }


        // Update co-homeroom
        $coHomeroomId = $request->input('co-homeroom');
        if ($coHomeroomId != "0") {
            // dd($coHomeroomId);
            $coHomeroom = Homeroom::where('class_id', $classId)->where('role', 'co')->first();
            if ($coHomeroom) {
                // Update existing co-homeroom
                $coHomeroom->class_id = $classId;
                $coHomeroom->teacher_pyp_id = $coHomeroomId;
                $coHomeroom->save();
            } else {
                // Create new co-homeroom if not found
                $coHomeroom = new Homeroom();
                $coHomeroom->class_id = $classId;
                $coHomeroom->teacher_pyp_id = $coHomeroomId;
                $coHomeroom->role = 'co';  // Assign as 'co'
                $coHomeroom->save();
            }
        } else {
            // Optionally handle the case where no co-homeroom is selected (remove the existing co-homeroom)
            Homeroom::where('class_id', $classId)->where('role', 'co')->delete();
        }

        // Update substitute homeroom
        $subsHomeroomId = $request->input('subs-homeroom');
        if ($subsHomeroomId != "0") {
            $subsHomeroom = Homeroom::where('class_id', $classId)->where('role', 'subs')->first();
            if ($subsHomeroom) {
                // Update existing subs homeroom
                $subsHomeroom->class_id = $classId;
                $subsHomeroom->teacher_pyp_id = $subsHomeroomId;
                $subsHomeroom->save();
            } else {
                // Create new subs homeroom if not found
                $subsHomeroom = new Homeroom();
                $subsHomeroom->class_id = $classId;
                $subsHomeroom->teacher_pyp_id = $subsHomeroomId;
                $subsHomeroom->role = 'subs';  // Assign as 'subs'
                $subsHomeroom->save();
            }
        } else {
            // Optionally handle the case where no co-homeroom is selected (remove the existing co-homeroom)
            Homeroom::where('class_id', $classId)->where('role', 'subs')->delete();
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
