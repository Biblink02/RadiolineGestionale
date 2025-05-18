<?php

namespace App\Enums;

enum ClientProfileTypeEnum: string
{
    case A = 'A'; // Agency Profile
    case G = 'G'; // Guide Profile
    case H = 'H'; // Hotel Profile
    case L = 'L'; // Laic Organizer Profile
    case R = 'R'; // Religious Accompanist Profile

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}

