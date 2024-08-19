<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $casts = [
        'order_status' => OrderStatusEnum::class,
    ];

    protected $fillable = [
        'order_number',
        'order_status',
        'order_summary',
        'customer_name',
        'customer_chat_id',
        'customer_phone_number',
        'floor'
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('F j, Y, g:i:s a');
    }
}
