<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailClassPYP extends Model
{
    public $timestamps = false;

    protected $table = 'detail_class_pyp';

    // Define the primary key if it's not 'id'

    // Define the fillable fields
    protected $fillable = ['year_program_pyp_id','class_id','start_date','end_date'];

    // Define the relationship with Homeroom

    public function yearProgramPYP()
    {
        return $this->belongsTo(YearProgramPYP::class, 'year_program_pyp_id');
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }


}
