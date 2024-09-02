{{-- <h3>Hii..</h3>
<p>This is your OTP Code For Reset Your Password</p>
    
    <div style="align-content: center">
        <h2 style="letter-spacing: 3px;border: 1px solid blue; padding: 5px; width: 60px;">{{ $otpCode }}</h2>
    </div>
    <p>Regards,<br> Course-mate</p> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $brandName }} - Password Reset OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #333333;
            font-size: 24px;
            margin: 0;
        }
        .content {
            color: #333333;
            font-size: 16px;
            line-height: 1.5;
            padding: 20px 0;
        }
        .otp {
            font-size: 24px;
            color: #ffffff;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #777777;
            padding-top: 20px;
        }
        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Password Reset Request</h1>
        </div>
        <div class="content">
            <p>Hi there,</p>
            <p>We received a request to reset your password. Please use the OTP below to reset your password. This OTP is valid for 10 minutes.</p>
            <div class="otp">{{ $otpCode }}</div>
            <p>If you did not request a password reset, please ignore this email or contact support if you have questions.</p>
            <p>Thank you,<br>{{ $brandName }}/p>
        </div>
        <div class="footer">
            <p>&copy; {{ $year }} {{ $brandName }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

