<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Application Status Update</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
            background: #f4f6f8;
            margin: 0;
            padding: 0
        }

        .container {
            max-width: 680px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 6px 18px rgba(23, 28, 45, 0.08)
        }

        .header {
            background: linear-gradient(90deg, #0f62fe, #6f42c1);
            color: #fff;
            padding: 24px
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
            font-weight: 600
        }

        .body {
            padding: 28px;
            color: #253858
        }

        .lead {
            font-size: 16px;
            margin-bottom: 18px
        }

        .meta {
            background: #f6f8fb;
            padding: 12px;
            border-radius: 8px;
            margin: 18px 0;
            font-size: 14px
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px
        }

        .label {
            color: #6b7280
        }

        .value {
            color: #111827;
            font-weight: 600
        }

        .reasons {
            margin-top: 12px;
            padding: 12px;
            border-left: 4px solid #0f62fe;
            background: #fbfdff;
            border-radius: 6px
        }

        .footer {
            padding: 18px 28px;
            background: #fafafa;
            color: #6b7280;
            font-size: 13px
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            background: #0f62fe;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            margin-top: 12px
        }

        .small {
            font-size: 13px;
            color: #6b7280
        }

        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;
            background-color: #ffffff;
            border-radius: 50%;
            padding: 10px;
        }

        .logo img {
            max-width: 100%;
            height: 200px;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header" style="text-align: center;">
            <div class="logo" style="text-align: center">
                <img src="https://app.chmwb.org/images/Screenshot_192.png" style="border-radius: 50%; text-align:center"
                    alt="Logo">
            </div>
            <h1>Council of Homoeopathic Medicine</h1>
            <p style="margin: 5px 0 0 0;">West Bengal</p>
        </div>
        <div class="body">
            <p class="lead">Dear <strong>{{ optional($details)->name ?? 'Applicant' }}</strong>,</p>
            <p class="lead"> <strong>Reference ID: <strong>{{ $application->reference_id ?? '—' }}</strong></strong>
            </p>
            <p><strong>Welcome to Council of Homoeopathic Medicine, West Bengal.</strong></p>

            <p>Your application is Reverted Back</p>
            <p><strong> Reason for Reverting Back {{ $status_reason ?? '—' }}</strong></p>

            <p>
                The process will be initiated after receiving the signed printout of the online submitted form & the
                "Original Doctor's Registration
                Certificate" to Council of Homoeopathic Medicine, West Bengal via Speed Post / Physically to the
                following address:
            </p>
            <p>
                Address:
                The Registrar,
                Council of Homoeopathic Medicine, WestBengal,
                9/1B, Mahatma Gandhi Road (1st Floor),
                Kolkata- 700009.
            </p>
            <p> <strong>If you have any questions, please feel free to contact us, Phone – 033 2350 5143.</strong></p>

            {{-- <div class="meta">
                <div class="row">
                    <div class="label">Application Date</div>
                    <div class="value">{{ optional($date)->format('d M, Y') ?? '—' }}</div>
                </div>
                <div class="row">
                    <div class="label">Current Status</div>
                    <div class="value">{{ ucwords($status) }}</div>
                </div>
                <div class="row">
                    <div class="label">Status Reason</div>
                    <div class="value">{{ $status_reason ?? '—' }}</div>
                </div>
            </div> --}}

            {{-- <div>
                <div class="label">Application Reasons</div>
                @if ($application->reasons && $application->reasons->count())
                    <div class="reasons">
                        <ul style="margin:0;padding-left:18px">
                            @foreach ($application->reasons as $r)
                                <li>{{ $r->reason ?? ($r->title ?? '—') }}</li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="small">No reasons provided.</div>
                @endif
            </div> --}}
        </div>
        <div class="footer" margin-top="50px">
            <div>Best regards,</div>
            <div><strong>Your Registration Team</strong></div>
            <div class="small">
                Council of Homoeopathic Medicine, West Bengal<br>
                <p>
                    ©{{ date('Y') }} Council of Homoeopathic Medicine, West Bengal.All rights reserved.
            </div>
            </p>
        </div>
    </div>
</body>

</html>
