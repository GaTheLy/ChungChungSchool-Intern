<?php

namespace App\Http\Controllers;

use App\Models\ATLPYP;
use App\Models\LinesOfInquiry;
use App\Models\StudentPyp;
use App\Models\TeacherPyp;
use App\Models\Homeroom;
use App\Models\User;
use App\Models\ATLMYP;
use App\Models\Boundaries;
use App\Models\SubjectTeacher;
use App\Models\SubjectModel;
use App\Models\ClassModel;
use App\Models\DetailClassMYP;
use App\Models\DetailClassPYP;
use App\Models\KeyConcept;
use App\Models\Unit;
use App\Models\YearProgramMYP;
use App\Models\YearProgramPYP;
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

            $yearProgramMYP = YearProgramMYP::get();
            $subjectMYP = SubjectModel::where('subject_level', 'MYP')->get();
            $teacherMYP = TeacherPyp::where('is_myp', 1)->get();
            $class = ClassModel::get();
            $detailSubMYP = SubjectTeacher::where('level', 'MYP')->with(['subject.atls', 'teacher'])->get();
            $detailClassMYP = DetailClassMYP::with(['class', 'homeroom.teacher'])->get();
            $boundaries = Boundaries::get();

            //pyp
            $yearProgramPYP = YearProgramPYP::with('atlpyp')->get();
            $units = Unit::with(['linesOfInquiry', 'keyConcepts'])->get();
            $subjectPYP = SubjectModel::where('subject_level', 'PYP')->get();
            $teacherPYP = TeacherPyp::where('is_pyp', 1)->get();
            $detailSubPYP = SubjectTeacher::where('level', 'PYP')->with(['subject', 'teacher'])->get();
            $detailClassPYP = DetailClassPYP::with(['class', 'homeroom.teacher'])->get();
            // ->whereHas('homeroom.teacher', function ($query) {
            //     $query->where('level', 'PYP');
            // })->get();



            if ($role == 0){  //admin
                return view('/admin/yearProgram/yp-admin', compact('teacher', 'yearProgramMYP', 'subjectMYP', 'teacherMYP','class','detailSubMYP','detailClassMYP', 'boundaries'
                                                                    ,'units','yearProgramPYP', 'subjectPYP', 'teacherPYP','detailSubPYP','detailClassPYP'));
            }
            
        }

        public function add(Request $request, $userId)
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
    
            $yearProgram = new YearProgramMYP();

            $yearProgram->name = $request->program_name;
            if ($yearProgram->save()) {
                if ($role == 0) { // admin
                    return redirect()->route('yearProgram', ['userId' => $teacher->user_id])->with('status', 'Year Program added successfully!');
                }
            } else {
                return back()->withInput()->withErrors(['error' => 'Failed to add year program. Please try again.']);
            }
        }
        public function addPYP(Request $request, $userId)
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
    
            $yearProgram = new YearProgramPYP();
            $yearProgram->name = $request->program_name;

            if ($yearProgram->save()) {

                $unit = new Unit();
                $unit->name = $request->unit_name;
                $unit->central_idea = $request->central_idea;
                $unit->year_program_pyp_id = $yearProgram->id;
                if($unit->save()){
                    if($request->input('loi')){
                        foreach ($request->input('loi') as $loiInput) {
                            $loi = new LinesOfInquiry();
                            $loi->description = $loiInput['name'] ?? null;
                            $loi->unit_id = $unit->unit_id;;
                            $loi->save();
                        }
                    }
                    if($request->input('key')){
                        foreach ($request->input('key') as $keyInput) {
                            $key = new KeyConcept();
                            $key->topic = $keyInput['name'] ?? null;
                            $key->unit_id = $unit->unit_id;;
                            $key->save();
                        }
                    }
                }

                if($request->input('atl')){
                    foreach ($request->input('atl') as $atlInput) {
                        $atl = new ATLPYP();
                        $atl->description = $atlInput['name'] ?? null;
                        $atl->year_program_pyp_id = $yearProgram->id;
                        $atl->save();
                    }
                }

                

                if ($role == 0) { // admin
                    return redirect()->route('yearProgram', ['userId' => $teacher->user_id])->with('status', 'Year Program added successfully!');
                }
            } else {
                return back()->withInput()->withErrors(['error' => 'Failed to add year program. Please try again.']);
            }
        }
        public function addATL(Request $request, $userId, $ypId)
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

                if($request->input('atl')){
                    foreach ($request->input('atl') as $atlInput) {
                        $atl = new ATLPYP();
                        $atl->description = $atlInput['name'] ?? null;
                        $atl->year_program_pyp_id = $ypId;
                        $atl->save();
                    }
                }

                if ($role == 0) { // admin
                    return redirect()->route('yearProgram', ['userId' => $teacher->user_id])->with('status', 'Year Program added successfully!');
                }
                else {
                    return back()->withInput()->withErrors(['error' => 'Failed to add year program. Please try again.']);
                }
        }

        public function addUnit(Request $request, $userId, $ypId)
        {
            $authUserId = Auth::id();
        
            if ($authUserId != $userId) {
                return redirect()->route('dashboard', ['userId' => $authUserId]);
            }
        
            $user = Auth::user();
            $teacher = $user->teacher;
            $role = User::find($authUserId)->role;
        
        
            // Check if the $ypId exists in the year_program_pyp table
            $yearProgramPYP = YearProgramPYP::find($ypId);
            if (!$yearProgramPYP) {
                return back()->withInput()->withErrors(['error' => 'Year Program PYP ID does not exist.']);
            }
        
            $unit = new Unit();
            $unit->name = $request->unit_name;
            $unit->central_idea = $request->central_idea;
            $unit->year_program_pyp_id = $ypId;
        
            if($unit->save()){
                if($request->input('loi')){
                    foreach ($request->input('loi') as $loiInput) {
                        $loi = new LinesOfInquiry();
                        $loi->description = $loiInput['name'] ?? null;
                        $loi->unit_id = $unit->unit_id;
                        $loi->save();
                    }
                }
                if($request->input('key')){
                    foreach ($request->input('key') as $keyInput) {
                        $key = new KeyConcept();
                        $key->topic = $keyInput['name'] ?? null;
                        $key->unit_id = $unit->unit_id;
                        $key->save();
                    }
                }
            }
        
            if ($role == 0) { // admin
                return redirect()->route('yearProgram', ['userId' => $teacher->user_id])->with('status', 'Year Program added successfully!');
            }
            else {
                return back()->withInput()->withErrors(['error' => 'Failed to add year program. Please try again.']);
            }
        }
        public function addSubject(Request $request, $userId,$ypId)
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
    

            $detailSubject = new SubjectTeacher();
            $detailSubject->yp_myp_id = $ypId;
            $detailSubject->subject_pyp_id =  $request->input('subject');
            $detailSubject->teacher_id = $request->input('teacher');
            $detailSubject->level = "MYP";

            if ($detailSubject->save()) {
                if($request->input('atl')){
                    foreach ($request->input('atl') as $atlInput) {
                        $atl = new ATLMYP();
                        $atl->atl_name = $atlInput['name'] ?? null;
                        $atl->subject_id = $request->input('subject');
                        $atl->save();
                    }
                }
                
                if ($role == 0) { // admin
                    return redirect()->route('yearProgram', ['userId' => $teacher->user_id])->with('status', 'Year Program added successfully!');
                }
            } else {
                return back()->withInput()->withErrors(['error' => 'Failed to add year program. Please try again.']);
            }
        }

        public function addSubjectPYP(Request $request, $userId,$ypId)
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
    

            $detailSubject = new SubjectTeacher();
            $detailSubject->yp_pyp_id = $ypId;
            $detailSubject->subject_pyp_id =  $request->input('subject');
            $detailSubject->teacher_id = $request->input('teacher');
            $detailSubject->teacher_id = "PYP";

            if ($detailSubject->save()) {
                if ($role == 0) { // admin
                    return redirect()->route('yearProgram', ['userId' => $teacher->user_id])->with('status', 'Year Program added successfully!');
                }
            } else {
                return back()->withInput()->withErrors(['error' => 'Failed to add year program. Please try again.']);
            }
        }

        public function addClass(Request $request, $userId,$ypId)
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
    

            $detailClass = new DetailClassMYP();
            $detailClass->year_program_myp_id = $ypId;
            $detailClass->class_id =  $request->input('class');
            $detailClass->start_date = $request->start_date;
            $detailClass->end_date = $request->end_date;

            if ($detailClass->save()) {
                
                if ($role == 0) { // admin
                    return redirect()->route('yearProgram', ['userId' => $teacher->user_id])->with('status', 'Year Program Class added successfully!');
                }
            } else {
                return back()->withInput()->withErrors(['error' => 'Failed to add year program class. Please try again.']);
            }
        }

        public function addClassPYP(Request $request, $userId,$ypId)
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
    

            $detailClass = new DetailClassPYP();
            $detailClass->year_program_pyp_id = $ypId;
            $detailClass->class_id =  $request->input('class');
            $detailClass->start_date = $request->start_date;
            $detailClass->end_date = $request->end_date;

            if ($detailClass->save()) {
                
                if ($role == 0) { // admin
                    return redirect()->route('yearProgram', ['userId' => $teacher->user_id])->with('status', 'Year Program Class added successfully!');
                }
            } else {
                return back()->withInput()->withErrors(['error' => 'Failed to add year program class. Please try again.']);
            }
        }

        public function boundaries(Request $request, $userId,$ypId)
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
    

            $boundaries = Boundaries::updateOrCreate(
                ['yp_myp_id' => $ypId], // Condition to find the record
                [
                    'start_1' => $request->grade1start,
                    'end_1' => $request->grade1end,
                    'start_2' => $request->grade2start,
                    'end_2' => $request->grade2end,
                    'start_3' => $request->grade3start,
                    'end_3' => $request->grade3end,
                    'start_4' => $request->grade4start,
                    'end_4' => $request->grade4end,
                    'start_5' => $request->grade5start,
                    'end_5' => $request->grade5end,
                    'start_6' => $request->grade6start,
                    'end_6' => $request->grade6end,
                    'start_7' => $request->grade7start,
                    'end_7' => $request->grade7end,
                ]
            );
            

            if ($boundaries->save()) {
                
                if ($role == 0) { // admin
                    return redirect()->route('yearProgram', ['userId' => $teacher->user_id])->with('status', 'Boundaries added successfully!');
                }
            } else {
                return back()->withInput()->withErrors(['error' => 'Failed to add Boundaries. Please try again.']);
            }
        }

}