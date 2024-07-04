<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MYPCriteriaDetail extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'sub_criteria_myp_detail';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'id';

    // Define the fillable fields
    protected $fillable = ['criteria_range, criteria_range_desc, sub_criteria_myp_id'];

    // Define the relationship with Homeroom
    public function mypCriteria()
    {
        return $this->belongsTo(MYPCriteria::class, 'sub_criteria_myp_id', 'id');
    }

}

