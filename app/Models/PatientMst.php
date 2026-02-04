<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientMst extends Model
{
    use HasFactory;
    protected $fillable = [
        'shop_id',
        'patient_name',
        'patient_number',
        'city',
        'state',
    ];
}
