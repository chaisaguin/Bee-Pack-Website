<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Payment extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'payments';
    public $timestamps = false;  // Disable timestamps

    protected $fillable = [
        'Payment_ReferenceCode',
        'Payment_Method'
    ];
}
