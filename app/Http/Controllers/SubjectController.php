<?php

namespace App\Http\Controllers;

use App\Models\StudentPyp;
use App\Models\SubjectPYPDescriptor;
use App\Models\TeacherPyp;
use App\Models\Homeroom;
use App\Models\User;
use App\Models\MYPCriteriaDetail;
use App\Models\MYPCriteria;
use App\Models\SubjectModel;
use App\Models\PYPCriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $subjects = SubjectModel::get();

        $role = User::find($authUserId)->role;

        if ($role == 0){  //admin
            return view('subject-admin', compact('teacher' ,'subjects'));
        }
        
    }

    public function subjectAddPage($userId)
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
        
        $lastSubject = SubjectModel::orderBy('id', 'desc')->first();
        if($lastSubject->id == null){
            $index = 1;
        }else{
            $index = $lastSubject->id + 1;
        }
        



        $role = User::find($authUserId)->role;

        $subject = new SubjectModel();
        $subject->subject_name = $request->subject_name;
        $subject->subject_level = $request->option;
        $subject->id = $index;     


        
        
        if ($subject->save()) {

            if ($request->input('option') == 'PYP') {
                $this->savePYPCriteria($request->input('criteria'), $subject->id);
            } else if ($request->input('option') == 'MYP') {
                $this->saveMYPCriteria($request->input('criteria'), $subject->id);
            }

            if ($role == 0) { // admin
                return redirect()->route('subject', ['userId' => $teacher->user_id])->with('status', 'Subject added successfully!');

                // return view('subject-admin', compact('teacher', 'subjects'))->with('status', 'Subject added successfully!');
            }
        } else {
            return back()->withInput()->withErrors(['error' => 'Failed to add subject. Please try again.']);
        }
        
    }

    protected function savePYPCriteria($criteriaData, $subjectId)
    {
        foreach ($criteriaData as $criteria) {
            $pypCriteria = new PYPCriteria();
            $pypCriteria->crit_name = $criteria['name'] ?? null;
            $pypCriteria->subject_pyp_id = $subjectId;
            $pypCriteria->criteria_descriptor = $criteria['description'] ?? null;
            $pypCriteria->save();
        }
    }

    protected function saveMYPCriteria($criteriaData, $subjectId)
    {
        foreach ($criteriaData as $criteria) {
            $mypCriteria = new MYPCriteria();
            $mypCriteria->criteria_title = $criteria['title'];
            $mypCriteria->criteria_name = $criteria['name'];
            $mypCriteria->subject_id = $subjectId;
            $mypCriteria->save();

            $count=1;
            foreach ($criteria['ranges'] as $range) {
                $mypCriteriaRange = new MYPCriteriaDetail();
                $mypCriteriaRange->sub_criteria_myp_id = $mypCriteria->id;
                $mypCriteriaRange->criteria_range = $count;
                $mypCriteriaRange->criteria_range_desc = $range['description'];
                $mypCriteriaRange->save();
                $count+=1;
            }
        }
    }

    public function detail($userId, $subjectId)
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
        $subject = SubjectModel::with(['pypCriteria', 'mypCriteria.mypCriteriaDetail'])->find($subjectId);

        $role = User::find($authUserId)->role;

        if ($role == 0) {  // admin
            return view('subject-admin-detail', compact('teacher', 'subject'));
        }
    }

    public function edit($userId, $subjectId)
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
        $subject = SubjectModel::with(['pypCriteria', 'mypCriteria.mypCriteriaDetail'])->find($subjectId); 

        $role = User::find($authUserId)->role;

        if ($role == 0){  //admin
            return view('subject-admin-edit', compact('teacher' ,'subject'));
        }
        
    }

    public function editSubmit(Request $request, $userId, $subjectId)
    {
        $authUserId = Auth::id();
    
        if ($authUserId != $userId) {
            return redirect()->route('dashboard', ['userId' => $authUserId]);
        }
    
        $user = Auth::user();
        $teacher = $user->teacher;
        $subject = SubjectModel::find($subjectId); 
    
        $subject->subject_name = $request->input('subject_name', $subject->subject_name);
    
        $role = User::find($authUserId)->role;
    
        if ($subject->save()) {
            if ($subject->subject_level == 'PYP') {
                foreach ($request->input('criteria') as $criteriaId => $criteriaData) {
                    $criteria = PYPCriteria::find($criteriaId);
                    if ($criteria) {
                        $criteria->crit_name = $criteriaData['name'] ?? $criteria->crit_name;
                        $criteria->save();
                    } else {
                        return back()->withErrors(['error' => "Criteria with ID {$criteriaId} not found."]);
                    }
                }
            } else if ($subject->subject_level == 'MYP') {
                foreach ($request->input('criteria') as $criteriaId => $criteriaData) {
                    $criteria = MYPCriteria::find($criteriaId);
                    if ($criteria) {
                        $criteria->criteria_name = $criteriaData['name'] ?? $criteria->criteria_name;
                        $criteria->save();
    
                        foreach ($criteriaData['ranges'] as $detailId => $detailData) {
                            $detail = MYPCriteriaDetail::find($detailId);
                            if ($detail) {
                                $detail->criteria_range = $detailData['range'] ?? $detail->criteria_range;
                                $detail->criteria_range_desc = $detailData['description'] ?? $detail->criteria_range_desc;
                                $detail->save();
                            } else {
                                return back()->withErrors(['error' => "Criteria detail with ID {$detailId} not found."]);
                            }
                        }
                    } else {
                        return back()->withErrors(['error' => "Criteria with ID {$criteriaId} not found."]);
                    }
                }
            }
    
            if ($role == 0) { // admin
                return redirect()->route('subject', ['userId' => $teacher->user_id])->with('status', 'Subject updated successfully!');
            }
        } else {
            return back()->withInput()->withErrors(['error' => 'Failed to update subject. Please try again.']);
        }
    }



    public function delete($userId, $subjectId)
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
        $subject = SubjectModel::get()
        ;
        $delSub = SubjectModel::find($subjectId);
        $delSub->delete();

        $role = User::find($authUserId)->role;

        if ($role == 0) {  // admin
            return view('subject-admin', compact('teacher', 'subject'));
        }
    }

}


