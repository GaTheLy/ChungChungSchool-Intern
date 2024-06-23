<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'class';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'class_id';

    // Define the fillable fields
    protected $fillable = ['class_name'];

    // Define the relationship with Homeroom
    public function homerooms()
    {
        return $this->hasMany(Homeroom::class, 'class_id');
    }
}
