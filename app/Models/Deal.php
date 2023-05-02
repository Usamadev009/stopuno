<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory, BaseModel;

    protected $table = 'deal';

    protected $fillable = ['name', 'description', 'image'];

    /**
     * Get all of the deal for the Deal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function branchDeal()
    {
        return $this->hasMany(BranchDeal::class, 'deal_id', 'id');
    }

    /**
     * Description - Save / Update Deal Info
     * @param array $request
     * @author Umar A
     */
    public function updateDealDetails($request)
    {
        if (!$this->id) {
            $this->business_ref_id = generateBusinessReferenceId($this, config('default-data.ref_prefix.deal'));
            $this->status = ACTIVE;
        }

        if (isset($request['service'])) {
            $this->platform_id = $request['service'];
        }

        if (isset($request['coupon'])) {
            $this->coupon_id = $request['coupon'];
        }

        if (!isset($request['all'])) {
            $request['all'] = 0;
        } else {
            $request['all'] = 1;
        }

        $deal =  $this->saveUpdateInfo($this, $request->only('name', 'description', 'image', 'all'));
        if ($deal) {
            if (!empty($request['branch'])) {
                if (!$this->addBranchDeals($request['branch'])) {
                    return false;
                }
            }

            return $deal;
        }

        return false;
    }

    private function addBranchDeals($branches)
    {
        foreach ($branches as $branch) {
            $bDeal = new BranchDeal();
            $bDeal->seller_service_id = $branch;
            $bDeal->deal_id = $this->id;
            $bDeal->status = ACTIVE;
            if (!$bDeal->save()) {
                return false;
            }
        }

        return true;
    }
}
