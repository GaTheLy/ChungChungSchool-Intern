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
                    'sick' => $attendance['sick'],
                    'absent' => $attendance['absent'],
                    'excused' => $attendance['excused']
                ]
            );
        }

        return response()->json(['success' => true]);
    }

    public function getAttendanceByDate(Request $request, $classId)
    {
        $date = $request->input('date');

        $attendanceRecords = DB::table('attendance_pyp')
            ->join('student_pyp', 'attendance_pyp.student_id', '=', 'student_pyp.nim_pyp')
            ->where('date', $date)
            ->where('student_pyp.class_id', $classId)
            ->get();

        dd($attendanceRecords);
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
        ->join('student_pyp', 'unit_progress.student_id', '=', 'student_pyp.nim_pyp')
        ->where('unit_progress.unit_id', $unitId)
        ->where('student_pyp.class_id', $classId)
        ->select('unit_progress.*', 'student_pyp.first_name', 'student_pyp.last_name')
        ->get();
        // dd($unitProgress);

        return response()->json($unitProgress);
    }


    public function getStudentsByClass($classId)
    {
        // Fetch students based on classId
        $students = DB::table('student_pyp')
            ->where('class_id', $classId)
            ->get(['nim_pyp', 'first_name', 'last_name']); // Modify fields as needed

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

    public function getComments($classId) {
        \Log::info('getComments called with classId: ' . $classId);

        try {
            $comments = DB::table('homeroom_teacher_comment')
                        ->join('student_pyp', 'homeroom_teacher_comment.student_id', '=', 'student_pyp.nim_pyp')
                        ->where('student_pyp.class_id', $classId)
                        ->select('homeroom_teacher_comment.description', 'student_pyp.nim_pyp')
                        ->get();

            \Log::info('Comments fetched: ', $comments->toArray());

            return response()->json($comments);
        } catch (\Exception $e) {
            \Log::error('Error fetching comments: ' . $e->getMessage());
            return response()->json(['error' => 'Error fetching comments'], 500);
        }
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
            ->join('student_pyp', 'atl_progress.student_id', '=', 'student_pyp.nim_pyp')
            ->where('atl_progress.atl_id', $atlId)
            ->where('student_pyp.class_id', $classId)
            ->select('atl_progress.*', 'student_pyp.first_name', 'student_pyp.last_name')
            ->get();

        // Debug the SQL query

        // Debug the result

        return response()->json($atlProgress);
    }


}
