<?php

return [
    'contact_confirmation' => [
        'subject' => 'Confirmação de Solicitação de Contato Medjugorje Service',
        'greeting' => 'Olá :firstName :lastName,',
        'body' => 'Obrigado por entrar em contato conosco. Responderemos o mais rápido possível.',
        'footer' => 'Esta é uma mensagem automática, por favor não responda.',

        'form_intro' => ':firstName escreveu:',
        'fields' => [
            'firstName' => 'Nome',
            'lastName' => 'Sobrenome',
            'phone' => 'Telefone',
            'email' => 'E-mail',
            'profileType' => 'Tipo de perfil',
            'message' => 'Mensagem',
        ],
    ],
];
