<?php

namespace App\Shared\Enums;

enum ListingStatusEnum: string
{
    case Open = 'open';
    case Close = 'close';
    case Hold = 'on_hold';
}
