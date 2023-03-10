<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function address()
    {
        return $this->belongsTo(Address::class);
        //select * from addresses where customer.address_id = addresses.id
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
        //select * from profilees where customer.profile_id = profilees.id
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
        //select * from companyes where customer.company_id = companyes.id
    }
    public function orders()
    {
        return $this->hasMany(Order::class); 
        //select * from orders where customer.id = orders.customer_id
    }
}
