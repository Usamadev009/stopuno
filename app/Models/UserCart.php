<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCart extends Model
{
    use HasFactory;

    protected $table = "user_cart";

    /**
     * Get all of the CartItems for the UserCart
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cartItems()
    {
        return $this->hasMany(UserCartItem::class, 'cart_id', 'id');
    }
}
