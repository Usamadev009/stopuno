<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverPay extends Model
{
    use HasFactory, BaseModel;

    protected $table = 'driver_pay';

    protected $fillable = ['charge_type', 'base_pay', 'min_pay', 'recursive'];


    /**
     * Fetch Active Status
     * @author Umar A
     */
    public function scopeActiveDriverPay($query)
    {
        $query->where('status', ACTIVE);
    }


    /**
     * Fetch Delivery Service
     * @author Umar A
     */
    public function service()
    {
        return $this->belongsTo(Platform::class);
    }

    /**
     * Save/Update Delivery Info
     * @author Umar A
     */
    public function updateDriverPayDetails($request)
    {
        if (!$this->id) {
            $this->business_ref_id = generateBusinessReferenceId($this, config('default-data.ref_prefix.driver'));
            $this->status = ACTIVE;
        }

        $delDistance = [];
        foreach ($request['distance'] as $d => $distance) {
            $calDist = explode(",", $distance['value']);
            $delDistance[$d]['min_distance'] = $calDist[0];
            $delDistance[$d]['max_distance'] = $calDist[1];
            $delDistance[$d]['amount'] = $distance['amount'];
        }

        $this->distance = json_encode($delDistance);

        $this->platform_id = $request['platform_id'];

        return $this->saveUpdateInfo($this, $request->only('charge_type', 'base_pay', 'min_pay'));
    }
}
