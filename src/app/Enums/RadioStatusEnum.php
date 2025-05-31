<?php

namespace App\Enums;

enum RadioStatusEnum : string
{
    case AVAILABLE = 'available'; // The radio is available for loan.
    case UNLOANABLE = 'unloanable'; // The radio cannot be loaned.


    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
