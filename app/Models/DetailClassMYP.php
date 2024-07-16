<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailClassMYP extends Model
{
    public $timestamps = false;

    protected $table = 'detail_subject_myp';

    // Define the primary key if it's not 'id'

    // Define the fillable fields
    protected $fillable = ['year_program_myp_id','class_id','start_date','end_date'];

    // Define the relationship with Homeroom

    public function yearProgramMYP()
    {
        return $this->belongsTo(YearProgramMYP::class, 'year_program_myp_id');
    }

    public function classes()
    {
        return $this->hasMany(ClassModel::class, 'class_id');
    }

}
