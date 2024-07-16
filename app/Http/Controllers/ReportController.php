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

        $subject_teacher_s = SubjectTeacher::whereIn('sub_teacher_id', $sub_teacherIds)
            ->with(['subject.mypCriteria.mypCriteriaGrades' => function ($query) use ($id) {
                $query->where('student_id', $id);
            }])
            ->get();

        //Grades
        

        $attendance = DB::table('attendance_myp')
                ->where('student_id', $student->nim_pyp)
                ->first();

        $html = view('reports.report-myp', compact('student', 'subject_teacher_s', 'attendance'))->render();

        $pdf = PDF::loadHtml($html);

        // Return the PDF for download or inline display

        // dd($subject_teacher_s);

        return $pdf->stream('report.pdf');
    }
}
