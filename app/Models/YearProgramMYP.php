<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YearProgramMYP extends Model
{
    public $timestamps = false;

    protected $table = 'year_program_myp';

    // Define the primary key if it's not 'id'

    // Define the fillable fields
    protected $fillable = ['name'];

    // Define the relationship with Homeroom
    public function detailSubjects()
    {
        return $this->hasMany(DetailSubjectMYP::class, 'id');
    }
    

}
