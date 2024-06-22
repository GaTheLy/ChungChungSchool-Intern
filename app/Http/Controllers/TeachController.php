<?php

namespace App\Http\Controllers;

use App\Models\StudentPyp; // Make sure to import the model
use Illuminate\Http\Request;

class TeachController extends Controller
{
    public function index()
    {
        // Fetch the first student as an example
        $student = StudentPyp::first();

        // Pass the student data to the view
        return view('/dash-teacher', ['student' => $student]);
    }
}
