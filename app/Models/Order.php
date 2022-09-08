<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'total',
        'order_date',
        'order_number',
        'customer_address',
        'customer_email',
        'customer_name',
        'customer_phone',
        'user_id'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_details');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

}
