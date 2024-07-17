<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ATLPYP extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'approach_to_learning';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'atl_id';

    // Define the fillable fields
    protected $fillable = ['description, icon, year_program_pyp_id'];

    public function unit()
    {
        return $this->belongsTo(YearProgramPYP::class, 'id', 'year_program_pyp_id');
    }
}
