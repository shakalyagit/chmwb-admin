<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'order_id',
        'medicine_id',
        'qty',
        'price',
        'total_amount',
    ];

    public function order()
    {
        return $this->belongsTo(OrderMst::class, 'order_id');
    }

    public function medicine()
    {
        return $this->belongsTo(MedicianeMst::class, 'medicine_id');
    }

    public function patient()
    {
        return $this->belongsTo(PatientMst::class, 'patient_id');
    }
}
