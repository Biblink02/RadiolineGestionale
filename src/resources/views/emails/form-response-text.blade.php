@php
    app()->setLocale($locale ?? 'en');
@endphp
{{ __('emails.contact_confirmation.greeting', ['firstName' => $firstName, 'lastName' => $lastName]) }}

{{ __('emails.contact_confirmation.body') }}

---

{{ __('emails.contact_confirmation.form_intro', ['firstName' => $firstName]) }}

{{ __('emails.contact_confirmation.fields.firstName') }}: {{ $contactForm['firstName'] ?? '' }}
{{ __('emails.contact_confirmation.fields.lastName') }}: {{ $contactForm['lastName'] ?? '' }}
{{ __('emails.contact_confirmation.fields.phone') }}: {{ $contactForm['phone'] ?? '' }}
{{ __('emails.contact_confirmation.fields.email') }}: {{ $contactForm['email'] ?? '' }}
{{ __('emails.contact_confirmation.fields.profileType') }}: {{ $contactForm['profileType']->label() }}
{{ __('emails.contact_confirmation.fields.message') }}:
{{ $contactForm['message'] ?? '' }}

---

{{ __('emails.contact_confirmation.footer') }}
