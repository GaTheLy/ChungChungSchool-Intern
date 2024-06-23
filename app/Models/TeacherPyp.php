<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherPyp extends Model
{
    protected $table = 'teacher_pyp';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'teacher_pyp_id';

    // Define the fillable fields
    protected $fillable = ['first_name', 'last_name', 'subject'];

    // Define the relationship with Homeroom
    public function homerooms()
    {
        return $this->hasMany(Homeroom::class, 'teacher_pyp_id');
    }
}
