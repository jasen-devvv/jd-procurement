<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case ACCEPT = 'accept';
    case REJECT = 'reject';
}
