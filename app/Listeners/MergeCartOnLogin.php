<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Http\Controllers\CartController;

class MergeCartOnLogin
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $cartController = new CartController();
        $cartController->mergeCart();
    }
}
