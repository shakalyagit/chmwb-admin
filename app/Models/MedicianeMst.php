<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicianeMst extends Model
{
    use HasFactory;
    protected $fillable = [
        'medicin_id',
        'shop_id',
        'name',
        'generic_name',
        'hsn_code',
        'batch_no',
        'expire_date',
        'total_file',
        'qty_per_file',
        'per_file_mrp',
        'total_stock',
        'per_stock_mrp',
    ];
}
