<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeroomController extends Controller
{
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

    // In HomeroomController.php
    public function getUnitProgress($unitId)
    {
        $unitProgress = DB::table('unit_progress')
            ->where('unit_progress.unit_id', $unitId)
            ->get();

        // dd($unitProgress);

        return response()->json($unitProgress);
    }

}
