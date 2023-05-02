<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponCode extends Model
{
    use HasFactory, BaseModel;

    protected $table = "coupon_code";

    protected $fillable = [
        'coupon_prefix',
        'coupon_code',
        'url',
        'amount',
        'use_coupon_amount',
        'all',
        'is_admin',
        'limit',
    ];

    /**
     * Get the coupon that owns the CouponCode
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }

    /**
     * Description - Save / Update Code Info
     * @param array $request
     * @author Umar A
     */
    public function updateCouponCodeDetails($request)
    {
        if (!$this->id) {
            $this->business_ref_id = generateBusinessReferenceId($this, config('default-data.ref_prefix.coupon'));
            $this->status = ACTIVE;
            $this->is_admin = 1;
        }

        $this->coupon_id = $request['coupon_id'];

        if (isset($request['days'])) {
            $request['days'] = implode(",", $request['days']);
        }

        if (isset($request['overwrite'])) {
            $this->use_coupon_amount = 0;
        }

        if (isset($request['date_time'])) {
            $date = explode(" - ", $request['date_time']);
            $this->start_date = $date[0];
            $this->end_date = $date[1];
        }

        // dd($request->all());
        return $this->saveUpdateInfo($this, $request->all());
    }
}
