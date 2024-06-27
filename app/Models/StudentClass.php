<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    use HasFactory;

    protected $table = 'student_class';

    protected $primaryKey = 'student_class_id';

    protected $fillable = [
        'class_id',
        'student_id',
    ];
}