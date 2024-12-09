<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class CustomerOrder extends Model
{
    use HasFactory;

    // Define fillable attributes
    protected $fillable = [
        'Order_ID', 'Customer_ID', 'Shipment_ID', 'Feedback_ID', 
        'Payment_ReferenceCode', 'Order_Status', 'Order_Date'
    ];

    // Define relationships if needed, e.g., with OrderItem
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'Order_ID', 'Order_ID');
    }
}
