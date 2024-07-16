<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectTeacher extends Model
{
    use HasFactory;
    protected $table = 'sub_teacher';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'sub_teacher_id';

    // Define the fillable fields
    protected $fillable = ['teacher_id', 'subject_pyp_id'];

    // Define the relationship with TeacherPyp
    public function teacher()
    {
        return $this->belongsTo(TeacherPyp::class, 'teacher_id', 'nip_pyp', 'teacher_pyp');
    }

    // Define the relationship with ClassModel
    public function classes()
    {
        return $this->belongsToMany(ClassModel::class, 'subject_class_teacher', 'subject_teacher_id', 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(SubjectModel::class, 'subject_pyp_id', 'id');
    }

    public function getFormattedCriteria()
    {
        $criteria = 
        $formattedCriteria = '';

        foreach ($this->subject->criteria as $criterion) {
            $formattedCriteria .= '<td>5</td>'; // Replace '5' with your actual criterion data
        }

        return $formattedCriteria;
    }
}
