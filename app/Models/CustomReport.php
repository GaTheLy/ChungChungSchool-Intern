<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomReport extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'custom_report';

    // Define the primary key if it's not 'id'

    // Define the fillable fields
    protected $fillable = ['
    logopath, greetings, signpath, 
    prog_desc_path, ib_profile_path, central_idea, unit, lines_of_inquiry, key_concepts,
    atl,  
    subjects, homeroom_comments, attendance,
    summary_progress, grade_boundaries, achievement_descriptors
    '];

}

