<?php

// app/Http/Controllers/ClassController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    public function show($id)
    {
        $class = ClassModel::findOrFail($id);
        // Assuming you have related models like students or subjects
        // Assuming $students is already fetched
        $students = $class->students;
        // $subjects = $class->subjects;
        foreach ($students as $student) {
            // Fetch existing attendance data for the student
            $attendance = DB::table('attendance_pyp')
                ->where('student_id', $student->nim_pyp)
                ->first(); // Assuming only one attendance record per student
    
        $student->attendance = $attendance; // Assigning attendance data to each student
        }
        return view('homeroom-teacher-pyp', compact('class', 'students'));
    }
}
