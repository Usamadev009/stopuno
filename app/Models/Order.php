<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function sellerService()
    {
        return $this->belongsTo(SellerService::class, 'seller_service_id', 'id');
    }

    public function userCart()
    {
        return $this->hasMany(UserCart::class, 'order_id', 'id');
    }
}
