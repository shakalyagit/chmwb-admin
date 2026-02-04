<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationMedia extends Model
{
    use HasFactory;

    protected $fillable = ['application_head_id', 'document_type', 'url', 'original_name', 'ext'];
}
