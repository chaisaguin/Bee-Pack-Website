<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'Order_Item_ID', 'Order_ID', 'Product_ID', 'Quantity', 
        'Unit_Price', 'Total_Price', 'Added_Date'
    ];

    // Define relationships if needed, e.g., with CustomerOrder
    public function order()
    {
        return $this->belongsTo(CustomerOrder::class, 'Order_ID', 'Order_ID');
    }
}
