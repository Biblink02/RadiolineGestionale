<?php

return [
    'contact_confirmation' => [
        'subject' => 'Contact Request Confirmation Medjugorje Service',
        'greeting' => 'Hello :firstName :lastName,',
        'body' => 'Thank you for contacting our service. We will reply as soon as possible.',
        'footer' => 'This is an automated message, please do not reply.',

        'form_intro' => ':firstName wrote:',
        'fields' => [
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'profileType' => 'Profile Type',
            'message' => 'Message',
        ],
    ],
];
