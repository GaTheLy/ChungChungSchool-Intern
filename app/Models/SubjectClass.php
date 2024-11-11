<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectClass extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'subject_class_teacher';

    // Define the primary key if it's not 'id', it is id

    // Define the fillable fields
    protected $fillable = ['subject_teacher_id', 'class_id'];

}
