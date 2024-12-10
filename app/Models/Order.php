<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Order extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'orders';

    protected $fillable = [
        'user_id',
        'order_id',
        'subtotal',
        'total',
        'name',
        'phone',
        'locality',
        'address',
        'state',
        'city',
        'country',
        'landmark',
        'zip',
        'type',
        'status',
        'is_shipping_different',
        'delivered_date',
        'canceled_date'
    ];

    protected $casts = [
        'is_shipping_different' => 'boolean',
        'delivered_date' => 'date',
        'canceled_date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
