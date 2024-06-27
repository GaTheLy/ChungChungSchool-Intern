<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectClass extends Model
{
    use HasFactory;
    protected $table = 'subject_class';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'subject_class_id';

    // Define the fillable fields
    protected $fillable = ['subject_pyp_id', 'class_id'];

}
