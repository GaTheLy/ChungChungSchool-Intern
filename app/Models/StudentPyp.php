<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPyp extends Model
{
    public $timestamps = false;

    protected $table = 'student_pyp';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'nim_pyp';

    // Define the fillable fields
    protected $fillable = ['nim_pyp','first_name', 'last_name', 'dob', 'address', 'fathers_name', 'mothers_name', 'fathers_phone', 'mothers_phone', 'parents_email', 'previous_school', 'entry_date', 'level'];

    // Define the relationship with ClassModel (if needed)
    public function classes()
    { 
        return $this->belongsToMany(ClassModel::class, 'student_class', 'student_id', 'class_id');
    }

    


}
