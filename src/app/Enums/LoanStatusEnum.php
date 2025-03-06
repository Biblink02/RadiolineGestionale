<?php

namespace App\Enums;

enum LoanStatusEnum : string
{
    case PENDING = 'pending'; // The loan request is pending approval
    case APPROVED = 'approved'; // The loan request has been approved
    case REJECTED = 'rejected'; // The loan request has been rejected
    case ACTIVE = 'active'; // The loan is currently ongoing
    case COMPLETED = 'completed'; // The loan has been returned successfully
    case OVERDUE = 'overdue'; // The loan has exceeded the return date
    case CANCELED = 'canceled'; // The loan request was canceled before approval
    case ISSUE_REPORTED = 'issue_reported'; // A problem has been reported with the loan
    case ISSUE_RESOLVED = 'issue_resolved'; // The reported issue has been resolved
    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
