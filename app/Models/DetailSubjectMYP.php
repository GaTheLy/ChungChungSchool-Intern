<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailSubjectMYP extends Model
{
    public $timestamps = false;

    protected $table = 'detail_subject_myp';

    // Define the primary key if it's not 'id'

    // Define the fillable fields
    protected $fillable = ['year_program_myp_id','subject_id', 'teacher_id'];

    // Define the relationship with Homeroom

    public function yearProgramMYP()
    {
        return $this->belongsTo(YearProgramMYP::class, 'year_program_myp_id');
    }

    public function subjects()
    {
        return $this->hasMany(SubjectModel::class, 'subject_id');
    }

}
