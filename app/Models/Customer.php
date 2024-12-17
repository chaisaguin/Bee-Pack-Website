<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent; 
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use App\Events\CustomerUpdated;
use App\Models\CustomerOrder;

class Customer extends Eloquent implements AuthenticatableContract
{
    use Authenticatable;

    protected $connection = 'mongodb';
    protected $collection = 'customers';

    protected $fillable = [
        'Customer_ID',
        'Customer_ContactNumber',
        'Customer_Address',
        'Customer_Email',
        'Customer_Name',
        'Password',
        'email_verified_at'
    ];

    protected $hidden = [
        'Password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the password for the user.
     */
    public function getAuthPassword()
    {
        return $this->Password; // Return plain password
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(array $credentials)
    {
        return $this->Password === $credentials['password'];
    }

    /**
     * Get the name of the unique identifier for the user.
     */
    public function getAuthIdentifierName()
    {
        return 'Customer_Email';
    }

    /**
     * Get the unique identifier for the user.
     */
    public function getAuthIdentifier()
    {
        return $this->Customer_Email;
    }

    /**
     * Get the orders for the customer.
     */
    public function orders()
    {
        return $this->hasMany(CustomerOrder::class, 'Customer_ID', 'Customer_ID');
    }

    protected static function boot()
    {
        parent::boot();
    
        static::creating(function ($customer) {
            event(new CustomerUpdated($customer));
        });
    
        static::updating(function ($customer) {
            event(new CustomerUpdated($customer));
        });
    
        static::deleting(function ($customer) {
            event(new CustomerUpdated($customer));
        });
    }
}
