<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeroomComments extends Model
{
    protected $table = 'homeroom_teacher_comment';

    public $timestamps = false;

    // Define the primary key if it's not 'id'

    // Define the fillable fields
    protected $fillable = ['description', 'student_id'];

    // Define the relationship with TeacherPyp
    public function student()
    {
        return $this->belongsTo(StudentPyp::class, 'student_foreignKey: nim_pyp', 'student_id');
    }
}
