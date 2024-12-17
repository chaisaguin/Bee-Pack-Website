<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class OrderItem extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'order_items';

    protected $fillable = [
        'product_id',
        'order_id',
        'price',
        'quantity',
        'options',
        'rstatus'
    ];

    protected $casts = [
        'rstatus' => 'boolean',
        'options' => 'array'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
