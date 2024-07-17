<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PYPCriteria extends Model
{
    use HasFactory;
    protected $table = 'sub_criteria_pyp';

    public $timestamps = false;

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'sc_pyp_id';

    // Define the fillable fields
    protected $fillable = ['sc_pyp_id, crit_name, subject_pyp_id, criteria_descriptor'];

    // Define the relationship with Homeroom
    public function subject()
    {
        return $this->belongsTo(SubjectModel::class, 'subject_pyp_id', 'id');
    }

    public function pypCriteriaProgress()
    {
        return $this->hasMany(PYPCriteriaProgress::class, 'sc_pyp_id', 'sc_pyp_id');
    }
}

