<?php

namespace App\Enums;

enum RadioStatusEnum : string
{
    case AVAILABLE = 'available'; // The radio is available for loan.
    case LOANED = 'loaned'; // The radio is currently loaned to a user.
    case BROKEN = 'broken'; // The radio is broken and cannot be used.
    case LOST = 'lost'; // The radio has been reported as lost.
    case UNDER_MAINTENANCE = 'under_maintenance'; // The radio is undergoing maintenance and is temporarily unavailable.
    case RESERVED = 'reserved'; // The radio has been reserved for a future loan but is not yet loaned out.
    case DECOMMISSIONED = 'decommissioned'; // The radio is no longer in service and has been retired from use.
    case IN_TRANSIT = 'in_transit'; // The radio is being transferred between locations and is not available.
    case NEEDS_REPAIR = 'needs_repair'; // The radio has been flagged for repair but is not yet under maintenance.


    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
