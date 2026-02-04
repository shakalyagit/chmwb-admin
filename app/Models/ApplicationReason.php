<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationReason extends Model
{
    use HasFactory;

    protected $fillable = ['application_head_id', 'reason_id'];
}
