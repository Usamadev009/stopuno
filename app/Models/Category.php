<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, BaseModel;

    protected $fillable = [
        'name',
        'description',
        'image',
        'banner',
    ];

    protected $table = 'category';

    protected function getImageAttribute($value)
    {
        return env('ADMIN_URL') . $value;
    }

    protected function getBannerAttribute($value)
    {
        return env('ADMIN_URL') . $value;
    }


    // protected function setBannerAttribute($value)
    // {
    //     $this->attributes['banner'] = env('MEDIA_URL') . $value;
    // }
    /**
     * Get all of the ParentCategory for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    /**
     * Get all of the ParentCategory for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function platform()
    {
        return $this->belongsTo(Platform::class, 'platform_id', 'id');
    }

    /**
     * Scope to fetch only Parent Category
     * @author Umar A
     */
    public function scopeFetchParent($query)
    {
        $query->whereNull('parent_id');
    }

    /**
     * Fetch Active Status
     * @author Umar A
     */
    public function scopeActiveCategory($query)
    {
        $query->where('status', ACTIVE);
    }

    /**
     * Description - Save / Update Category Info
     * @param array $request
     * @author Umar A
     */
    public function updateCategoryDetails($request)
    {
        if (!$this->id) {
            $this->business_ref_id = generateBusinessReferenceId($this, config('default-data.ref_prefix.category'));
            $this->status = ACTIVE;
        }
        $this->parent_id = $request['parent_id'];
        $this->platform_id = $request['platform_id'];
        return $this->saveUpdateInfo($this, $request->only('name', 'description', 'parent_id', 'platform_id', 'image', 'banner'));
    }
}
