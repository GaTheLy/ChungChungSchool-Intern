<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SubjectModel extends Model
{
    use HasFactory;
    protected $table = 'subjects';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'id';

    // Define the fillable fields
    protected $fillable = [' subject_name, subject_level','created_at', 'updated_at' ];

    public function pypCriteria()
    {
        return $this->hasMany(PYPCriteria::class, 'subject_pyp_id','id');
    }
    public function mypCriteria()
    {
        return $this->hasMany(MYPCriteria::class, 'subject_id','id');
    }
    public function classes()
    {
        return $this->belongsToMany(ClassModel::class, 'subject_class', 'subject_pyp_id', 'class_id');
    }

    public function criteria()
    {
        return $this->hasMany(Criteria::class, 'subject_pyp_id');
    }
}

