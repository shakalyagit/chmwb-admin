<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMst extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'invoice_no',
        'total_bill_amount',
        'discount_percentage',
        'discount_amount',
        'payable_amount',
        'paid_amount',
        'payment_status',
        'shop_id',
    ];

    public function patient()
    {
        return $this->belongsTo(PatientMst::class, 'patient_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
