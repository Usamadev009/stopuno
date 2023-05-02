<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use BaseModel;

    protected $table = 'platform';
    protected $fillable = [
        'name',
        'image',
        'color',
        'description',
        'terms_description',
        'fee',
        'ein_required',
        'business_type'
    ];

    protected function getImageAttribute($value)
    {
        return env('ADMIN_URL') . $value;
    }

    // protected function setImageAttribute($value)
    // {
    //     $this->attributes['image'] = env('MEDIA_URL') . $value;
    // }

    /**
     * Get all of the ParentPlatform for the Platform
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function parentPlatform()
    {
        return $this->belongsTo(Platform::class, 'parent_id', 'id');
    }

    /**
     * Get all of the ChildService for the Service
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function childPlatforms()
    {
        return $this->hasMany(Platform::class, 'parent_id', 'id');
    }

    public function scopeFetchParent($query)
    {
        $query->whereNull('parent_id');
    }

    /**
     * Get all of the Cateogries for the Platform
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany(Category::class, 'platform_id', 'id');
    }

    /**
     * Get all of the Branches for the Service
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function branches()
    {
        return $this->hasMany(SellerService::class, 'platform_id', 'id');
    }

    /**
     * Fetch Active Status
     */
    public function scopeActivePlatform($query)
    {
        $query->where('status', ACTIVE);
    }

    /**
     * Description - Save / Update Platform Info
     * @param array $request
     * @author Umar A
     */
    public function updatePlatformDetails($request)
    {
        if (!$this->id) {
            $this->business_ref_id = generateBusinessReferenceId($this, config('default-data.ref_prefix.platform'));
            $this->status = ACTIVE;
        }

        if (isset($request['questions'])) {
            $this->question = json_encode(array_filter($request['questions']));
        }

        $this->parent_id = $request['parent_id'];
        return $this->saveUpdateInfo($this, $request->only('name', 'parent_id', 'color', 'image', 'fee', 'description', 'terms_description', 'business_type', 'ein_required'));
    }
}
