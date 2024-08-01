<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boundaries extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'boundaries';

    protected $fillable = [
        'start_1', 'end_1', 'start_2', 'end_2', 
        'start_3', 'end_3', 'start_4', 'end_4', 
        'start_5', 'end_5', 'start_6', 'end_6', 
        'start_7', 'end_7', 'start_8', 'end_8', 
        'yp_myp_id'
    ];

    public function yearProgMYP()
    {
        return $this->belongsTo(YearProgramMYP::class, 'yp_myp_id');
    }
}
