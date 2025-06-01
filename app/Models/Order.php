<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id','email','first_name','last_name','phone','address','apartment','city','postal_code','notes','total_price','status'];
}
