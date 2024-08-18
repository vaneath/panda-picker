<?php

namespace App\Enums;

enum OrderStatusEnum: string
{
    case WAITING = 'waiting';
    case PREPARING = 'preparing';
    case DONE = 'done';
}
