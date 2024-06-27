<?php

// app/Http/Controllers/ClassController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;

class ClassController extends Controller
{
    public function show($id)
    {
        $class = ClassModel::findOrFail($id);
        // Assuming you have related models like students or subjects
        $students = $class->students;
        // $subjects = $class->subjects;

        return view('homeroom-teacher-pyp', compact('class', 'students'));
    }
}
