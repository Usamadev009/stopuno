<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use BaseModel;

    protected $table = 'seller';
    protected $fillable = [
        'email',
    ];


    /**
     * Fetch Active Status
     */
    public function scopeActiveSeller($query)
    {
        $query->where('status', ACTIVE);
    }
}
