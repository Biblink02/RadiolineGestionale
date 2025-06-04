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

    public static function getDescription(ClientProfileTypeEnum $enum): string
    {
        return match ($enum) {
            self::A => 'Agency Profile',
            self::G => 'Guide Profile',
            self::H => 'Hotel Profile',
            self::L => 'Laic Organizer Profile',
            self::R => 'Religious Accompanist Profile',
            default => 'Unknown Profile',
        };
    }

    public static function getProfileTypeOptions(): array
    {
        $options = [];

        foreach (self::cases() as $enum) {
            $options[$enum->value] = $enum->value . ' ~ ' . self::getDescription($enum);
        }

        return $options;
    }
}
