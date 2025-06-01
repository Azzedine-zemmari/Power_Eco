<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'stock', 'categorie_id', 'image', 'status','sell_price','marge'];
    public function cartItems(){
    return $this->hasMany(CartItem::class);
    }

}
