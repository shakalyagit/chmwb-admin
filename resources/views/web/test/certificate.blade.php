<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>BHMS Provisional Registration PDF Template</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: #f3f3f3;
            font-family: "Times New Roman", serif;
        }

        .page-wrapper {
            width: 1123px;
            height: 794px;
            margin: 10px auto;
            background: #ffffff;
            border: 1px solid #d0d0d0;
            position: relative;
        }

        .certificate {
            padding: 40px 50px 35px 50px;
            width: 100%;
            height: 100%;
            position: relative;
        }

        .top-row {
            font-size: 13px;
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .top-row span {
            display: inline-block;
            min-width: 35px;
        }

        .header-main {
            text-align: center;
            margin-bottom: 10px;
        }

        .header-main h1 {
            font-family: "Old English Text MT", "Blackletter", "Times New Roman", serif;
            font-size: 48px;
            margin: 0;
            letter-spacing: 1px;
            font-weight: normal;
        }

        .header-main h2 {
            font-family: "Old English Text MT", "Blackletter", "Times New Roman", serif;
            font-size: 30px;
            margin: 0;
            margin-top: 4px;
            font-weight: normal;
        }

        .logo-circle {
            margin: 18px auto 22px auto;
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 4px double #0066aa;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .logo-text {
            font-size: 7px;
            text-align: center;
            line-height: 1.3;
            color: #000;
            z-index: 2;
            position: relative;
            width: 70px;
        }

        .logo-circle-inner {
            position: absolute;
            width: 55px;
            height: 55px;
            border-radius: 50%;
            top: 25%;
            left: 25%;
            transform: translate(-50%, -50%);
        }

        .title-block {
            text-align: center;
            margin-bottom: 22px;
            line-height: 2;
        }

        .title-block .title-line-1 {
            font-size: 20px;
            font-style: italic;
            font-weight: 600;
        }

        .title-block .title-line-2 {
            margin-top: 4px;
            font-size: 16px;
            font-weight: bold;
        }

        .photo-box {
            position: absolute;
            top: 155px;
            right: 140px;
            width: 115px;
            height: 135px;
            border: 1px solid #000;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f9f9f9;
            overflow: hidden;
        }

        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .body-text {
            padding-right: 0px;
            font-size: 18px;
            line-height: 1.5;
            text-align: left;
            font-weight: 500;
            font-family: "Times New Roman", Georgia, serif;
        }

        .body-text p {
            margin: 0 0 12px 0;
        }

        .dotted-line {
            border-bottom: 1px dotted #000;
            display: inline-block;
            min-width: 120px;
        }

        .footer {
            position: absolute;
            left: 50px;
            right: 50px;
            bottom: 35px;
            font-size: 13px;
        }

        .footer-row {
            margin-bottom: 4px;
        }

        .footer-note {
            font-size: 11px;
            margin-top: 10px;
            font-style: italic;
        }

        .footer-sign {
            position: absolute;
            right: 0;
            bottom: 0;
            font-size: 13px;
            font-weight: bold;
        }

        /* Preview export button area */
        .controls {
            width: 1123px;
            margin: 20px auto 0;
            text-align: right;
            font-family: Arial, sans-serif;
        }

        .controls button {
            padding: 8px 20px;
            font-size: 14px;
            cursor: pointer;
            background: #0066aa;
            color: white;
            border: none;
            border-radius: 4px;
        }

        .controls button:hover {
            background: #004d80;
        }
    </style>
</head>

<body>
    <!-- Certificate template -->
    <div class="page-wrapper" id="certificatePage">
        <div class="certificate">
            <div class="top-row">
                <div>
                    No. HC / <span class="dotted-line"></span> / IP-4/99
                </div>
            </div>

            <div class="header-main">
                <h1>Council of Homoeopathic Medicine</h1>
                <h2>West Bengal</h2>
            </div>

            <div class="logo-circle">
                <div class="logo-circle-inner">
                    <img src="https://app.chmwb.org/images/Screenshot_192.png" alt=""
                        style="width: 100px; height: 100px;border-radius: 50%;" />
                </div>
            </div>

            <div class="title-block">
                <div class="title-line-1">Certificate of Provisional Registration</div>
                <div class="title-line-2">Provisional Reg. No.....................</div>
            </div>

            <!-- Photo box -->
            <div class="photo-box">
                {{-- @php
                    $photo = $selectedApplication->media->where('document_type', 'photo')->first();
                @endphp
                @if ($photo && $photo->file_path) --}}
                {{-- <img src="" alt="Candidate Photo"> --}}
                {{-- @endif --}}
            </div>

            <div class="body-text">
                <p>
                    This is to certify that Sri / Smt.<span class="dotted-line" style="min-width: 400px;"></span>
                </p>
                <p>
                    has passed final BHMS Examinations conducted by The West Bengal University of Health Sciences held
                    in the
                    month of <span class="dotted-line" style="min-width: 150px;"></span> bearing enrolment /
                    registration No.<span class="dotted-line" style="min-width: 150px;"></span> as a student
                    of<span class="dotted-line" style="min-width: 600px;"></span>. This Provisional
                    Registration Certificate is valid for a period of one year with effect from the date of reporting by
                    the candidate to
                    undergo internship as per the Homoeopathy (Degree Course) Regulations (amended from time to time) as
                    enforced by
                    the Central Council of Homoeopathy and in terms of Section 25 A of Homoeopathy Central Council Act.
                    1973. This
                    Certificate is valid for compulsory internship training of one year only in the state of West
                    Bengal.
                </p>
            </div>

            <div class="footer">
                <div class="footer-row">
                    <strong>Date :</strong>
                </div>
                <div class="footer-row">
                    <strong>Place of issue</strong> Kolkata
                </div>
                <div class="footer-note">
                    <strong>Note :</strong> This certificate has to be surrendered on completion of internship training
                    by the candidate.
                </div>
                <div class="footer-sign">
                    Registrar
                </div>
            </div>
        </div>
    </div>

</body>

</html>
