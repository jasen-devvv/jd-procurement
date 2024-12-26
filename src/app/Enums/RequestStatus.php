<?php

namespace App\Enums;

enum RequestStatus: string
{
    case PENDING = 'pending';
    case ACCEPT = 'accept';
    case REJECT = 'reject';
}
