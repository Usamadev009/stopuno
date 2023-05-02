<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Description - BASE Model to handle common functions
 * @author Umar A
 */
trait BaseModel
{
    // public $primaryKey = 'business_ref_id';

    /**
     * Description - Saving Model Info
     * @author Umar A
     */
    public function saveUpdateInfo($model, $param)
    {
        $model->fill($param);
        if (!$model->id) {
            $model->created_by = Auth::id();
        }

        $model->updated_by = Auth::id();
        if ($model->save()) {
            return $model;
        }

        return false;
    }

    /**
     * Description - Saving Model Info
     * @author Umar A
     */
    public function getInfoByBusinessRefId($model, $id)
    {
        return $model->where('business_ref_id', $id)->where('status', ACTIVE)->first();
    }

    /**
     * Fetch Active Status
     * @author Umar A
     */
    public function scopeActiveStatus($query)
    {
        $query->where('status', ACTIVE);
    }

    /**
     * Fetch Custome Status
     * @author Umar A
     */
    public function scopeCustomStatus($query, $status)
    {
        $query->whereIn('status', $status);
    }

    /**
     * Description - Delete Record
     * @author Umar A
     */
    public function deleteRecordInfo($model, $id)
    {
        $info = $model->where('id', $id)->first();
        if ($info) {
            $info->status = DELETE;
            if ($info->update()) {
                return true;
            }
        }

        return false;
    }
}
