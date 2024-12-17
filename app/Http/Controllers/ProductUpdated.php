<?php

namespace App\Http\Controllers;
use MongoDB\Client;
use App\Models\Products;

class ProductUpdated
{
    public $productId;
    public $previousState;
    public $newState;

    public function __construct($productId, $previousState, $newState)
    {
        $this->productId = $productId;
        $this->previousState = $previousState;
        $this->newState = $newState;
    }
}
