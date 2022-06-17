<?php

namespace App\Enums;

enum TransactionStatus: string
{
    case OPEN = 'Open';
    case OVERDUE = 'Overdue';
    case PARTIAL = 'Partial';
    case PAID = 'Paid';
    case UNAPPLIED = 'Unapplied';
    case CLOSED = 'Closed';
    case UNKNOWN = 'Unknown';
}
