<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ConversionMYP extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'conversion';

    // Define the primary key if it's not 'id'

    // Define the fillable fields
    protected $fillable = ['ib_grade, local_grade, mark'];
}