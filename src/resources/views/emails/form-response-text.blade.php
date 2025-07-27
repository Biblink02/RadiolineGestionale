@php
    app()->setLocale($locale ?? 'en');
@endphp
{{ __('emails.contact_confirmation.greeting', ['firstName' => $firstName, 'lastName' => $lastName]) }}

{{ __('emails.contact_confirmation.body') }}

---

{{ __('emails.contact_confirmation.footer') }}
