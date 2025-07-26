<?php

namespace App\Enums;

enum ContactFormProfileTypeEnum: string
{
    case AGENCY = 'AGENCY';
    case ORGANIZATION = 'ORGANIZATION';
    case GUIDE = 'GUIDE';

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
