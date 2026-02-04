<?php

namespace App\Http\Controllers;

use App\Models\OrderMst;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{

    public function print($orderId)
    {
        $order = OrderMst::with('patient', 'orderDetails.medicine')->findOrFail($orderId);

        $pdf = Pdf::loadView('admin.checkout.print', compact('order'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('invoice-' . $order->invoice_no . '.pdf');
    }

    public function bill_generate(){
        return view('admin.checkout.bill_generate');
    }
}
