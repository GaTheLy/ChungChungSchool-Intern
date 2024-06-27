<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'class';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'class_id';

    // Define the fillable fields
    protected $fillable = ['class_name'];

    // Define the relationship with Homeroom
    public function homeroom()
    {
        return $this->hasOne(Homeroom::class, 'class_id');
    }

    public function students()
    {
        return $this->belongsToMany(StudentPyp::class, 'student_class', 'class_id', 'nim_pyp');
    }

    public function subjects()
    {
        return $this->belongsToMany(SubjectModel::class, 'subject_class', 'class_id', 'subject_pyp_id');
    }

    
}
