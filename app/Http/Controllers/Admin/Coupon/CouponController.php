<?php

/**
 * @author Zeeshan N
 * @class Coupon
 */

namespace App\Http\Controllers\Admin\Coupon;

use Exception;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Coupon\List\SaveRequest;
use App\Http\Requests\Admin\Coupon\List\UpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    /**
     * @author Zeeshan N
    */

    public $partial, $coupon;

    public function __construct()
    {
        $this->partial = 'admin.coupon.';
        $this->coupon = new Coupon();
    }

    /**
     * Description - Create Lists of Coupons
     * @author Zeeshan N
     */
    public function listing(Request $request)
    {
        try {
            $coupons = $this->coupon->newQuery()->activeCoupon()->paginate(PAGINATE);
            return $this->createView(
                $this->partial . 'index',
                'Coupons',
                ['coupons' => $coupons]
            );
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Create view of Coupon
     * @author Zeeshan N
     */
    public function create(Request $request)
    {
        try {
            $coupons = $this->coupon->newQuery()->activeStatus()->whereNull('seller_service_id')->get();
            return $this->createView($this->partial . '.create', 'Coupon', ['coupons' => $coupons]);
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Create view of Coupon
     * @author Zeeshan N
     */
    public function save(SaveRequest $request)
    {
        try {
            DB::beginTransaction();
            $coupon = $this->coupon->updateCouponDetails($request);
            if ($coupon) {
                DB::commit();
                session()->flash('success', __('general.saved'));
                return redirect()->back();
            }

            DB::rollBack();
            session()->flash('error', __('general.error_updating'));
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Delete Coupon
     * @author Zeeshan N
     */
    public function delete(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $coupon = $this->coupon->newQuery()->where('id', $id)->first();
            if ($coupon) {
                $coupon->status = DELETE;
                if ($coupon->update()) {
                    DB::commit();
                    session()->flash('error', __('general.deleted'));
                    return redirect()->back();
                }
            }
            DB::rollBack();
            session()->flash('error', __('general.error_updating'));
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Edit view of Coupon
     * @author Zeeshan N
     */
    public function edit(Request $request, $id)
    {
        try {
            $coupon = $this->coupon->newQuery()->where('id', $id)->first();
            $coupons = $this->coupon->newQuery()->activeStatus()->whereNull('seller_service_id')->get();
            if ($coupon) {
                return $this->createView(
                    $this->partial . '.create',
                    'Coupons',
                    [
                        'coupon' => $coupon,
                        'coupons' => $coupons
                    ]
                );
            }
            session()->flash('error', __('general.no_record_found'));
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Update Coupon
     * @author Zeeshan N
     */
    public function update(UpdateRequest $request)
    {
        try {
            DB::beginTransaction();
            $coupon = $this->coupon->newQuery()->where('id', $request['id'])->first();
            $coupon = $coupon->updateCouponDetails($request);
            if ($coupon) {
                DB::commit();
                session()->flash('success', __('general.updated'));
                return redirect()->back();
            }

            if ($coupon) {
                DB::commit();
                session()->flash('success', __('general.updated'));
                return redirect()->back();
            }

            DB::rollBack();
            session()->flash('error', __('general.error_updating'));
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }


    /**
     * Description - Duplicate of Coupon
     * @author Zeeshan N
     */
    public function dulicateCoupon(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $coupon = $this->coupon->newQuery()->where('id', $id)->first();

            // $duplicate = $coupon->getAttributes();

            unset($coupon['id'], $coupon['created_by'], $coupon['updated_by'], $coupon['created_at'], $coupon['updated_at']);

            $attr = $coupon->getAttributes();
            $attr['days'] = explode(",", $attr['days']);
            $duplicate = $this->coupon->newInstance();

            $duplicate = $duplicate->updateCouponDetails($attr, true);
            if ($duplicate) {
                DB::commit();
                session()->flash('success', __('general.updated'));
                return redirect()->back();
            }

            DB::rollBack();
            session()->flash('error', __('general.error_updating'));
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }
}
