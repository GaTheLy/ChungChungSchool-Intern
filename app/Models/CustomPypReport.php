<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPypReport extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'custom_pyp_report';

    // Define the primary key if it's not 'id'

    // Define the fillable fields
    protected $fillable = ['logopath, greetings, signpath, prog_desc_path, ib_profile_path
    ,central_idea, unit, atl, lines_of_inquiry, key_concepts, subjects, homeroom_comments, attendance'];

}
