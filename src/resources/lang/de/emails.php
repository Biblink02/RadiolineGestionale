<?php

return [
    'contact_confirmation' => [
        'subject' => 'Kontaktanfrage-Bestätigung Medjugorje Service',
        'greeting' => 'Hallo :firstName :lastName,',
        'body' => 'Vielen Dank, dass Sie uns kontaktiert haben. Wir werden so schnell wie möglich antworten.',
        'footer' => 'Dies ist eine automatische Nachricht, bitte antworten Sie nicht.',

        'form_intro' => ':firstName schrieb:',
        'fields' => [
            'firstName' => 'Vorname',
            'lastName' => 'Nachname',
            'phone' => 'Telefon',
            'email' => 'E-Mail',
            'profileType' => 'Profiltyp',
            'message' => 'Nachricht',
        ],
    ],
];
