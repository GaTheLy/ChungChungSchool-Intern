<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use PDF;

use App\Models\StudentPyp;
use App\Models\SubjectTeacher;
use App\Models\SubjectModel;


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
        
        // Attendance
        $attendance = DB::table('attendance_pyp')
            ->where('student_id', $student->nim_pyp)
            ->selectRaw('SUM(present) as total_present, SUM(late) as total_late, SUM(absent) as total_absent, SUM(sick) as total_sick, SUM(excused) as total_excused')
            ->first();

        // Teacher Comment
        $comment = DB::table('homeroom_teacher_comment')
        ->where('student_id', $student->nim_pyp)
        ->first();

        $html = view('reports.report-myp', compact('student', 'subject_teacher_s', 'attendance', 'comment'))->render();

        $pdf = PDF::loadHtml($html);

        // Return the PDF for download or inline display

        // dd($subject_teacher_s);

        return $pdf->stream('report.pdf');
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



        // dd($atls);

        $html = view('reports.report-pyp', compact('student', 'subject_teacher_s', 'attendance', 'comment', 'units', 'atls'))->render();

        $pdf = PDF::loadHtml($html);

        return $pdf->stream('report.pdf');

    }
}
