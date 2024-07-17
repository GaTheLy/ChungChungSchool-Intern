<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearProgramPYP extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'year_program_pyp';

    // Define the primary key if it's not 'id'

    // Define the fillable fields
    protected $fillable = ['name'];

    // Define the relationship with Homeroom
    public function unit()
    {
        return $this->hasMany(Unit::class, 'id');
    }

    public function atlpyp()
    {
        return $this->hasMany(ATLPYP::class, 'year_program_pyp_id', 'id');
    }
}
