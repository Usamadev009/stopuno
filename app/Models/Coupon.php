<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory, BaseModel;

    protected $table = 'coupon';

    protected $fillable = [
        // 'seller_service_id',
        'name',
        // 'code',
        // 'business_ref_id',
        'description',
        'limit',
        'availability',
        'type',
        'charge_type',
        'amount',
        'per_user_limit',
        'per_day_limit',
        'max_discount',
        'order_limit',
        'child_coupon',
        // 'start_date',
        // 'end_date',
        // 'days'
    ];

    /**
     * Get all of the ParentService for the Service
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    // public function parentService()
    // {
    //     return $this->belongsTo(Platform::class, 'parent_id', 'id');
    // }

    // public function scopeFetchParent($query)
    // {
    //     $query->whereNull('parent_id');
    // }

    /**
     * Fetch Active Status
     */
    public function scopeActiveCoupon($query)
    {
        $query->where('status', ACTIVE);
    }

    /**
     * Description - Save / Update Coupon Info
     * @param array $request
     * @author Umar A
     */
    public function updateCouponDetails($request, $duplicate = false)
    {
        if (!$this->id) {
            $this->business_ref_id = generateBusinessReferenceId($this, config('default-data.ref_prefix.coupon'));
            $this->status = ACTIVE;
        }

        // if (isset($request['days'])) {
        //     $request['days'] = implode(",", $request['days']);
        // }

        if (!empty($request['charge_type']) && $request['charge_type'] == 'free') {
            $request['amount'] = 0.00;
        }

        if (isset($request['availability'])) {
            $request['availability'] = 1;
        } else {
            $request['availability'] = 0;
        }

        $dateTime = NULL;
        if (isset($request['availability']) && $request['availability'] != 1 && isset($request['date_time'])) {
            foreach ($request['date_time'] as $key => $date) {
                $dTime = explode(" - ", $date);
                $dateTime[$key]['start_date'] = $dTime[0];
                $dateTime[$key]['end_date'] = $dTime[1];
                $dateTime[$key]['days'] = implode(",", $request['days'][$key]);
            }
        }

        $this->timing = !empty($dateTime) ? json_encode($dateTime) : NULL;
        // if (isset($request['date_time'])) {
        //     $date = explode(" - ", $request['date_time']);
        //     $request['start_date'] = $date[0];
        //     $request['end_date'] = $date[1];
        // }

        // dd($request->all());
        if ($duplicate) {
            return $this->saveUpdateInfo($this, $request);
        }
        return $this->saveUpdateInfo($this, $request->all());
    }
}
