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
            /* border: 1px solid #d0d0d0; */
            position: relative;
        }

        .certificate {
            padding: 4px 50px 35px 50px;
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
            bottom: 45px;
            font-size: 13px;
        }

        .footer-row {
            margin-bottom: 4px;
        }

        .footer-note {
            font-size: 14px;
            margin-top: 10px;
            font-style: italic;
        }

        .footer-sign {
            position: absolute;
            right: 120px;
            bottom: 0;
            font-size: 15px;
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
    </style>
</head>

<body>
    <!-- Controls (Download) -->
    {{-- <div class="controls" style="width:1123px;margin:10px auto 10px;text-align:right;">
        <button id="downloadCertBtn" class="btn btn-success"> Download Certificate</button>
    </div> --}}

    <!-- Certificate template -->
    <div class="page-wrapper" id="certificatePage">
        <div class="certificate">
            <div class="top-row">
                <div>
                    <span class=""
                        style="margin-top: 39px !important;position: absolute;margin-left: 125px; font-size: 22px; font-weight: 500;">
                        {{ $selectedApplication->details->ch_no }} </span>
                </div>
                {{-- <div>
                    No. HC / <span class="dotted-line"></span> / IP-4/99
                </div> --}}
            </div>

            {{-- <div class="header-main">
                <h1>Council of Homoeopathic Medicine</h1>
                <h2>West Bengal</h2>
            </div> --}}

            <img src="{{ '/assets/images/header_provisonial.jpg' }}" alt="Council Logo"
                style="width: 100%; height: auto; display: block; margin: 0 auto 10px auto;" />

            <div class="logo-circle">
                <div class="logo-circle-inner">
                    <img src="https://app.chmwb.org/images/Screenshot_192.png" alt="logo"
                        style="width: 100px; height: 100px;border-radius: 50%;" />
                </div>
            </div>

            <div class="title-block">
                <div class="title-line-1">Certificate of Provisional Registration</div>
                <div class="title-line-2">Provisional Reg. No.

                    @if (!empty($selectedApplication->details->provisional_reg_no))
                        <span class="dotted-line" style="min-width: 100px; font-weight: bold;font-size:22px">
                            {{ $selectedApplication->details->provisional_reg_no }}
                        </span>
                    @else
                        <span class="dotted-line" style="min-width: 200px;"></span>
                    @endif
                </div>
            </div>

            <!-- Photo box -->
            <div class="photo-box">
                @php
                    $photo = $selectedApplication->media->where('document_type', 'photo')->first();
                @endphp
                @if ($photo && $photo->url)
                    <img src="{{ env('APP_FILE_PATH') . '/' . $photo->url }}" alt="Candidate Photo">
                @endif
            </div>

            <div class="body-text">
                {{-- <p>
                    This is to certify that Sri / Smt.
                    {{ $selectedApplication->details->name ? '$selectedApplication->details->name' : '<span class="dotted-line" style="min-width: 400px;"></span>' }}
                    <span class="dotted-line"
                        :style="{ minWidth: '400px' }">{{ $selectedApplication->details->name }}</span>
                </p> --}}

                {{-- <p>
                    This is to certify that Sri / Smt.
                    @if (!empty($selectedApplication->details->name))
                        <span class="dotted-line"
                            style="min-width:375px; font-style: italic; font-weight: bold; padding-left: 15px;">
                            {{ $selectedApplication->details->name }}
                        </span>
                    @else
                        <span class="dotted-line" style="min-width:400px;"></span>
                    @endif
                    has passed final BHMS Examinations conducted by
                </p>
                <p>
                    The West Bengal University of Health Sciences held in the month of
                    <span class="dotted-line" style="min-width: 145px;"></span> bearing enrolment /
                    registration No.<span class="dotted-line" style="min-width: 150px;"></span> as a student
                    of<span class="dotted-line" style="min-width: 505px;"></span>. This Provisional
                    Registration Certificate is valid for a period of one year with effect from the date of reporting by
                    the candidate to
                    undergo internship as per the Homoeopathy (Degree Course) Regulations (amended from time to time) as
                    enforced by
                    the Central Council of Homoeopathy and in terms of Section 25 A of Homoeopathy Central Council Act.
                    1973. This
                    Certificate is valid for compulsory internship training of one year only in the state of West
                    Bengal.
                </p> --}}

                <p>
                    This is to certify that Sri / Smt.
                    @if (!empty($selectedApplication->details->name))
                        <span class="dotted-line" style="min-width: 380px;  font-weight: bold; padding-left: 12px;">
                            {{ strtoupper($selectedApplication->details->name) }}
                        </span>
                    @else
                        <span class="dotted-line" style="min-width: 380px;"></span>
                    @endif
                    <span style="line-height: 2.5rem">
                        has passed final BHMS Examinations conducted by
                        The West Bengal University of Health Sciences
                        held in the month of
                    </span>
                    @if (!empty($selectedApplication->details->held_in))
                        <span class="dotted-line" style="min-width: 160px; font-weight: bold; padding-left: 7px;">
                            {{ $selectedApplication->details->held_in }}
                        </span>
                    @else
                        <span class="dotted-line" style="min-width: 160px;"></span>
                    @endif
                    bearing enrolment / registration No.
                    @if (!empty($selectedApplication->details->university_reg_no))
                        <span class="dotted-line" style="min-width: 120px; font-weight: bold;  padding-left: 7px;">
                            {{ $selectedApplication->details->university_reg_no }}
                        </span>
                    @else
                        <span class="dotted-line" style="min-width: 120px;"></span>
                    @endif
                    as a student of
                    @if (!empty($selectedApplication->details->college))
                        <span class="dotted-line" style="min-width: 400px; font-weight: bold;  padding-left: 12px;">
                            {{ $selectedApplication->details->college }}
                        </span>,
                    @else
                        <span class="dotted-line" style="min-width: 400px;"></span>.
                    @endif
                    @if (!empty($selectedApplication->details->college_district))
                        <span class="dotted-line" style="min-width: 135px; font-weight: bold; padding-left: 7px;">
                            {{ $selectedApplication->details->college_district }}
                        </span>.
                    @else
                        <span class="dotted-line" style="min-width: 135px;"></span>.
                    @endif
                    <span>
                        This Provisional Registration Certificate is valid for a period of
                        one year with effect from the date of reporting by the candidate to undergo
                        internship as per the Homoeopathy (Degree Course) Regulations
                        (amended from time to time) as enforced by the Central Council of Homoeopathy,
                        in terms of Section 25 A of the Homoeopathy Central Council Act, 1973 and presently in terms of
                        Section 55 of the National Commission for Homoeopathy Act, 2020.
                        This Certificate is valid for compulsory internship training of one year
                        only in the State of West Bengal.
                    </span>
                </p>

            </div>

            <div class="footer">
                <div class="footer-row">
                    <strong>Date & Time :</strong>
                    <span class="dotted-line" style="min-width: 135px; font-weight: bold; padding-left: 7px;">
                        {{ $selectedApplication->details->created_at->timezone('Asia/Kolkata')->format('d/m/Y h:i A') }}
                    </span>
                </div>
                <div class="footer-row">
                    <strong>Place of issue : </strong> Kolkata
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
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script> --}}
{{-- <script>
    (function() {
        const btn = document.getElementById('downloadCertBtn');
        if (!btn) return;

        btn.addEventListener('click', function() {
            // Prevent duplicate clicks
            if (btn.dataset.loading === '1') return;
            btn.dataset.loading = '1';

            const originalText = btn.innerText;
            btn.disabled = true;
            btn.innerText = 'Downloading Certificate...';
            btn.style.opacity = '0.6';
            btn.style.cursor = 'not-allowed';

            const element = document.getElementById('certificatePage');
            const opt = {
                margin: 0.4,
                filename: 'certificate_{{ $selectedApplication->details->name . '_' . $selectedApplication->details->aadhaar ?? '0' }}.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2,
                    useCORS: true
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'landscape'
                }
            };

            // small timeout to allow webfonts/images to fully load
            setTimeout(function() {
                try {
                    html2pdf().set(opt).from(element).save().then(function() {
                        // On success, restore button
                        btn.disabled = false;
                        btn.innerText = originalText;
                        btn.style.opacity = '';
                        btn.style.cursor = '';
                        btn.dataset.loading = '0';
                    }).catch(function() {
                        // On error, restore and inform user
                        btn.disabled = false;
                        btn.innerText = originalText;
                        btn.style.opacity = '';
                        btn.style.cursor = '';
                        btn.dataset.loading = '0';
                        alert(
                            'An error occurred while generating the PDF. Please try again.'
                        );
                    });
                } catch (e) {
                    // If html2pdf is not available or throws synchronously
                    btn.disabled = false;
                    btn.innerText = originalText;
                    btn.style.opacity = '';
                    btn.style.cursor = '';
                    btn.dataset.loading = '0';
                    console.error(e);
                    alert('An unexpected error occurred. Check console for details.');
                }
            }, 250);
        });
    })();
</script> --}}

<script>
    function printCertificate() {

        const content = document.getElementById('certificatePage').innerHTML;

        const win = window.open('', '', 'width=1200,height=900');

        win.document.open();
        win.document.write(`
        <html>
        <head>
            <title>Provisional_Registration_Certificate_of_{{ $selectedApplication->details->name }}</title>

            <!-- COPY SAME CSS -->
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
