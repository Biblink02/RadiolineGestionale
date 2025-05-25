<!DOCTYPE html>
<!-- TODO personalizza email in base alla lingua dell'utente! -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .email-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        .email-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .email-body {
            font-size: 16px;
            line-height: 1.5;
            color: #333333;
            margin-bottom: 20px;
        }
        .email-footer {
            font-size: 14px;
            color: #777777;
        }
        .code-box {
            display: inline-block;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            font-size: 18px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        Client Code for RADIO RENT
    </div>

    <div class="email-body">
        <p>Dear Customer,</p>
        <p>Thank you for your request! Below is your unique client code:</p>
        <div class="code-box">{{ $code }}</div>
        <p>Please use this code for any future reference related to your profile.</p>
    </div>

    <div class="email-footer">
        <p>Best regards,</p>
        <p>The RADIO RENT Team</p>
    </div>
</div>
</body>
</html>
