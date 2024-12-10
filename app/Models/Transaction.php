<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Transaction extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'transactions';

    protected $fillable = [
        'customer_id',
        'order_id',
        'mode',
        'status',
        'amount'
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
