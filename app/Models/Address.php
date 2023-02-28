<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = ['postalCode','city'];

    public function customer()
    {
        return $this->hasMany(Customer::class); 
        //select * from customers where address.id = customers.address_id
    }
}
