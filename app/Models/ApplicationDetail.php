<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationDetail extends Model
{
    use HasFactory;

    protected $guarded = []; // Allow mass assignment for all fields

    protected $casts = [
        'dob' => 'date',
        'reg_date' => 'date',
    ];
}
