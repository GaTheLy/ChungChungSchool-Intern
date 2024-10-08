<?php

namespace App\Http\Controllers;

use App\Models\ConversionMYP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use PDF;

use App\Models\User;
use App\Models\StudentPyp;
use App\Models\SubjectTeacher;
use App\Models\SubjectModel;
use App\Models\CustomReport;

class ReportController extends Controller
{
    public function previewReport($id){

        $student = StudentPyp::with(['class.homeroom.teacher'])->findOrFail($id);

        // Subjects
        $sub_teacherIds = DB::table('subject_class_teacher')
            ->where('class_id', $student->class->first()->class_id)
            ->distinct()
            ->pluck('subject_teacher_id');

        $subjectIds = DB::table('sub_teacher')
            ->whereIn('sub_teacher_id', $sub_teacherIds)
            ->pluck('subject_pyp_id');

        $subjects = SubjectModel::findOrFail($subjectIds);

        //Grades
        $subject_teacher_s = SubjectTeacher::whereIn('sub_teacher_id', $sub_teacherIds)
            ->with(['subject.mypCriteria.mypCriteriaGrades' => function ($query) use ($id) {
                $query->where('student_id', $id);
            }])
            ->get();

        // Subject Progress
        foreach($subject_teacher_s as $subject_teacher){
            $subject_teacher->subject->progress = DB::table('subject_progress')
                ->where('subject_id', $subject_teacher->subject_pyp_id)
                ->first();

            $subject_teacher->subject->atls = DB::table('sub_atl_myp')
            ->where('subject_id', $subject_teacher->subject_pyp_id)
            ->get();

            foreach($subject_teacher->subject->atls as $atl){
                $atl->progress = DB::table('sub_atl_progress_myp')
                ->where('sub_atl_id', $atl->id)
                ->first();
            }
        }
        
        // Attendance
        $attendance = DB::table('attendance_pyp')
            ->where('student_id', $student->nim_pyp)
            ->selectRaw('SUM(present) as total_present, SUM(late) as total_late, SUM(absent) as total_absent, SUM(sick) as total_sick, SUM(excused) as total_excused')
            ->first();

        // Teacher Comment
        $comment = DB::table('homeroom_teacher_comment')
        ->where('student_id', $student->nim_pyp)
        ->first();

        // dd($units);
        $custom = CustomReport::where('id', 2)->first();

        $filename = $custom ? $custom->logopath : 'ccs-logo.jpg'; // default to 'ccs-logo.jpg' if not set
        $greetings = $custom->greetings;

        $filenameSign = $custom ? $custom->signpath : 'ccs-logo.jpg'; // default to 'ccs-logo.jpg' if not set

        $html = view('reports.report-myp', compact('student', 'subject_teacher_s', 'attendance', 'comment', 'filename', 'greetings','filenameSign', 'custom'));

        $pdf = PDF::loadHtml($html);

        // Return the PDF for download or inline display

        // dd($subject_teacher_s);

        // return $pdf->stream('report.pdf');
        return $pdf->stream('report.pdf');
    }

    public function previewReportConversionMYP($id){

        $student = StudentPyp::with(['class.homeroom.teacher'])->findOrFail($id);

        // Subjects
        $sub_teacherIds = DB::table('subject_class_teacher')
            ->where('class_id', $student->class->first()->class_id)
            ->distinct()
            ->pluck('subject_teacher_id');

        $subjectIds = DB::table('sub_teacher')
            ->whereIn('sub_teacher_id', $sub_teacherIds)
            ->pluck('subject_pyp_id');

        $subjects = SubjectModel::findOrFail($subjectIds);

        //Grades
        $subject_teacher_s = SubjectTeacher::whereIn('sub_teacher_id', $sub_teacherIds)
            ->with(['subject.mypCriteria.mypCriteriaGrades' => function ($query) use ($id) {
                $query->where('student_id', $id);
            }])
            ->get();

        // Fetch the conversion data
        $conversions = ConversionMYP::get();

        // Subject Progress
        foreach($subject_teacher_s as $subject_teacher){
            $subject_teacher->subject->progress = DB::table('subject_progress')
                ->where('subject_id', $subject_teacher->subject_pyp_id)
                ->first();

            $subject_teacher->subject->atls = DB::table('sub_atl_myp')
            ->where('subject_id', $subject_teacher->subject_pyp_id)
            ->get();

            foreach($subject_teacher->subject->atls as $atl){
                $atl->progress = DB::table('sub_atl_progress_myp')
                ->where('sub_atl_id', $atl->id)
                ->first();
            }
        }
        
        // Attendance
        $attendance = DB::table('attendance_pyp')
            ->where('student_id', $student->nim_pyp)
            ->selectRaw('SUM(present) as total_present, SUM(late) as total_late, SUM(absent) as total_absent, SUM(sick) as total_sick, SUM(excused) as total_excused')
            ->first();

        // Teacher Comment
        $comment = DB::table('homeroom_teacher_comment')
        ->where('student_id', $student->nim_pyp)
        ->first();

        // dd($units);
        $custom = CustomReport::where('id', 2)->first();

        $filename = $custom ? $custom->logopath : 'ccs-logo.jpg'; // default to 'ccs-logo.jpg' if not set
        $greetings = $custom->greetings;

        $filenameSign = $custom ? $custom->signpath : 'ccs-logo.jpg'; // default to 'ccs-logo.jpg' if not set

        

        $html = view('reports.conversion-report-myp', compact('student', 'subject_teacher_s', 'attendance', 'comment', 'filename', 'greetings','filenameSign', 'custom', 'conversions'));

        $pdf = PDF::loadHtml($html);

        // Return the PDF for download or inline display

        // dd($subject_teacher_s);

        // return $pdf->stream('report.pdf');
		
		return $html;
    }

    public function previewReportPyp($id){
        $student = StudentPyp::with(['class.homeroom.teacher'])->findOrFail($id);

        //Grades/ Criteria Progress
        $sub_teacherIds = DB::table('subject_class_teacher')
            ->where('class_id', $student->class->first()->class_id)
            ->distinct()
            ->pluck('subject_teacher_id');

            $subjectIds = DB::table('sub_teacher')
            ->whereIn('sub_teacher_id', $sub_teacherIds)
            ->pluck('subject_pyp_id');

        $subjects = SubjectModel::findOrFail($subjectIds);

        $subject_teacher_s = SubjectTeacher::whereIn('sub_teacher_id', $sub_teacherIds)
            ->with(['subject.pypCriteria.pypCriteriaProgress' => function ($query) use ($id) {
                $query->where('student_id', $id);
            }])
            ->get();

        // Attendance
        $attendance = DB::table('attendance_pyp')
            ->where('student_id', $student->nim_pyp) // Nambah where buat date jadi date yang dicount between year_prog start date & end date
            ->selectRaw('SUM(present) as total_present, SUM(late) as total_late, SUM(absent) as total_absent, SUM(sick) as total_sick, SUM(excused) as total_excused')
            ->first();

        // Teacher Comment
        $comment = DB::table('homeroom_teacher_comment')
        ->where('student_id', $student->nim_pyp)
        ->first();

        // Unit Progress
        $units = DB::table('unit')
        ->join('unit_progress', 'unit.unit_id', '=', 'unit_progress.unit_id')
        ->where('student_id', $student->nim_pyp)
        ->select('unit.*', 'unit_progress.*')
        ->get();

        foreach ($units as $unit) {
            $unit->key_concepts = DB::table('key_concept')
                ->where('unit_id', $unit->unit_id)
                ->get();

            $unit->line_of_inquiries = DB::table('lines_of_inquiry')
                ->where('unit_id', $unit->unit_id)
                ->get();
        }

        // ATL
        $atls = DB::table('approach_to_learning')
        ->join('atl_progress', 'approach_to_learning.atl_id', '=', 'atl_progress.atl_id')
        ->where('atl_progress.student_id', $student->nim_pyp)
        ->select(
            'approach_to_learning.*',
            'atl_progress.description as atl_progress_description',
            'approach_to_learning.description as approach_description'
        )
        ->get();

        // dd($units);
        $custom = CustomReport::where('id', 1)->first();

        $filename = $custom ? $custom->logopath : 'ccs-logo.jpg'; // default to 'ccs-logo.jpg' if not set
        $greetings = $custom->greetings;

        $filenameSign = $custom ? $custom->signpath : 'ccs-logo.jpg'; // default to 'ccs-logo.jpg' if not set

        $html = view('reports.report-pyp', compact('student', 'subject_teacher_s', 'attendance', 'comment', 'units', 'filename', 'greetings','filenameSign', 'custom','atls'));

        $pdf = PDF::loadHtml($html);

        // return $pdf->stream('report.pdf');
		
		return $html;

    }

    public function mypCustom($userId){
        $authUserId = Auth::id();

        // Check if the authenticated user's ID matches the requested user ID
        if ($authUserId != $userId) {
            // Redirect to the authenticated user's dashboard
            return redirect()->route('dashboard', ['userId' => $authUserId]);
        }

        // Fetch the authenticated user
        $user = Auth::user();

        $teacher = $user->teacher;
        
        $custom = CustomReport::where('id', 2)->first();

        $filename = $custom ? $custom->logopath : 'ccs-logo.jpg'; // default to 'ccs-logo.jpg' if not set

        $greetings = $custom->greetings;

        $filenameSign = $custom ? $custom->signpath : 'ccs-logo.jpg'; 

        $conversion = ConversionMYP::get();
        $teacher = $user->teacher;
        
        $role = User::find($authUserId)->role;

        if ($role == 0) { // admin
            return view('admin/report-custom/myp-report', compact('teacher', 'filename', 'greetings', 'filenameSign','custom','conversion'));
        }

    }

    public function editMypCustom(Request $request, $userId)
    {
        // Validate the uploaded file
        $authUserId = Auth::id();

        if ($authUserId != $userId) {
            return redirect()->route('dashboard', ['userId' => $authUserId]);
        }
    
        $user = Auth::user();
        $teacher = $user->teacher;
        $role = User::find($authUserId)->role;
        $newdata = CustomReport::where('id', 2)->first();
        $filename=$newdata->logopath;
        $filenameSign=$newdata->signpath;
        if ($request->hasFile('logo')) {
            $logoFile = $request->file('logo');
            $extension = $logoFile->getClientOriginalExtension();
            $filename = 'custom-logo-' . $authUserId . '.' . $extension;
            $path = public_path('assets-image/');
            $logoFile->move($path, $filename);
        }

        if ($request->hasFile('sign')){
            $signFile = $request->file('sign');
            $extension = $signFile->getClientOriginalExtension();
            $filenameSign = 'custom-sign-' . $authUserId . '.' . $extension;
            $path = public_path('assets-image/');
            $signFile->move($path, $filenameSign);
        }
        
            $newdata->logopath = $filename;
            $newdata->greetings = $request->greetings;
            $newdata->signpath = $filenameSign;
            $newdata->attendance = $request->input('attendance');
            $newdata->atl = $request->input('atl');
            $newdata->subjects = $request->input('subjects');
            $newdata->summary_progress = $request->input('summary_proggress');
            $newdata->grade_boundaries = $request->input('boundaries');
            $newdata->achievement_descriptors = $request->input('achievement_desc');

        
            $conversions = $request->input('conversions');

        foreach ($conversions as $id => $data) {
            // Validate the local_grade for each conversion
            // $request->validate([
            //     "conversions.$id.local_grade" => 'required|numeric',
            // ]);

            // Find the record by ID and update the local_grade
            $conversion = ConversionMYP::findOrFail($id);
            $conversion->local_grade = $data['local_grade'];
            $conversion->save();
        }
    
        if ($role == 0 && $newdata->save()) { // admin
            return redirect()->route('mypCustom.show', ['userId' => $authUserId]);
        }
    }


    public function pypCustom($userId){
        $authUserId = Auth::id();

        // Check if the authenticated user's ID matches the requested user ID
        if ($authUserId != $userId) {
            // Redirect to the authenticated user's dashboard
            return redirect()->route('dashboard', ['userId' => $authUserId]);
        }

        // Fetch the authenticated user
        $user = Auth::user();
        $custom = CustomReport::where('id', 1)->first();

        $filename = $custom ? $custom->logopath : 'ccs-logo.jpg'; // default to 'ccs-logo.jpg' if not set

        $greetings = $custom->greetings;

        $filenameSign = $custom ? $custom->signpath : 'ccs-logo.jpg'; 

        $teacher = $user->teacher;
        
        $role = User::find($authUserId)->role;

        if ($role == 0) { // admin
            return view('admin/report-custom/pyp-report', compact('teacher', 'filename', 'greetings', 'filenameSign','custom'));
        }

    }

    public function editPypCustom(Request $request, $userId)
    {
        // Validate the uploaded file
        $authUserId = Auth::id();

        if ($authUserId != $userId) {
            return redirect()->route('dashboard', ['userId' => $authUserId]);
        }
    
        $user = Auth::user();
        $teacher = $user->teacher;
        $role = User::find($authUserId)->role;
        $newdata = CustomReport::where('id', 1)->first();
        $filename=$newdata->logopath;
        $filenameSign=$newdata->signpath;
        if ($request->hasFile('logo')) {
            $logoFile = $request->file('logo');
            $extension = $logoFile->getClientOriginalExtension();
            $filename = 'custom-logo-' . $authUserId . '.' . $extension;
            $path = public_path('assets-image/');
            $logoFile->move($path, $filename);
        }

        if ($request->hasFile('sign')){
            $signFile = $request->file('sign');
            $extension = $signFile->getClientOriginalExtension();
            $filenameSign = 'custom-sign-' . $authUserId . '.' . $extension;
            $path = public_path('assets-image/');
            $signFile->move($path, $filenameSign);
        }
        
            $newdata->logopath = $filename;
            $newdata->greetings = $request->greetings;
            $newdata->signpath = $filenameSign;
            $newdata->central_idea = $request->input('central-idea');
            $newdata->lines_of_inquiry = $request->input('loi');
            $newdata->key_concepts = $request->input('key-concepts');
            $newdata->attendance = $request->input('attendance');
            $newdata->atl = $request->input('atl');
            $newdata->subjects = $request->input('subjects');


        
    
        if ($role == 0 && $newdata->save()) { // admin
            return redirect()->route('pypCustom.show', ['userId' => $authUserId]);
        }
    }

    
}
