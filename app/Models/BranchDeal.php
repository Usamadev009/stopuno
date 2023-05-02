<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchDeal extends Model
{
    use HasFactory, BaseModel;

    protected $table = 'seller_service_deal';

    protected function getImageAttribute($value)
    {
        return env('SELLER_URL') . $value;
    }
}
