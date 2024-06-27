<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPyp extends Model
{
    protected $table = 'student_pyp';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'nim_pyp';

    // Define the fillable fields
    protected $fillable = ['first_name', 'last_name', 'dob'];

    // Define the relationship with ClassModel (if needed)
    public function classes()
    { 
        return $this->belongsToMany(ClassModel::class, 'student_class', 'student_id', 'class_id');
    }
}
