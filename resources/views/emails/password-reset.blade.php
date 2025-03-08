<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Your Password</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #312e81;
            padding: 20px;
            text-align: center;
        }
        .email-logo {
            width: 150px;
            height: auto;
        }
        .email-content {
            padding: 30px;
        }
        .email-footer {
            background-color: #f9fafb;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #6b7280;
        }
        h1 {
            color: #312e81;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .button {
            display: inline-block;
            background-color: #312e81;
            color: white !important;
            padding: 12px 24px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            margin: 25px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .button:hover {
            background-color: #4338ca;
        }
        .link-url {
            margin-top: 20px;
            padding: 15px;
            background-color: #f3f4f6;
            border-radius: 4px;
            word-break: break-all;
            font-size: 14px;
            font-family: monospace;
        }
        .greeting {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <span style="color: white; font-size: 1.5rem">CodeSnip</span>
        </div>

        <div class="email-content">
            <div class="greeting">Hello {{ $user->name }},</div>

            <p>You are receiving this email because we received a password reset request for your account.</p>

            <div style="text-align: center;">
                <a href="{{ $resetUrl }}" class="button">Reset Password</a>
            </div>

            <p>This password reset link will expire in {{ config('auth.passwords.users.expire', 60) }} minutes.</p>

            <p>If you did not request a password reset, no further action is required.</p>

            <p>If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:</p>

            <div class="link-url">
                {{ $resetUrl }}
            </div>
        </div>

        <div class="email-footer">
            &copy; {{ date('Y') }} {{ $appName }}. All rights reserved.
        </div>
    </div>
</body>
</html>
