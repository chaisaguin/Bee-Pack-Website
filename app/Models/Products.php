<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Products extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'product';

}
