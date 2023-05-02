<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerService extends Model
{
    use HasFactory, BaseModel;

    protected $table = 'seller_service';

    protected function getImageAttribute($value)
    {
        return env('SELLER_URL') . $value;
    }

    protected function getBannerAttribute($value)
    {
        return env('SELLER_URL') . $value;
    }

    /**
     * CREATED BY SELLER Relation
     */
    public function createdBy()
    {
        return $this->belongsTo(Seller::class, 'created_by', 'id');
    }

    /**
     * Platform Relation
     */
    public function platform()
    {
        return $this->belongsTo(Platform::class, 'platform_id', 'id');
    }

    /**
     * Platform Relation
     */
    public function orders()
    {
        return $this->hasMany(UserCart::class, 'seller_service_id', 'id');
    }

    /**
     * Fetch Active Status
     */
    public function scopeActiveBranch($query)
    {
        $query->where('status', ACTIVE);
    }

    /**
     * @author Umar A
     * Description - All Review of seller service
     */
    public function ratings()
    {
        return $this->hasMany(UserRating::class, 'seller_service_id', 'id');
    }

    /**
     * @author Umar A
     * Description - Average Seller Service Ratings
     */
    public function avgRating()
    {
        return round(UserRating::where('seller_service_id', $this->id)->where('user_rating.status', '!=', DELETE)->avg('rating'), 1);
    }

    /**
     * Seller Relation
     */
    public function seller()
    {
        return $this->belongsTo(Seller::class, 'created_by');
    }

    public function items()
    {
        return $this->hasMany(BranchItem::class, 'seller_service_id', 'id');
    }

    public function menus()
    {
        return $this->hasMany(SellerServiceMenu::class, 'seller_service_id', 'id');
    }
}
