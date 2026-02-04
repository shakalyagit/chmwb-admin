<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Application Form - {{ $app->reference_id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            line-height: 1.5;
            color: #333;
            padding: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #667eea;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        /* .logo {
            width: 60px;
            height: 60px;
            margin: 0 auto 10px;
        } */

        .logo img {
            width: 100%;
            height: auto;
        }

        .header h1 {
            font-size: 18px;
            color: #667eea;
            margin-bottom: 5px;
        }

        .header h2 {
            font-size: 14px;
            color: #333;
            font-weight: normal;
        }

        .reference-box {
            background-color: #f3f4f6;
            padding: 10px;
            margin: 15px 0;
            border-left: 4px solid #667eea;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            background-color: #667eea;
            color: white;
            padding: 8px 10px;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table td {
            padding: 8px;
            border: 1px solid #e5e7eb;
        }

        table td:first-child {
            font-weight: bold;
            width: 40%;
            background-color: #f9fafb;
        }

        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 2px solid #e5e7eb;
            text-align: center;
            font-size: 9px;
            color: #6b7280;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <div class="logo">
            <img src="https://app.chmwb.org/images/CHM.jpg" alt="Logo">
        </div>
        {{-- <h1>Council of Homoeopathic Medicine, West Bengal</h1> --}}
        <h2>Doctor's & Student's Application Portal</h2>
    </div>


    {{-- Top Table: Reference + Photo --}}
    <table class="top-table" width="100%" cellspacing="0" cellpadding="0" style="margin-bottom: 20px;">
        <tr>
            <td width="80%" valign="top">
                <div class="reference-box">
                    <strong>Reference ID:</strong> {{ $app->reference_id }}<br>
                    <strong>Submission Date:</strong>
                    {{ $app->created_at->timezone('Asia/Kolkata')->format('d/m/Y h:i A') }}
                </div>
            </td>
            <td width="20%" align="right" valign="top">
            @if ($app->media && $app->media->where('document_type', 'photo')->first())
                <img src="https://app.chmwb.org/storage/app/public/{{ $app->media->where('document_type', 'photo')->first()->url }}" style="max-width: 100%; height: 160px; display:block; border: 1px solid">
            @else
                <div class="photo-box">PHOTO</div>
            @endif
            </td>
        </tr>
    </table>

    {{-- Application Reasons --}}
    <div class="section">
        <div class="section-title">Application Reason(s)</div>
        <ul>
            @forelse ($app->reasons as $reason)
                <li>{{ ucwords(str_replace('-', ' ', $reason->reason_id)) }}</li>
            @empty
                <li>No reasons specified</li>
            @endforelse
        </ul>
    </div>

    {{-- Personal Information --}}
    <div class="section">
        <div class="section-title">1. Personal Information</div>
        <table>
            <tr>
                <td>Full Name</td>
                <td>{{ $app->detail->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Father's Name</td>
                <td>{{ $app->detail->father_name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Date of Birth</td>
                <td>{{ $app->detail->dob ? \Carbon\Carbon::parse($app->detail->dob)->format('d/m/Y') : 'N/A' }}</td>
            </tr>
            <tr>
                <td>Blood Group</td>
                <td>{{ $app->detail->blood_group ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>

    {{-- Contact Information --}}
    <div class="section">
        <div class="section-title">2. Contact Information</div>
        <table>
            <tr>
                <td>Address</td>
                <td>{{ $app->detail->address ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>District</td>
                <td>{{ $app->detail->district ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Pincode</td>
                <td>{{ $app->detail->pincode ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Police Station</td>
                <td>{{ $app->detail->police_station ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Mobile Number</td>
                <td>{{ $app->detail->mobile ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Email Address</td>
                <td>{{ $app->detail->email ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Aadhaar Number</td>
                <td>{{ $app->detail->aadhaar ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>

    {{-- Academic Information --}}
    <div class="section">
        <div class="section-title">3. Academic & Registration Information</div>
        <table>
            @if ($app->detail->reg_number)
                <tr>
                    <td>Registration Number</td>
                    <td>{{ $app->detail->reg_number }}</td>
                </tr>
                <tr>
                    <td>Registration Date</td>
                    <td>{{ $app->detail->reg_date ? \Carbon\Carbon::parse($app->detail->reg_date)->format('d/m/Y') : 'N/A' }}
                    </td>
                </tr>
            @endif
            @if ($app->detail->qualification)
                <tr>
                    <td>Qualification</td>
                    <td>{{ $app->detail->qualification }}</td>
                </tr>
            @endif
            @if ($app->detail->examination)
                <tr>
                    <td>Examination</td>
                    <td>{{ $app->detail->examination }}</td>
                </tr>
            @endif
            @if ($app->detail->held_in)
                <tr>
                    <td>Held In</td>
                    <td>{{ $app->detail->held_in }}</td>
                </tr>
            @endif
            <tr>
                <td>University</td>
                <td>{{ $app->detail->university ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>College</td>
                <td>{{ $app->detail->college ?? 'N/A' }}</td>
            </tr>
            @if ($app->detail->college_district)
                <tr>
                    <td>College District</td>
                    <td>{{ $app->detail->college_district }}</td>
                </tr>
            @endif
            @if ($app->detail->final_roll_no)
                <tr>
                    <td>Final Roll No</td>
                    <td>{{ $app->detail->final_roll_no }}</td>
                </tr>
            @endif
            @if ($app->detail->term)
                <tr>
                    <td>Term</td>
                    <td>{{ $app->detail->term }}</td>
                </tr>
            @endif
            @if ($app->detail->university_reg_no)
                <tr>
                    <td>University Reg No</td>
                    <td>{{ $app->detail->university_reg_no }}</td>
                </tr>
            @endif
        </table>
    </div>
    <!-- Footer -->
    <div class="footer">
        <p>This is a computer-generated document. No signature is required.</p>
        <p>Council of Homoeopathic Medicine, West Bengal | 9/1B, Mahatma Gandhi Road (1st Floor), Kolkata - 700 009
        </p>
        <p>Generated on: {{ now()->timezone('Asia/Kolkata')->format('d/m/Y h:i A') }}</p>
    </div>
</body>

</html>
