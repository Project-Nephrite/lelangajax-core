<?php

namespace App\Shared\Enums;


enum TransactionStatusEnum: string
{
    case Pending = "pending";
    case Settlement = "settlement";
    case Failed = "failed";
    case Refund = "refund";
    case Cancel = "cancel";
}
