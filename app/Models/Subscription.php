<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory, BaseModel;

    protected $table = 'subscription';
    protected $fillable = ['name', 'price', 'description', 'currency', 'interval', 'image'];

    protected function getPriceAttribute($value)
    {
        return number_format($value, 2, '.', ' ');
    }

    /**
     * Description - Save / Update Subscription Info
     * @param array $request
     * @author Umar A
     */
    public function updateSubscriptionDetails($data, $stripePlan)
    {
        if (!$this->id) {
            $this->business_ref_id = generateBusinessReferenceId($this, config('default-data.ref_prefix.subscription'));
            $this->status = ACTIVE;
            $this->plan_id = $stripePlan->id;
            $this->product_id = $stripePlan->product;
        }
        $this->platform_id = $data['platform_id'];
        return $this->saveUpdateInfo($this, $data);
    }
}
