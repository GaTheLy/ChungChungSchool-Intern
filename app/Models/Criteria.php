<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $table = 'sub_criteria_pyp';

    protected $fillable = ['crit_name', 'subject_pyp_id', 'report_id'];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_pyp_id');
    }
}
