<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCartItem extends Model
{
    use HasFactory;

    protected $table = "user_cart_item";

    /**
     * Get all of the Item for the UserCart
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function item()
    {
        return $this->belongsTo(BranchItem::class, 'item_id', 'id');
    }

    /**
     * Get all of the Parent for the UserCart
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childs()
    {
        return $this->hasMany(UserCartItem::class, 'parent_id');
    }
}
