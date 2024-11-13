<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'student_class';

    protected $primaryKey = 'id';

    protected $fillable = [
        'class_id',
        'nim_pyp',
    ];

    /**
     * Get the class that owns the student.
     */
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    /**
     * Get the student that belongs to the class.
     */
    public function student()
    {
        return $this->belongsTo(StudentPyp::class, 'nim_pyp');
    }

    // In StudentClass model
    public function homeroomComments()
    {
        return $this->hasMany(HomeroomComments::class, 'student_id', 'nim_pyp');
    }

}
