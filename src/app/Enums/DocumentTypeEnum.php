<?php

namespace App\Enums;

enum DocumentTypeEnum: string
{
    case ID_CARD = 'id_card';
    case DRIVING_LICENSE = 'driving_license';
    case PASSPORT = 'passport';
    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
