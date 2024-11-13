<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'class';
    public $timestamps = false;

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'class_id';

    // Define the fillable fields
    protected $fillable = ['class_name', 'class_level'];

    // Define the relationship with Homeroom
    public function homerooms()
    {
        return $this->hasMany(Homeroom::class, 'class_id');
    }

    public function students()
    {
        return $this->belongsToMany(StudentPyp::class, 'student_class', 'class_id', 'nim_pyp');
    }

    public function subjects()
    {
        return $this->belongsToMany(SubjectModel::class, 'subject_class', 'class_id', 'subject_pyp_id');
    }

    public function detailClassMYP()
    {
        return $this->belongsToMany(SubjectModel::class, 'subject_class', 'class_id', 'subject_pyp_id');
    }

    
}
