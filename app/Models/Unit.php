<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'unit';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'unit_id';

    // Define the fillable fields
    protected $fillable = ['name, year_program_pyp_id'];

    // Define the relationship 
    public function yearProgramPYP()
    {
        return $this->belongsTo(YearProgramPYP::class, 'year_program_pyp_id');
    }

    // Relationship with LinesOfInquiry
    public function linesOfInquiry()
    {
        return $this->hasMany(LinesOfInquiry::class, 'unit_id');
    }

    // Relationship with KeyConcept
    public function keyConcepts()
    {
        return $this->hasMany(KeyConcept::class, 'unit_id');
    }
    

}
