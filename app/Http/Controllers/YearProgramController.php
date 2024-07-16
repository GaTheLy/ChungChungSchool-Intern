<?php

namespace App\Http\Controllers;

use App\Models\DetailSubjectMYP;
use App\Models\StudentPyp;
use App\Models\TeacherPyp;
use App\Models\Homeroom;
use App\Models\User;
use App\Models\ATLMYP;
use App\Models\SubjectTeacher;
use App\Models\SubjectModel;
use App\Models\ClassModel;
use App\Models\YearProgramMYP;
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


            if ($role == 0){  //admin
                return view('/admin/yearProgram/yp-admin', compact('teacher', 'yearProgramMYP', 'subjectMYP', 'teacherMYP'));
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
    

            $detailSubject = new DetailSubjectMYP();
            $detailSubject->year_program_myp_id = $ypId;
            $detailSubject->subject_id =  $request->input('subject');
            $detailSubject->teacher_id = $request->input('teacher');


            


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

}