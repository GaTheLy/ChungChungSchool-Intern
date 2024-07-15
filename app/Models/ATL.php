<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ATL extends Model
{
    public $timestamps = false;

    protected $table = 'sub_atl_myp';

    // Define the primary key if it's not 'id'
    // protected $primaryKey = 'atl_id';

    // Define the fillable fields
    protected $fillable = ['atl_name','subject_id', 'atl_progress'];

    // Define the relationships

    public function detailSubjectMYP()
    {
        return $this->belongsTo(DetailSubjectMYP::class, 'atl_id');
    }
}
