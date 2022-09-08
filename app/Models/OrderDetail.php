<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'total',
        'price',
        'quantity',
        'order_id',
        'product_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
