<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Risk Management System - Account Activation</title>
</head>

<body style="font-family: Arial, sans-serif; background-color:#f7f7f7; padding:20px; margin:0;">
    <!-- Email main container -->
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <table role="presentation" cellspacing="0" cellpadding="0" width="600" 
                       style="max-width:600px; background-color:#ffffff; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.1); overflow:hidden;">
                    <tr>
                        <td style="padding:30px; text-align:center;">
                            <!-- Logo -->
                            <img src="http://127.0.0.1:8000/assets/img/icons/spot-illustrations/logo.jpg" alt="GI Company Logo"
                                 style="width:96px; height:96px; border-radius:50%; display:block; margin:0 auto 20px auto;">
                            
                            <!-- Heading -->
                            <h1 style="font-size:24px; font-weight:bold; color:#1f2937; margin-bottom:20px;">
                                Welcome to the Risk Management System Portal!
                            </h1>
                            
                            <!-- Greeting -->
                            <p style="color:#4b5563; font-size:16px; line-height:1.5; margin:0 0 10px 0;">
                                Hi {{ $user->name }},
                            </p>
                            
                            <!-- Message -->
                            <p style="color:#4b5563; font-size:16px; line-height:1.5; margin:0 0 20px 0;">
                                A new account has been created for you to access the Risk Management System portal. 
                                To get started, please set your new password and activate your account.
                            </p>
                            <p style="color:#4b5563; font-size:16px; line-height:1.5; margin:0 0 30px 0;">
                                To activate your account and set your password, please click the button below. 
                                This link is only valid for 10 minutes.
                            </p>
                            
                            <!-- Button -->
                            <table role="presentation" cellspacing="0" cellpadding="0" align="center" style="margin-bottom:30px;">
                                <tr>
                                    <td align="center" bgcolor="#2563eb" 
                                        style="border-radius:8px; background-color:#2563eb;">
                                        <a href="{{ $link }}" target="_blank" 
                                           style="display:inline-block; padding:12px 24px; font-size:16px; font-weight:bold; 
                                                  color:#ffffff; text-decoration:none; border-radius:8px;">
                                            Activate Account &amp; Set Password
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Footer -->
                            <p style="color:#9ca3af; font-size:12px; margin-top:30px; text-align:center;">
                                &copy; <?php echo date('Y'); ?> Graphite India Limited. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
