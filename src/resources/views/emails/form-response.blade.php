@php
    app()->setLocale($locale ?? 'en');
@endphp
    <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('emails.contact_confirmation.subject') }}</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;">
<div
    style="max-width: 600px; margin: auto; background: #ffffff; padding: 20px; border-radius: 8px; border: 1px solid #ddd;">
    <h2 style="color: #333333;">
        {{ __('emails.contact_confirmation.greeting', ['firstName' => $firstName, 'lastName' => $lastName]) }}
    </h2>
    <p style="color: #555555; font-size: 16px;">
        {{ __('emails.contact_confirmation.body') }}
    </p>
    <hr style="margin: 20px 0;">
    <p style="color: #999999; font-size: 12px;">
        {{ __('emails.contact_confirmation.footer') }}
    </p>
</div>
</body>
</html>
