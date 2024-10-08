<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherPyp extends Model
{
    public $timestamps = false;

    protected $table = 'teacher_pyp';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'nip_pyp';

    // Define the fillable fields
    protected $fillable = ['nip_pyp','first_name', 'last_name', 'user_id', 'phone', 'address', 'joined_at'];

    // Define the relationship with Homeroom
    public function homerooms()
    {
        return $this->hasMany(Homeroom::class, 'teacher_pyp_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
