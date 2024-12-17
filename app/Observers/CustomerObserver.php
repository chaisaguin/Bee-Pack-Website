<?php

namespace App\Observers;

use App\Models\Customer;
use App\Events\CustomerUpdated;

class CustomerObserver
{
    public function created(Customer $customer)
    {
        event(new CustomerUpdated($customer));
    }

    public function updated(Customer $customer)
    {
        event(new CustomerUpdated($customer));
    }

    public function deleted(Customer $customer)
    {
        event(new CustomerUpdated($customer));
    }
}
