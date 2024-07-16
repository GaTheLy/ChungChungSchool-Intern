<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MYPCriteria extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'sub_criteria_myp';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'id';

    // Define the fillable fields
    protected $fillable = ['criteria_title, criteria_name, subject_id'];

    // Define the relationship with Homeroom
    public function sub_critMYP()
    {
        return $this->belongsTo(SubjectModel::class, 'subject_id','id');
    }

    public function mypCriteriaDetail()
    {
        return $this->hasMany(MYPCriteriaDetail::class, 'sub_criteria_myp_id','id');
    }

    public function mypCriteriaGrades()
    {
        return $this->hasMany(MYPCriteriaGrade::class, 'sc_myp_id','id');
    }

}

