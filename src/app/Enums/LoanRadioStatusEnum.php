<?php

namespace App\Enums;

enum LoanRadioStatusEnum: string
{
    case LOANED = 'loaned'; // The radio is currently loaned out.
    case RETURNED = 'returned'; // The radio has been returned in good condition.
    case LOST = 'lost'; // The radio was lost during the loan period.
    case DAMAGED = 'damaged'; // The radio was returned but is damaged.
    case REPLACED = 'replaced'; // The radio was replaced with another during the loan.
    case UNDER_REVIEW = 'under_review'; // The radio is under investigation for an issue.


    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
