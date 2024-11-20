<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubTeachCrit extends Model
{
    public $timestamps = false;

    protected $table = 'sub_teach_criteria';

    // Define the primary key if it's not 'id'

    // Define the fillable fields
    protected $fillable = ['sub_teach_id','sub_crit_id'];

    // Define the relationship with Homeroom
    public function subTeach()
    {
        return $this->belongsTo(SubjectTeacher::class, 'sub_teach_id');
    }

    public function subCrit()
    {
        return $this->belongsTo(PYPCriteria::class, 'sub_crit_id');
    }
}
