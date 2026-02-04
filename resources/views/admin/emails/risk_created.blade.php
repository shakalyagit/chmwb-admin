<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>New Risk Alert</title>
</head>

<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; background-color: #f4f4f4; margin: 0; padding: 0;">

    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f4f4f4;">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="max-width: 600px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <!-- Header -->
                    <tr>
                        <td style="padding: 20px 40px; text-align: center; background-color: #007bff; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                            <h1 style="margin: 0; font-size: 24px; color: #ffffff; font-weight: bold;">New Risk Submitted</h1>
                        </td>
                    </tr>
                    <!-- End Header -->

                    <!-- Body -->
                    <tr>
                        <td style="padding: 40px;">
                            <p style="margin: 0 0 20px; font-size: 16px; color: #333333; line-height: 1.5;">Hello {{$manager_name}},</p>
                            <p style="margin: 0 0 20px; font-size: 16px; color: #555555; line-height: 1.5;">A new risk has been submitted and is awaiting your review in the system. Below are the key details of the submission:</p>

                            <!-- Risk Details Table -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 20px;">
                                <tr>
                                    <td style="background-color: #f9f9f9; padding: 15px; border-radius: 8px;">
                                        <p style="margin: 0 0 10px; font-size: 14px; color: #888888; text-transform: uppercase;"><strong>Risk Details</strong></p>
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="font-size: 14px; line-height: 1.5;">
                                            <tr>
                                                <td style="padding: 5px 0; color: #555555;"><strong>Risk ID:</strong></td>
                                                <td style="padding: 5px 0; color: #333333;">{{$risk_id}}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 5px 0; color: #555555;"><strong>Statement:</strong></td>
                                                <td style="padding: 5px 0; color: #333333;">{!!$risk_statement!!}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 5px 0; color: #555555;"><strong>Owner:</strong></td>
                                                <td style="padding: 5px 0; color: #333333;">{{$owner}}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 5px 0; color: #555555;"><strong>Date Submitted:</strong></td>
                                                <td style="padding: 5px 0; color: #333333;">{{$submitted_date}}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 5px 0; color: #555555;"><strong>Risk Level:</strong></td>
                                                <td style="padding: 5px 0; color: #333333;">{{$level}}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <!-- Call-to-Action Button -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td align="center">
                                        @if(Auth::check())
                                        <a href="{{ route('view_risk_register', ['risk_register_id' => Crypt::encrypt($risk_register_id)]) }}"
                                            style="display: inline-block; padding: 12px 24px; font-size: 16px; color: #ffffff; background-color: #007bff; text-decoration: none; border-radius: 50px; font-weight: bold; border: 1px solid #007bff;">
                                            Review Risk Details
                                        </a>
                                        @else
                                        <a href="{{ route('view_risk_register', ['risk_register_id' => Crypt::encrypt($risk_register_id)]) }}" class="btn btn-primary">
                                            Review Risk Details
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            <!-- End Call-to-Action Button -->

                            <p style="margin: 30px 0 0; font-size: 16px; color: #555555; line-height: 1.5;">Thank you,</p>
                            <p style="margin: 0; font-size: 16px; color: #333333; font-weight: bold;">Your Risk Management Team</p>
                        </td>
                    </tr>
                    <!-- End Body -->

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 20px 40px; text-align: center; font-size: 12px; color: #888888; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
                            <p style="margin: 10px 0 0;">&copy; <?php echo date('Y'); ?> Graphite India Limited. All Rights Reserved.</p>
                        </td>
                    </tr>
                    <!-- End Footer -->
                </table>
            </td>
        </tr>
    </table>

</body>

</html>