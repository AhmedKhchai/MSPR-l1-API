<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function orderProducts(){
        return $this->hasMany(OrderProducts::class);
    }
    public function products(){
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id');
    }
}
