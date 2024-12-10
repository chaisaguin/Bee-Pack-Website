<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Order extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'customer_order';

    protected $fillable = [
        'customer_id',
        'order_id',
        'Payment_ReferenceCode',
        'order_item_id',
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

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'Customer_ID');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
