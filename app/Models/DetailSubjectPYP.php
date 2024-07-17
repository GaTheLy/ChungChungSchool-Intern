<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailSubjectPYP extends Model
{
    public $timestamps = false;

    protected $table = 'detail_subject_pyp';

    // Define the primary key if it's not 'id'

    // Define the fillable fields
    protected $fillable = ['year_program_pyp_id','subject_id', 'teacher_id'];

    // Define the relationship with Homeroom

    public function yearProgramPYP()
    {
        return $this->belongsTo(YearProgramPYP::class, 'year_program_pyp_id');
    }

    public function subject()
    {
        return $this->belongsTo(SubjectModel::class, 'subject_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo(TeacherPyp::class, 'teacher_id', 'nip_pyp');
    }

}
