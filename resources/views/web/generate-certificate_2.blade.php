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
            font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"
        }

        .page-wrapper {
            width: 1123px;
            height: 825px;
            margin: 10px auto;
            background: #ffffff;
            /* border: 1px solid #d0d0d0; */
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
            letter-spacing: 1px;
        }

        .title-block .title-line-2 {
            margin-top: 4px;
            font-size: 16px;
            font-weight: bold;
        }

        .photo-box {
            position: absolute;
            top: 200px;
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
            text-align: justify;
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
            bottom: 25px;
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
            right: 120px;
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

        @media print {
            .controls {
                display: none !important;
            }
        }

        /* .controls {
            display: none;
        } */
        .dr_name {
            margin-top: 371px !important;
            position: absolute;
            margin-left: 100px;
            font-size: 20px;
            font-weight: bold;
            z-index: 999;
            text-wrap: inherit;
            width: 100px;
        }

        .certificate_no {
            margin-top: 265px !important;
            position: absolute;
            margin-left: 80px;
            font-size: 16px;
            font-weight: 500;
            z-index: 999;
            text-wrap: inherit;
            width: 100%;
        }

        .agreement_text {
            margin-top: 535px !important;
            position: absolute;
            margin-left: 80px;
            font-size: 15px;
            font-weight: 600;
            z-index: 999;
            text-wrap: inherit;
            width: 85%;
        }

        .note_nb {
            margin-top: 670px !important;
            position: absolute;
            margin-left: 80px;
            font-size: 14.5px;
            font-weight: 400;
            z-index: 999;
            text-wrap: inherit;
            width: 85%;
            text-align: justify;
        }

        .kolkata_the {
            margin-top: 265px !important;
            position: absolute;
            right: 100px;
            font-size: 16px;
            font-weight: 500;
            z-index: 999;
            text-wrap: inherit;
        }

        .kolkata_the_value {
            margin-top: 259px !important;
            position: absolute;
            right: 100px;
            font-size: 16px;
            font-weight: 600;
            z-index: 999;
            text-wrap: inherit;
        }

        .register_sign {
            margin-top: 640px !important;
            position: absolute;
            right: 100px;
            font-size: 16px;
            font-weight: 600;
            z-index: 999;
            font-style: italic;
            text-wrap: inherit;
            text-align: center;
            max-width: 240px;
        }

        .provisional_reg_no {
            margin-top: 255px !important;
            position: absolute;
            margin-left: 200px;
            font-size: 20px;
            font-weight: 600;
            z-index: 999;
        }

        .address {
            margin-top: 371px !important;
            position: absolute;
            margin-left: 240px;
            font-size: 14px;
            font-weight: bold;
            z-index: 999;
            text-wrap: inherit;
            width: 115px;
        }

        .reg_date {
            margin-top: 371px !important;
            position: absolute;
            margin-left: 440px;
            font-size: 20px;
            font-weight: bold;
            z-index: 999;
        }

        .qualification {
            margin-top: 371px !important;
            position: absolute;
            margin-left: 640px;
            font-size: 20px;
            font-weight: bold;
            z-index: 999;
            text-wrap: inherit;
            width: 100px;
        }

        .photo_profile img {
            margin-top: -225px !important;
            position: absolute;
            margin-left: 480px;
            font-size: 20px;
            font-weight: bold;
            z-index: 999;
            text-wrap: inherit;
            width: 100px;
            height: 100px;
            max-width: 100%;
        }

        /* Table Styles */
        .certificate-table {
            width: 88%;
            border-collapse: collapse;
            border: 0px solid #000;
            position: absolute;
            top: 310px;
            left: 64px;
            z-index: 100;
            background: #ffffff00;
            text-align: center;
        }

        .certificate-table thead {
            background-color: #ffffff00;
        }

        .certificate-table thead th {
            border: 0px solid #000;
            padding: 12px 8px;
            text-align: center;
            font-size: 14px;
            font-weight: 500;
            vertical-align: top;
            line-height: 1.3;
        }

        .certificate-table tbody td {
            border: 0px solid #000;
            padding: 10px 0px;
            font-size: 16px;
            vertical-align: top;
            line-height: 1.3;
        }

        .certificate-table tbody tr {
            min-height: 70px;
        }

        .certificate-table tbody tr:nth-child(even) {
            background-color: #ffffff;
        }
    </style>
</head>

<body>


    <!-- Certificate template -->
    <div class="page-wrapper" id="certificatePage">

        <div>
            <span class="certificate_no">
                Certificate No:.....................................
            </span>
        </div>
        <div>
            <span class="kolkata_the">
                Kolkata, the ........................
            </span>
        </div>
        <div>
            <span class="kolkata_the_value">
                {{ $selectedApplication->details->reg_date ? $selectedApplication->details->reg_date->format('d.m.Y') : '' }}
            </span>
        </div>
        <div>
            <span class="register_sign">
                <p style="margin: 0px;font-weight: 400;font-size: 16px;font-style: normal;">
                    {{ $selectedApplication->details->registrar_name ?? '' }}</p>
                <p style="margin: 0px;font-weight: 400;font-size: 16px;font-style: normal;">
                    {{ $selectedApplication->details->reg_date ? $selectedApplication->details->reg_date->format('d.m.Y') : '' }}
                </p>
                Registrar
            </span>
        </div>
        <div>
            <span class="agreement_text">
                I hereby declare that the certificate reproduces the entries in the proper columns of Part A of the
                Register of Homoeopathic Practitioners in respect of the name specified in the certificate.
            </span>
        </div>
        <div>
            <span class="note_nb">
                <strong>N.B. :</strong><br>
                1. This certificate will require no renewal.<br>
                2. Every Registered Medical Practitioner should be careful to send to the Registrar immediate notice of
                any change / rectification / addition in his/her name, surname, address & qualification and also to
                answer all inquiries that may be sent to him/her by the Registrar in regard thereto in order that
                his/her correct name, surname, address & qualification may be duly inserted in the Register of
                Registered Practitioners.
            </span>
        </div>

        <div>
            <span class="provisional_reg_no">
                {{ $selectedApplication->details->reg_number ?? '' }}
            </span>
        </div>

        <div class="certificate">
            <div class="top-row">
                <div style="z-index: 999">
                    <img src="/assets/images/certificate-2.png" alt=""
                        style="max-width: 100%;height: 740px; z-index: 9999;">
                </div>
            </div>

            <!-- Data Table - Overlaid on image -->
            {{-- <table class="certificate-table" border="1">
                <tr>
                    <td style="width: 44%;">
                        <table>
                            <tr>
                                <td style="width: 20%;font-weight: 500;">Name</td>
                                <td style="width: 25%;font-weight: 500;">Address or place of service</td>
                            </tr>
                            <tr>
                                <td style="width: 20%;font-size: 20px;font-weight: 600;">
                                    {{ $selectedApplication->details->name }}
                                </td>
                                <td style="width: 20%;">
                                    {{ $selectedApplication->details->address . ', ' . $selectedApplication->details->district . ', ' . $selectedApplication->details->police_station . ', ' . $selectedApplication->details->pincode }}
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td valign="top">
                        <table>
                            <tr>
                                <td style="width:25%; font-weight: 500;">Date of Registration</td>
                                <td style="width:25%; font-weight: 500;">Qualification and <br> dates thereof</td>
                                <td style="font-weight: 500;width: 44%;">Paragraph of the schedule under <br> which
                                    registration is
                                    allowed</td>
                            </tr>
                            <tr>
                                <td style="width:15%">
                                    {{ $selectedApplication->details->reg_date->format('jS F Y') }}</td>
                                <td style="font-size: 16px;font-weight: 400; width: 20%;">
                                    {{ $selectedApplication->details->qualification }}
                                    <p style='font-size: 14px; margin:0px;'>
                                        {{ $selectedApplication->details->held_in }}</p>

                                </td>
                                <td>{{ $selectedApplication->details->pragraph_of_schedule }}</td>
                            </tr>
                            <tr valign="top">
                                <td colspan="3" style="padding: 0px; text-align: center; padding-right:8px"
                                    align="center">
                                    {!! nl2br(e($selectedApplication->details->other_qulification)) !!}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table> --}}

            <table class="certificate-table">
                <thead>
                    <tr>
                        <th style="width: 20%;">Name</th>
                        <th style="width: 20%;">Address or place of service</th>
                        <th style="width: 15%;">Date of Registration</th>
                        <th style="width: 20%;">Qualification and <br> dates thereof</th>
                        <th style="width: 25%;">Paragraph of the schedule under <br> which registration is allowed</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-size: 20px;font-weight: 600;">{{ $selectedApplication->details->name ?? '' }}
                        </td>
                        <td>
                            {{ ($selectedApplication->details->address ?? '') . ', ' . ($selectedApplication->details->police_station ?? '') . ', ' . ($selectedApplication->details->district ?? '') . ', ' . ($selectedApplication->details->pincode ?? '') }}
                        </td>
                        <td>{{ $selectedApplication->details->reg_date ? $selectedApplication->details->reg_date->format('jS F Y') : '' }}
                        </td>
                        <td style="font-size: 16px;font-weight: 400;">
                            {{ $selectedApplication->details->qualification ?? '' }}
                            <p style='font-size: 14px; margin:0px;'>
                                {{ $selectedApplication->details->held_in ?? '' }}</p>

                        </td>
                        <td>{{ $selectedApplication->details->pragraph_of_schedule ?? '' }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="3" style="padding: 0px">
                            {!! nl2br(e($selectedApplication->details->other_qulification ?? '')) !!}
                        </td>
                    </tr>
                </tbody>
            </table>


            @php
                $photo = $selectedApplication->media->where('document_type', 'photo')->first();
            @endphp



            <div>
                <span class="photo_profile">
                    @if ($photo && $photo->url)
                        <img src="{{ env('APP_FILE_PATH') . '/' . $photo->url }}" alt="Candidate Photo">
                    @endif
                </span>
            </div>
        </div>
    </div>

</body>

</html>


<script>
    function printCertificate() {

        const content = document.getElementById('certificatePage').innerHTML;

        const win = window.open('', '', 'width=1200,height=900');

        win.document.open();
        win.document.write(`
        <html>
        <head>
            <title>Doctor_Registration_Certificate_of_{{ $selectedApplication->details->reg_number }}_{{ $selectedApplication->details->name }}</title>

            <style>
                ${document.querySelector('style').innerHTML}

                body {
                    margin: 0;
                    background: #fff;
                }

                @page {
                    size: A4 landscape;
                    margin: 0;
                }
                .kolkata_the {
                    margin-top: 265px !important;
                    position: absolute;
                    margin-left: 865px;
                    font-size: 16px;
                    font-weight: 500;
                    z-index: 999;
                    text-wrap: inherit;
                }

                .kolkata_the_value {
                    margin-top: 259px !important;
                    position: absolute;
                    margin-left: 960px;
                    font-size: 16px;
                    font-weight: 600;
                    z-index: 999;
                    text-wrap: inherit;
                }
            </style>
        </head>
        <body>
            ${content}
        </body>
        </html>
    `);
        win.document.close();

        // Wait for images to load (VERY IMPORTANT)
        const images = win.document.images;
        let loaded = 0;

        if (images.length === 0) {
            win.print();
            win.close();
            return;
        }

        for (let i = 0; i < images.length; i++) {
            images[i].onload = images[i].onerror = function() {
                loaded++;
                if (loaded === images.length) {
                    setTimeout(() => {
                        win.print();
                        win.close();
                    }, 300);
                }
            };
        }
    }
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<button onclick="printCertificate()"
    style="position:fixed;top:10px;right:10px;z-index:9999;padding:10px 15px;font-size:14px;cursor:pointer;background:#2f3293;color:#fff;border:none;border-radius:4px;box-shadow:0 2px 6px rgba(0,0,0,0.2);">
    <i class="bi bi-printer"></i> Print
    Certificate</button>
