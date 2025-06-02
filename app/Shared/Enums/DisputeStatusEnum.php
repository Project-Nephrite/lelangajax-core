<?php


namespace App\Shared\Enums;

enum DisputeStatusEnum: string
{
    case Open = "open";
    case Process = "process";
    case Close = "close";
}
