<?php

namespace App\Enums;

enum LoanStatusEnum : string
{
    case ACTIVE = 'active'; // The loan is currently ongoing
    case COMPLETED = 'completed'; // The loan has been returned successfully
    case OVERDUE = 'overdue'; // The loan has exceeded the return date
    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
