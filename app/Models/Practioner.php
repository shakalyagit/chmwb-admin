<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practioner extends Model
{
    use HasFactory;
    protected $fillable = [
        'registration_no',
        'registration_date',
        'name',
        'fathers_name',
        'address',
        'district',
        'state',
        'pincode',
        'ph_no',
        'email_id',
        'qualification',
        'part',
        'status'
    ];
}
