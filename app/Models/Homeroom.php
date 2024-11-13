<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Homeroom extends Model
{
    protected $table = 'homeroom';

    public $timestamps = false;

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'homeroom_id';

    // Define the fillable fields
    protected $fillable = ['teacher_pyp_id', 'class_id','role'];

    // Define the relationship with TeacherPyp
    public function teacher()
    {
        return $this->belongsTo(TeacherPyp::class, 'teacher_pyp_id', 'nip_pyp');
    }
    // Define the relationship with ClassModel
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id', 'class_id');
    }

}
