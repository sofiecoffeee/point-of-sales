<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'total_price',
        'change',
        'payment_method',
        'payment_status',
        'snap_token',
    ];

    protected $casts = [
        'total_price' => 'integer',
        'change' => 'integer',
        'payment_method' => 'integer',
        'payment_status' => 'integer',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'order_id', 'id');
    }

}
