<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeroomController extends Controller
{
    // Attendance
    public function savePyp(Request $request)
    {
        $data = $request->json()->all();

        foreach ($data as $attendance) {
            DB::table('attendance_pyp')->updateOrInsert(
                ['student_id' => $attendance['student_id'], 'date' => $attendance['date']],
                [
                    'present' => $attendance['present'],
                    'late' => $attendance['late'],
                    'absent' => $attendance['absent'],
                    'excused' => $attendance['excused'],
                    'sick' => 0,
                ]
            );
        }

        return response()->json(['success' => true]);
    }

    public function getAttendanceByDate(Request $request, $classId)
    {
        $date = $request->input('date');

        $attendanceRecords = DB::table('attendance_pyp')
            ->join('student_class', 'attendance_pyp.student_id', '=', 'student_class.nim_pyp')
            ->join('student_pyp', 'attendance_pyp.student_id', '=', 'student_pyp.nim_pyp')
            ->where('date', $date)
            ->where('student_class.class_id', $classId)
            ->get();
        
        if (!$attendanceRecords){
            $attendanceRecords = DB::table('attendance_pyp')
            ->join('student_class', 'attendance_pyp.student_id', '=', 'student_class.nim_pyp')
            ->join('student_pyp', 'attendance_pyp.student_id', '=', 'student_pyp.nim_pyp')
            ->where('student_class.class_id', $classId)
            ->get();
        }

        // dd($attendanceRecords);
        return response()->json($attendanceRecords);
    }


    // Unit Progress
    public function saveUnitProg(Request $request)
    {
        $unitProgressData = $request->json()->all();

        foreach ($unitProgressData as $progress) {
            DB::table('unit_progress')->updateOrInsert(
                [
                    'student_id' => $progress['student_id'],
                    'unit_id' => $progress['unit_id'],
                ],
                [
                    'description' => $progress['performance'],
                ]
            );
        }

        return response()->json(['message' => 'Unit progress saved successfully.']);
    }

    public function getUnitProgress($unitId, $classId)
    {
        $unitProgress = DB::table('unit_progress')
        ->join('student_class', 'unit_progress.student_id', '=', 'student_class.nim_pyp')
        ->join('student_pyp', 'unit_progress.student_id', '=', 'student_pyp.nim_pyp')
        ->where('unit_progress.unit_id', $unitId)
        ->where('student_class.class_id', $classId)
        ->select('unit_progress.*', 'student_pyp.first_name', 'student_pyp.last_name')
        ->get();
        // dd($unitProgress);

        return response()->json($unitProgress);
    }


    public function getStudentsByClass($classId)
    {
        // Fetch students based on classId
        $students = DB::table('student_pyp')
            ->join('student_class', 'student_pyp.nim_pyp', '=', 'student_class.nim_pyp')
            ->where('class_id', $classId)
            ->get(); // Modify fields as needed
        
            logger()->info('Fetched students:', ['students' => $students]);

        return response()->json($students);
    }

    // Homeroom Teacher's Comment
    public function saveComments(Request $request)
    {
        $comments = $request->input('comments', []);

        foreach ($comments as $studentId => $comment) {
            DB::table('homeroom_teacher_comment')->updateOrInsert(
                ['student_id' => $studentId],
                ['description' => $comment]
            );
        }

        return response()->json(['success' => true]);
    } 

    // ATL Progress
    public function saveAtlProg(Request $request)
    {


        $atlProgressData = $request->json()->all();

        foreach ($atlProgressData as $progress) {
            DB::table('atl_progress')->updateOrInsert(
                [
                    'student_id' => $progress['student_id'],
                    'atl_id' => $progress['atl_id'],
                ],
                [
                    'description' => $progress['performance'],
                ]
            );
        }

        return response()->json(['message' => 'ATL progress saved successfully.']);
    }

    public function getAtlProgress($atlId, $classId)
    {

        $atlProgress = DB::table('atl_progress')
            ->join('student_class', 'atl_progress.student_id', '=', 'student_class.nim_pyp')
            ->where('atl_progress.atl_id', $atlId)
            ->where('student_class.class_id', $classId)
            ->select('atl_progress.*')
            ->get();


        return response()->json($atlProgress);
    }


}
