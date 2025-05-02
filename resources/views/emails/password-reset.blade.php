<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Reset Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .content {
            padding: 20px 0;
        }
        .code {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            padding: 15px;
            margin: 20px 0;
            background-color: #f5f5f5;
            border-radius: 5px;
            letter-spacing: 5px;
        }
        .button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
        .footer {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Password Reset Request</h2>
        </div>
        <div class="content">
            <p>Hello {{ $user->name }},</p>
            <p>We received a request to reset your password. Please use the following verification code to complete your password reset:</p>
            
            <div class="code">{{ $code }}</div>
            
            <p>Alternatively, you can click the button below to go directly to the password reset page:</p>
            
            <a href="{{ $resetUrl }}" class="button">Reset Password</a>
            
            <p>If you did not request a password reset, please ignore this email or contact support if you have concerns.</p>
            
            <p>This code will expire in 60 minutes.</p>
        </div>
        <div class="footer">
            <p>This is an automated message, please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>
