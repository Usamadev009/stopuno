<?php

/**
 * Description - Generic Helper Functions
 * @author Umar A
 * @class Coupon
 */

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use App\Models\SellerService;
use App\Models\CouponCode;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    /**
     * @author Umar A
     */
    public function __construct()
    { }

    /**
     * Description - Search List of Users
     * @author Umar A
     */
    public function userListing(Request $request)
    {

        try {
            $model = new User();

            $query = $model->activeStatus()->where('id', '!=', SUPER_ADMIN);

            if (!empty($request['search'])) {
                $query = $query->where('name', 'LIKE', '%' . $request['search'] . '%');
            }

            $data = $query->limit(10)->get(['id', 'name as text']);

            return ['result' => $data];
            // return response()->json(['result' => $data], 200);
        } catch (Exception $e) {
            return response()->json(['message' =>  __('general.error_msg')], 500);
        }
    }

    public function branchSearch(Request $request)
    {

        try {
            $model = new SellerService();

            $query = $model->activeStatus();

            if (!empty($request['search'])) {
                $query = $query->where('name', 'LIKE', '%' . $request['search'] . '%');
            }
            if (!empty($request['service_id'])) {
                $query = $query->where('platform_id', $request['service_id']);
            }

            $data = $query->limit(10)->get(['id', 'name as text']);

            return ['result' => $data];
            // return response()->json(['result' => $data], 200);
        } catch (Exception $e) {
            return response()->json(['message' =>  __('general.error_msg')], 500);
        }
    }
}
