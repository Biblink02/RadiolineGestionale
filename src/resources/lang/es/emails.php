<?php

return [
    'contact_confirmation' => [
        'subject' => 'Confirmación de Solicitud de Contacto Medjugorje Service',
        'greeting' => 'Hola :firstName :lastName,',
        'body' => 'Gracias por contactarnos. Te responderemos lo antes posible.',
        'footer' => 'Este es un mensaje automático, por favor no respondas.',

        'form_intro' => ':firstName escribió:',
        'fields' => [
            'firstName' => 'Nombre',
            'lastName' => 'Apellido',
            'phone' => 'Teléfono',
            'email' => 'Correo electrónico',
            'profileType' => 'Tipo de perfil',
            'message' => 'Mensaje',
        ],
    ],
];
