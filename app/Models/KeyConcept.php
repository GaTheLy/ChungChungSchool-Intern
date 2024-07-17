<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyConcept extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'key_concept';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'key_concept_id';


    // Define the fillable fields
    protected $fillable = ['topic, question, definition, icon, unit_id'];

    // Define the relationship
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
