<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Application Approved</title>
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
            background: linear-gradient(90deg, #10b981, #059669);
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

        .success-badge {
            background: #d1fae5;
            border: 2px solid #10b981;
            color: #047857;
            padding: 12px 16px;
            border-radius: 8px;
            font-weight: 600;
            text-align: center;
            margin: 12px 0;
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
            background: #10b981;
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
            <p class="lead"><strong>Reference ID: {{ $application->reference_id ?? '—' }}</strong></p>
            <p><strong>Welcome to Council of Homoeopathic Medicine, West Bengal.</strong></p>

            <p><strong>Congratulations!</strong></p>

            <p>
                <strong>Your application is Approved</strong>.
            </p>

            <p><strong>If you have any questions, please feel free to contact us, Phone – 033 2350 5143</strong></p>
        </div>
        <div class="footer" margin-top="50px">
            <div>Best regards,</div>
            <div><strong>Council of Homoeopathic Medicine, West Bengal</strong></div>
            <div class="small">
                © {{ date('Y') }} Council of Homoeopathic Medicine, West Bengal.All rights reserved.
                <br>
                This is an automated email. Please do not reply to this message.
            </div>
        </div>
    </div>
</body>

</html>
