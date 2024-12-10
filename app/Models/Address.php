<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use App\Models\User;

class Address extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'addresses';

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'locality',
        'address',
        'city',
        'state',
        'country',
        'landmark',
        'zip',
        'type',
        'is_default'
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
