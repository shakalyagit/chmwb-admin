<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurServices extends Model
{
    use HasFactory;
    public function media()
    {
        return $this->hasOne(Media::class, 'ref_id', 'id')
            ->where('ref_table', 'our_services')
            ->where('media_type', 'profile_pic');
    }
}
