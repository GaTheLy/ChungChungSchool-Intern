<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PYPCriteriaProgress extends Model
{
    use HasFactory;
    protected $table = 'subject_crit_progress';

    public $timestamps = false;

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'scp_id';

    // Define the fillable fields
    protected $fillable = ['description, sc_pyp_id, student_id'];

    // Define the relationship with Homeroom

    public function student()
    {
        return $this->belongsTo(StudentPyp::class, 'student_id');
    }

    public function pypCriteria()
    {
        return $this->belongsTo(PYPCriteria::class, 'sc_pyp_id', 'sc_pyp_id');
    }

}

