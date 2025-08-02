<?php

return [
    'contact_confirmation' => [
        'subject' => 'Confirmation de demande de contact Medjugorje Service',
        'greeting' => 'Bonjour :firstName :lastName,',
        'body' => 'Merci de nous avoir contactés. Nous vous répondrons dès que possible.',
        'footer' => 'Ceci est un message automatique, merci de ne pas répondre.',

        'form_intro' => ':firstName a écrit :',
        'fields' => [
            'firstName' => 'Prénom',
            'lastName' => 'Nom',
            'phone' => 'Téléphone',
            'email' => 'E-mail',
            'profileType' => 'Type de profil',
            'message' => 'Message',
        ],
    ],
];
