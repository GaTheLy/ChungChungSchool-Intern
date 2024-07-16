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
use App\Models\MYPCriteria;
use App\Models\MYPCriteriaDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;


class TeachController extends Controller
{
    public function show($userId)
    {
        
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
        }else if ($role == 1 || $role == 2) { //myp or pyp
            return view('dash-teacher', compact('teacher', 'homerooms', 'subjects', 'role'));
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

        $teachers = TeacherPyp::get();
        $role = User::find($authUserId)->role;

        if ($role == 0){  //admin
            return view('admin/teacher/teacher-admin', compact('teacher','teachers'));
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



    public function subjectDetail($teacher_id, $sub_id, $class_id)
    {
        $user = Auth::user();

        $teacher = $user->teacher;

        $role = $user->role;

        // Fetch the subject teacher record
        $subjectTeacher = SubjectTeacher::where('subject_pyp_id', $sub_id)
            ->where('teacher_id', $teacher_id)
            ->firstOrFail();

        $subject = $subjectTeacher->subject;

        // Fetch the classes taught by this subject teacher
        $class = ClassModel::where('class_id', $class_id)->firstOrFail();


        return view('subject-detail', [
            'teacher' => $teacher,
            'subject' => $subject,
            'class' => $class,
            'students' => $class->students,
        ]);
    }

    public function gradeStudent($teacherId, $subjectId, $classId, $studentId)
    {
        $teacher = TeacherPyp::findOrFail($teacherId);
        $subjectTeacher = SubjectTeacher::where('subject_pyp_id', $subjectId)
            ->where('teacher_id', $teacher->nip_pyp)
            ->firstOrFail();
        $class = ClassModel::where('class_id', $classId)->firstOrFail();
        $student = StudentPyp::findOrFail($studentId);

        // Fetch the criteria for the subject
        $criteria = $subjectTeacher->subject->criteria;

        $subCrit = DB::table('sub_criteria_pyp');

        $studentProgress = DB::table('subject_crit_progress')
        ->where('student_id', $student->nim_pyp)
        // ->where('')
        ->get()
        ->keyBy('sc_pyp_id');

        // dd($studentProgress, $criteria);

        return view('sub-detail-pyp-grade', [
            'teacher' => $teacher,
            'subject' => $subjectTeacher->subject,
            'class' => $class,
            'student' => $student,
            'criteria' => $criteria,
            'studentProgress' => $studentProgress,
        ]);
    }

    public function saveGrade(Request $request)
    {
        $user = Auth::user();
        $teacher = $user->teacher;


        $studentId = $request->input('student_id');
        $criteriaData = $request->input('criteria');

        // Iterate through criteria data pairs
        foreach ($criteriaData as $key => $data) {
            // Check if current data is sc_pyp_id
            if (isset($data['sc_pyp_id'])) {
                $sc_pyp_id = $data['sc_pyp_id'];

                // Retrieve corresponding description
                if (isset($criteriaData[$key + 1]['description'])) {
                    $description = $criteriaData[$key + 1]['description'];

                    // Update or insert the grade for each criterion
                    DB::table('subject_crit_progress')->updateOrInsert(
                        [
                            'student_id' => $studentId,
                            'sc_pyp_id' => $sc_pyp_id,
                        ],
                        [
                            'description' => $description,
                        ]
                    );
                }
            }
        }

        return redirect()->back()->with('success', 'Grades saved successfully.');
    }

    public function gradeStudentMyp($teacherId, $subjectId, $classId, $studentId)
    {
        $teacher = TeacherPyp::findOrFail($teacherId);
        $subjectTeacher = SubjectTeacher::where('subject_pyp_id', $subjectId)
            ->where('teacher_id', $teacher->nip_pyp)
            ->firstOrFail();
        $class = ClassModel::where('class_id', $classId)->firstOrFail();
        $student = StudentPyp::findOrFail($studentId);

        // Fetch the criteria for the subject
        $criteria = MYPCriteria::where('subject_id', $subjectId)
                            ->with('mypCriteriaDetail')
                            ->get();

        $atls = $subjectTeacher->subject->atls;

        $subCrit = DB::table('sub_criteria_myp');

        $studentGrade = DB::table('subject_crit_grade_myp')
        ->where('student_id', $student->nim_pyp)
        // ->where('')
        ->get()
        ->keyBy('sc_myp_id');

        $studentAtl = DB::table('sub_atl_progress_myp')
        ->where('student_id', $student->nim_pyp)
        // ->where('')
        ->get()
        ->keyBy('sub_atl_id');

        // dd($studentGrade);
        $descriptors = MYPCriteriaDetail::all()->groupBy('criteria_id');

        return view('subject-detail-grade', [
            'teacher' => $teacher,
            'subject' => $subjectTeacher->subject,
            'class' => $class,
            'student' => $student,
            'criteria' => $criteria,
            'atls' => $atls,
            'studentAtl' => $studentAtl,
            'studentGrade' => $studentGrade,
            'descriptors' => $descriptors,
        ]);

    }

    public function saveGradeMyp(Request $request)
    {
        Log::debug('Request Data:', $request->all());

        $user = Auth::user();
        $teacher = $user->teacher; // Assuming you have this relationship set up in your User model

        $studentId = $request->input('student_id');
        $criteriaData = $request->input('criteria');
        
        // Iterate through criteria data pairs
        foreach ($criteriaData as $criterionId => $data) {
            // Check if current data is criterion_id for MYP
            if (isset($data['grade'])) {
                $grade = $data['grade'];

                // Update or insert the grade for each criterion
                DB::table('subject_crit_grade_myp')->updateOrInsert(
                    [
                        'student_id' => $studentId,
                        'sc_myp_id' => $criterionId,
                    ],
                    [
                        'crit_grade' => $grade,
                    ]
                );
            }
        }

        $atlsData = $request->input('atl_');

        foreach ($atlsData as $atlId => $atl) {
            // Check if current data is criterion_id for MYP
            if (isset($atl['prog'])) {
                $grade = $atl['prog'];

                // Update or insert the grade for each criterion
                DB::table('sub_atl_progress_myp')->updateOrInsert(
                    [
                        'student_id' => $studentId,
                        'sub_atl_id' => $atlId,
                    ],
                    [
                        'atl_progress' => $grade,
                    ]
                );
            }
        }

        // Optionally, you can return a response or redirect
        return redirect()->back()->with('success', 'Grades saved successfully!');
    }
    

  // form
    
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
            return view('admin/teacher/teacher-admin-add', compact('teacher'));
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


        $newUser = new User();
        $newUser->name = $request->first_name;
        $newUser->email = $request->email;
        $newUser->password = Hash::make($request->nip);
        

        $newTeacher = new TeacherPyp();
        if ($request->input('option') == 'PYP') {
            $newTeacher->is_myp = 0; 
            $newTeacher->is_pyp = 1;
            $newUser->role=2;
        } else if ($request->input('option') == 'MYP') {
            $newTeacher->is_myp = 1; 
            $newTeacher->is_pyp = 0;
            $newUser->role=1;
        } else if ($request->input('option') == 'ALL'){
            $newTeacher->is_myp = 1; 
            $newTeacher->is_pyp = 1;
            $newUser->role=0;
        }
        $newUser->save();

        $newTeacher->nip_pyp = $request->nip;
        $newTeacher->first_name = $request->first_name;
        $newTeacher->last_name = $request->last_name; 
        $newTeacher->phone = $request->phone; 
        $newTeacher->address = $request->address; 
        $newTeacher->joined_at = $request->joined_at; 
        $newTeacher->user_id = $newUser->id;

        
        
            if ($role == 0 && $newTeacher->save()) { // admin
                return redirect()->route('teacher', ['userId' => $teacher->user_id])->with('status', 'Subject added successfully!');
            }
        
    }


    public function detail($userId, $teacherId)
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
        $selectedTeacher = TeacherPyp::find($teacherId);

        $role = User::find($authUserId)->role;
        $infoEmail = User::find($selectedTeacher->user_id)->email;

        if ($role == 0) {  // admin
            return view('admin/teacher/teacher-admin-detail', compact('teacher', 'selectedTeacher','infoEmail'));
        }
    }

    public function edit($userId, $teacherId)
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
        $selectedTeacher = TeacherPyp::find($teacherId);
        $infoEmail = User::find($selectedTeacher->user_id)->email;


        $role = User::find($authUserId)->role;

        if ($role == 0){  //admin
            return view('admin/teacher/teacher-admin-edit', compact('teacher' ,'selectedTeacher','infoEmail'));
        }
        
    }

    public function editSubmit(Request $request, $userId, $teacherId)
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


        $newTeacher = TeacherPyp::find($teacherId);
        $newUser = User::find($newTeacher->user_id);
        $newUser->name = $request->first_name;
        $newUser->email = $request->email;
        // $newUser->password = Hash::make($request->password);
        if ($request->input('option') == 'PYP') {
            $newTeacher->is_myp = 0; 
            $newTeacher->is_pyp = 1;
            $newUser->role=2;
        } else if ($request->input('option') == 'MYP') {
            $newTeacher->is_myp = 1; 
            $newTeacher->is_pyp = 0;
            $newUser->role=1;
        } else if ($request->input('option') == 'ALL'){
            $newTeacher->is_myp = 1; 
            $newTeacher->is_pyp = 1;
            $newUser->role=0;
        }
        $newUser->save();

        $newTeacher->nip_pyp = $request->nip;
        $newTeacher->first_name = $request->first_name;
        $newTeacher->last_name = $request->last_name; 
        $newTeacher->phone = $request->phone; 
        $newTeacher->address = $request->address; 
        $newTeacher->joined_at = $request->joined_at; 

        
        
            if ($role == 0 && $newTeacher->save()) { // admin
                return redirect()->route('teacher', ['userId' => $teacher->user_id])->with('status', 'Subject added successfully!');
            }
        
    }
    public function delete($userId, $teacherId)
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
        $delTeach = TeacherPyp::find($teacherId); 
        $delUser = User::find($delTeach->user_id); 

        // $delSub = SubjectModel::find($subjectId);

        $delTeach->delete();
        $delUser->delete();

        $role = User::find($authUserId)->role;

        if ($role == 0) {  // admin
            return redirect()->route('teacher', ['userId' => $teacher->user_id])->with('status', 'Subject deleted successfully!');

            // return view('subject-admin', compact('teacher', 'subjects'));
        }
    }

    public function saveAttendance(Request $request)
    {
        // Log::info('Request Data: ', $request->all());
        // Validate the incoming request
        $validated = $request->validate([
            'student_id' => 'required|exists:student_pyp,nim_pyp',
            'absent' => 'required|integer|min:0',
            'present' => 'required|integer|min:0',
            'late' => 'required|integer|min:0',
        ]);

        // Insert or update attendance record
        DB::table('attendance_pyp')->updateOrInsert(
            ['student_id' => $validated['student_id']],
            [
                'absent' => $validated['absent'],
                'present' => $validated['present'],
                'late' => $validated['late'],
            ]
        );

        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Attendance recorded successfully.');
    }

    public function saveAttendanceMyp(Request $request)
    {
        Log::info('Request Data: ', $request->all());
        // Validate the incoming request
        $validated = $request->validate([
            'student_id' => 'required|exists:student_pyp,nim_pyp',
            'absent' => 'required|integer|min:0',
            'present' => 'required|integer|min:0',
            'sick' => 'required|integer|min:0',
            'late' => 'required|integer|min:0',
            'excused' => 'required|integer|min:0',
        ]);

        // Insert or update attendance record
        DB::table('attendance_myp')->updateOrInsert(
            ['student_id' => $validated['student_id']],
            [
                'absent' => $validated['absent'],
                'present' => $validated['present'],
                'late' => $validated['late'],
                'sick' => $validated['sick'],
                'excused' => $validated['excused'],
            ]
        );

        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Attendance recorded successfully.');
    }


}
