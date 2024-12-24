<?php

namespace App\Enums;

enum RequestStatus: string
{
    case PENDING = 'pending';
    case SUCCESS = 'success';
    case REJECT = 'reject';
}
