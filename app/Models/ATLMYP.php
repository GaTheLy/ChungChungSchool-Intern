<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ATLMYP extends Model
{
    public $timestamps = false;

    protected $table = 'sub_atl_myp';

    // Define the primary key if it's not 'id'
    // protected $primaryKey = 'atl_id';

    // Define the fillable fields
    protected $fillable = ['atl_name','subject_id'];

    // Define the relationships
    public function subject()
    {
        return $this->belongsTo(SubjectModel::class, 'subject_id', 'id');
    }
}
