<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinesOfInquiry extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'lines_of_inquiry';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'lines_of_inquiry_id';


    // Define the fillable fields
    protected $fillable = ['description, unit_id'];

    // Define the relationship
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
