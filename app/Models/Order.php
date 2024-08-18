<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $casts = [
        'order_status' => OrderStatusEnum::class,
    ];

    protected $fillable = ['order_number','order_status', 'customer_name', 'customer_phone_number', 'floor'];
}
