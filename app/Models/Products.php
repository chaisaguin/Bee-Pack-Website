<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Products extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'products';

    protected $fillable = [
        'Product_ID',
        'Product_Name',
        'Product_Description',
        'Product_Price',
        'Product_Image',
        'image_path',
        'category',
        'stock'
    ];
}
