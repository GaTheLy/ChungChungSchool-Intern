<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectCriteriaDescriptor extends Model
{
    use HasFactory;
    protected $table = 'criteria_descriptor';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'id';

    // Define the fillable fields
    protected $fillable = ['criteria_title, criteria_name,criteria_range,criteria_desc,subject_id'];

    // Define the relationship with Homeroom
    public function sub_teacher()
    {
        return $this->belongsTo(SubjectModel::class, 'subject_pyp_id');
    }

}

