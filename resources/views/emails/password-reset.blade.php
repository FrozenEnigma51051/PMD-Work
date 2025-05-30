<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Your Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 30px;
            border-bottom: 2px solid #007bff;
            margin-bottom: 30px;
        }
        .header h2 {
            color: #007bff;
            margin: 0;
            font-size: 28px;
        }
        .content {
            padding: 0;
        }
        .content p {
            margin-bottom: 20px;
            font-size: 16px;
        }
        .button {
            display: inline-block;
            padding: 15px 30px;
            background-color: #007bff;
            color: white !important;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
            margin: 20px 0;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 14px;
            color: #666;
            text-align: center;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .link-text {
            word-break: break-all;
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 3px;
            font-family: monospace;
            font-size: 12px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Reset Your Password</h2>
        </div>
        <div class="content">
            <p>Hello {{ $user->name }},</p>
            
            <p>We received a request to reset your password for your account. If you made this request, please click the button below to set a new password:</p>
            
            <div class="button-container">
                <a href="{{ $resetUrl }}" class="button">Reset My Password</a>
            </div>
            
            <p>If the button above doesn't work, you can copy and paste the following link into your browser:</p>
            <div class="link-text">{{ $resetUrl }}</div>
            
            <div class="warning">
                <strong>Important:</strong> This password reset link will expire in 30 minutes for security reasons.
            </div>
            
            <p>If you did not request a password reset, please ignore this email or contact our support team if you have concerns about your account security.</p>
            
            <p>For your security, never share this link with anyone.</p>
        </div>
        <div class="footer">
            <p>This is an automated message, please do not reply to this email.</p>
            <p>If you're having trouble with the link above, copy and paste the URL into your web browser.</p>
        </div>
    </div>
</body>
</html>
