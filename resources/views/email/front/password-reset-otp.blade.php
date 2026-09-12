<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Password Reset OTP</title>
</head>

<body style="margin:0; padding:0; background:#f7f5f0; font-family:Arial, sans-serif;">
    <div style="max-width:600px; margin:40px auto; background:#ffffff; padding:40px;">
        <h2 style="text-align:center; margin-bottom:30px;">HNOWW</h2>

        <p>Hello,</p>
        <p>We received a request to reset the password for your HNOWW account.</p>
        <p>Your One-Time Password (OTP) is:</p>

        <div style="text-align:center; margin:30px 0; font-size:32px; font-weight:bold; letter-spacing:8px;">
            {{ $otp }}
        </div>

        <p>This OTP is valid for <strong>10 minutes</strong>.</p>

        <p>If you did not request a password reset, you can safely ignore this email.</p>

        <p style="margin-top:30px;">
            Regards,<br>
            HNOWW Team
        </p>
    </div>
</body>
</html>