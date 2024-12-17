<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: #fff; border-radius: 10px; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h2 style="color: #333; text-align: center;">Verify Your Email Address</h2>
        <p>Thank you for registering with us. Please click the button below to verify your email address:</p>
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ $url }}" style="background-color: #000; color: #fff; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">Verify Email Address</a>
        </div>
        <p>If you did not create an account, no further action is required.</p>
        <p>If you're having trouble clicking the button, copy and paste the URL below into your web browser:</p>
        <p style="word-break: break-all; color: #718096;">{{ $url }}</p>
    </div>
</body>
</html>
