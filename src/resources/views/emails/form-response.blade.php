@php
    app()->setLocale($locale ?? 'en');
@endphp
    <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
          rel="stylesheet">
    <title>{{ __('emails.contact_confirmation.subject') }}</title>
</head>
<body style="font-family: 'Playfair Display', Arial, sans-serif; background-color: #f4f4f4; padding: 40px 10px;">
<div style="max-width: 600px; margin: auto; background: #ffffff; padding: 30px; border-radius: 12px; border: 1px solid #e0e0e0; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">

    <!-- Titolo -->
    <h2 style="color: #222222; font-size: 24px; font-weight: 600; margin-bottom: 10px;">
        {{ __('emails.contact_confirmation.greeting', ['firstName' => $firstName, 'lastName' => $lastName]) }}
    </h2>

    <!-- Corpo -->
    <p style="color: #555555; font-size: 16px; line-height: 1.5; margin-bottom: 30px;">
        {{ __('emails.contact_confirmation.body') }}
    </p>

    <!-- Divider -->
    <hr style="border: none; border-top: 1px solid #eeeeee; margin: 30px 0;">

    <!-- Dati utente -->
    <p style="color: #888888; font-size: 13px; margin-bottom: 12px; font-style: italic;">
        {{ __('emails.contact_confirmation.form_intro', ['firstName' => $firstName]) }}
    </p>

    <table style="width: 100%; border-collapse: collapse; font-size: 14px; color: #444444;">
        <tr>
            <td style="padding: 6px 0; width: 120px; font-weight: bold;">{{ __('emails.contact_confirmation.fields.firstName') }}</td>
            <td style="padding: 6px 0;">{{ $contactForm['firstName'] ?? '' }}</td>
        </tr>
        <tr style="background: #f9f9f9;">
            <td style="padding: 6px 0; font-weight: bold;">{{ __('emails.contact_confirmation.fields.lastName') }}</td>
            <td style="padding: 6px 0;">{{ $contactForm['lastName'] ?? '' }}</td>
        </tr>
        <tr>
            <td style="padding: 6px 0; font-weight: bold;">{{ __('emails.contact_confirmation.fields.phone') }}</td>
            <td style="padding: 6px 0;">{{ $contactForm['phone'] ?? '' }}</td>
        </tr>
        <tr style="background: #f9f9f9;">
            <td style="padding: 6px 0; font-weight: bold;">{{ __('emails.contact_confirmation.fields.email') }}</td>
            <td style="padding: 6px 0;">{{ $contactForm['email'] ?? '' }}</td>
        </tr>
        <tr>
            <td style="padding: 6px 0; font-weight: bold;">{{ __('emails.contact_confirmation.fields.profileType') }}</td>
            <td style="padding: 6px 0;">
                {{ __('profile_types.' . ($contactForm['profileType'] ?? '')) }}
            </td>
        </tr>

        <tr style="background: #f9f9f9;">
            <td style="padding: 6px 0; font-weight: bold; vertical-align: top;">{{ __('emails.contact_confirmation.fields.message') }}</td>
            <td style="padding: 6px 0;">{{ $contactForm['message'] ?? '' }}</td>
        </tr>
    </table>

    <!-- Footer -->
    <hr style="border: none; border-top: 1px solid #eeeeee; margin: 30px 0;">
    <p style="color: #aaaaaa; font-size: 12px; text-align: center;">
        {{ __('emails.contact_confirmation.footer') }}
    </p>
</div>
</body>
</html>
