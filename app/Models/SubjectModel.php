<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectModel extends Model
{
    use HasFactory;
    protected $table = 'subject_pyp';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'subject_pyp_id';

    // Define the fillable fields
    protected $fillable = ['subject_name'];

    // Define the relationship with Homeroom
    public function sub_teacher()
    {
        return $this->hasMany(SubjectTeacher::class, 'subject_pyp_id');
    }

    public function classes()
    {
        return $this->belongsToMany(ClassModel::class, 'subject_class', 'subject_pyp_id', 'class_id');
    }
}

