<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchItem extends Model
{
    use HasFactory;

    protected $table = "seller_service_item";

    protected function getImageAttribute($value)
    {
        return env('SELLER_URL') . $value;
    }

    public function discountedPrice()
    {
        $discounted_price = 0.00;
        if (!empty($this->deal)) {
            if (!empty($this->deal)) {
                $discounted_price = $this->deal->calculateDealDiscount($this->price);
                unset($this->deal->coupon);
            }
        }

        return ($this->price - $discounted_price);
    }

    public function items()
    {
        return $this->hasMany(SellerServiceItem::class, 'seller_service_id', 'id');
    }

    public function menu()
    {
        return $this->belongsTo(SellerServiceMenu::class, 'seller_service_menu_id');
    }
}
