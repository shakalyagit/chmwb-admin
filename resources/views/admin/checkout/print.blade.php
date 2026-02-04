<!DOCTYPE html>
<html>

<head>
    <title>Invoice - {{ $order->invoice_no }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            position: relative;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .invoice-details {
            margin-bottom: 20px;
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }

        .total-section {
            margin-top: 30px;
            text-align: right;
            padding: 15px;
            background-color: #f9f9f9;
        }

        .total-section p {
            margin: 5px 0;
            font-size: 14px;
        }

        .total-section h3 {
            color: #4CAF50;
            margin: 10px 0;
        }

        /* Watermark Style for PAID */
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 150px;
            font-weight: bold;
            color: rgba(76, 175, 80, 0.15);
            z-index: -1;
            text-transform: uppercase;
            letter-spacing: 20px;
        }

        .company-info {
            text-align: center;
            margin-bottom: 20px;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .status-paid {
            background-color: #4CAF50;
            color: white;
        }

        .status-unpaid {
            background-color: #f44336;
            color: white;
        }

        .status-partial {
            background-color: #ff9800;
            color: white;
        }
    </style>
</head>

<body>
    @if ($order->payment_status == 'Full Paid')
        <div class="watermark">PAID</div>
    @endif

    <div class="company-info">
        <h2>Your Medical Store Name</h2>
        <p>Address Line 1, City, State - PIN</p>
        <p>Phone: +91 XXXXXXXXXX | Email: info@example.com</p>
    </div>

    <div class="header">
        <h1>INVOICE</h1>
        <p><strong>Invoice No:</strong> {{ $order->invoice_no }}</p>
        <p><strong>Date:</strong> {{ $order->created_at->format('d-m-Y h:i A') }}</p>
        <span
            class="status-badge
            @if ($order->payment_status == 'Full Paid') status-paid
            @elseif($order->payment_status == 'Part Paid') status-partial
            @else status-unpaid @endif">
            {{ $order->payment_status }}
        </span>
    </div>

    <div class="invoice-details">
        <h3 style="margin-top: 0; color: #333;">Patient Details:</h3>
        <p><strong>Name:</strong> {{ $order->patient->patient_name }}</p>
        <p><strong>Phone:</strong> {{ $order->patient->patient_number }}</p>
        <p><strong>Address:</strong> {{ $order->patient->city }}, {{ $order->patient->state }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 8%;">SL</th>
                <th style="width: 42%;">Medicine Name</th>
                <th style="width: 15%;">Price</th>
                <th style="width: 10%;">Qty</th>
                <th style="width: 25%;">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderDetails as $index => $detail)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $detail->medicine->name }}</strong><br>
                        <small style="color: #666;">{{ $detail->medicine->generic_name }}</small>
                    </td>
                    <td>₹{{ number_format($detail->price, 2) }}</td>
                    <td style="text-align: center;">{{ $detail->qty }}</td>
                    <td><strong>{{ number_format($detail->total_amount, 2) }}</strong></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <p><strong>Sub Total:</strong> {{ number_format($order->total_bill_amount, 2) }}</p>
        <p><strong>Discount ({{ $order->discount_percentage }}%):</strong>
            <span style="color: red;">-{{ number_format($order->discount_amount, 2) }}</span>
        </p>
        <hr style="border: 1px solid #ddd;">
        <h3><strong>Payable Amount:</strong> {{ number_format($order->payable_amount, 2) }}</h3>
        <p><strong>Paid Amount:</strong>
            <span style="color: green;">{{ number_format($order->paid_amount, 2) }}</span>
        </p>
        @if ($order->payable_amount - $order->paid_amount > 0)
            <p><strong>Due Amount:</strong>
                <span style="color: red;">{{ number_format($order->payable_amount - $order->paid_amount, 2) }}</span>
            </p>
        @endif
    </div>

    <div style="margin-top: 50px; text-align: center; border-top: 1px solid #ddd; padding-top: 20px;">
        <p style="font-size: 12px; color: #666;">
            Thank you for your business!<br>
            This is a computer-generated invoice and does not require a signature.
        </p>
    </div>
</body>

</html>
