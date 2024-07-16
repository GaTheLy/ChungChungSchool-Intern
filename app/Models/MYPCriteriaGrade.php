<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MYPCriteriaGrade extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'subject_crit_grade_myp';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'id';

    // Define the fillable fields
    protected $fillable = ['crit_grade, sc_myp_id, student_id'];

    // Define the relationship with Homeroom
    public function student()
    {
        return $this->belongsTo(StudentPyp::class, 'student_id');
    }

    public function mypCriteria()
    {
        return $this->belongsTo(MYPCriteria::class, 'sc_myp_id', 'id');
    }


}

