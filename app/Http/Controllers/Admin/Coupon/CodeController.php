<?php

namespace App\Http\Controllers\Admin\Coupon;

use Exception;
use App\Models\User;
use App\Models\Coupon;
use App\Models\CouponCode;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SellerService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\Coupon\Code\SaveRequest;
use App\Http\Requests\Admin\Coupon\Code\UpdateRequest;

class CodeController extends Controller
{
    /**
     * @author Zeeshan N
     */

    public $partial, $coupon, $couponCode, $user, $branch;

    public function __construct()
    {
        $this->partial = 'admin.coupon-codes.';
        $this->coupon = new Coupon();
        $this->couponCode = new CouponCode();
        $this->user = new User();
        $this->branch = new SellerService();
    }

    /**
     * Description - Create Lists of Codes
     * @author Zeeshan N
     */
    public function listing(Request $request)
    {
        try {
            $codes = $this->couponCode->newQuery()->activeStatus()->paginate(PAGINATE);
            return $this->createView(
                $this->partial . 'codes',
                'Coupon Codes',
                ['codes' => $codes]
            );
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Create view of CouponCode
     * @author Zeeshan N
     */
    public function create(Request $request)
    {
        try {
            $coupons = $this->coupon->newQuery()->activeStatus()->whereNull('seller_service_id')->get();

            $users = $this->user->newQuery()->activeStatus()->where([
                ['id', '!=', SUPER_ADMIN],
                ['id', '!=', Auth::id()]
            ])->take(5)->get();

            $branches = $this->branch->newQuery()->activeStatus()->take(5)->get();

            $code = Str::random(6);

            return $this->createView(
                $this->partial . '.generate',
                'Generate Coupon',
                [
                    'code' => $code,
                    'coupons' => $coupons,
                    'users'    => $users,
                    'branches'    => $branches,
                ]
            );
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Create view of CouponCOde
     * @author Zeeshan N
     */
    public function save(SaveRequest $request)
    {
        try {
            DB::beginTransaction();
            $couponCode = $this->couponCode->updateCouponCodeDetails($request);
            if ($couponCode) {
                DB::commit();
                session()->flash('success', __('general.saved'));
                return redirect()->back();
            }

            DB::rollBack();
            session()->flash('error', __('general.error_saved'));
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
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
            $couponCode = $this->couponCode->newQuery()->where('id', $id)->first();
            if ($couponCode) {
                $couponCode->status = DELETE;
                if ($couponCode->update()) {
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
            $couponCode = $this->couponCode->newQuery()->where('id', $id)->first();
            $coupons = $this->coupon->newQuery()->activeStatus()->whereNull('branch_id')->get();

            $users = $this->user->newQuery()->activeStatus()->where([
                ['id', '!=', SUPER_ADMIN],
                ['id', '!=', Auth::id()]
            ])->take(5)->get();

            $branches = $this->branch->newQuery()->activeStatus()->take(5)->get();

            $code = Str::random(6);

            return $this->createView(
                $this->partial . '.generate',
                'Generate Coupon',
                [
                    'couponCode' => $couponCode,
                    'code' => $code,
                    'coupons' => $coupons,
                    'users'    => $users,
                    'branches'    => $branches,
                ]
            );
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
            $couponCode = $this->couponCode->newQuery()->where('id', $request['id'])->first();
            $couponCode = $couponCode->updateCouponCodeDetails($request);
            if ($couponCode) {
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
