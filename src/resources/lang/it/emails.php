<?php

return [
    'contact_confirmation' => [
        'subject' => 'Conferma richiesta di contatto Medjugorje Service',
        'greeting' => 'Ciao :firstName :lastName,',
        'body' => 'Grazie per aver contattato il nostro servizio. Ti risponderemo al più presto.',
        'footer' => 'Messaggio automatico, non rispondere a questa mail.',

        'form_intro' => ':firstName ha scritto:',
        'fields' => [
            'firstName' => 'Nome',
            'lastName' => 'Cognome',
            'phone' => 'Telefono',
            'email' => 'Email',
            'profileType' => 'Tipo di profilo',
            'message' => 'Messaggio',
        ],
    ],
];
