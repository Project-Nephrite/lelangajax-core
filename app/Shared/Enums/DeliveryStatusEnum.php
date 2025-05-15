<?php

namespace App\Shared\Enums;

enum DeliveryStatusEnum: string
{
    case Waiting = "waiting";
    case Process = "process";
    case Delivery = "delivery";
}
