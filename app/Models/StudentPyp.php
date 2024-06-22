<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPyp extends Model
{
    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'student_pyp';

    // Define the fillable fields
    protected $fillable = ['nim_pyp', 'first_name', 'last_name', 'dob'];
}
