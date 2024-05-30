<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Password Reset Request</title>
    <style>
        /* Bootstrap-like styling for email */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.375rem;
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 15px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Password Reset Request</h1>
        <p>Dear <?= session()->get('username') ?>,</p>
        <p>You recently requested a password reset for your account. Click the link below to reset your password:</p>
        <p><a href="<?= $resetLink ?>" class="btn">Reset Password</a></p>
        <p>If you didn't request a password reset, please ignore this email.</p>
        <p>Best regards,<br>RISA</p>
    </div>
</body>
</html>
