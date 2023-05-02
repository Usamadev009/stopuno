<?php

namespace App\Http\Controllers\Admin\Deal;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Deal\SaveRequest;
use App\Http\Requests\Admin\Deal\UpdateRequest;
use App\Models\SellerService;
use App\Models\Coupon;
use App\Models\Deal;
use App\Models\Platform;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DealController extends Controller
{
    /**
     * @author Zeeshan N
     */

    public $partial, $deal, $coupon, $service, $branch;

    public function __construct()
    {
        $this->partial = 'admin.deal.';
        $this->deal = new Deal();
        $this->coupon = new Coupon();
        $this->service = new Platform();
        $this->branch = new SellerService();
    }

    /**
     * Description - Create Lists of Deals
     * @author Zeeshan N
     */
    public function listing(Request $request)
    {
        try {
            $deals = $this->deal->newQuery()->activeStatus()->paginate(PAGINATE);
            return $this->createView(
                $this->partial . 'index',
                'Deals',
                ['deals' => $deals]
            );
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Create view of Deals
     * @author Zeeshan N
     */
    public function create(Request $request, $id = "")
    {
        try {

            $coupons = $this->coupon->newQuery()->activeStatus()->whereNull('seller_service_id')->where('type', 'auto')->get();
            $services = $this->service->newQuery()->activeStatus()->get();
            $branches = "";
            $deal = "";

            if (isset($id) && !empty($id)) {
                $deal = $this->deal->newQuery()->where('id', $id)->first();
                $bIds = $deal->branchDeal()->pluck('seller_service_id')->toArray();
                $branches = $this->branch->newQuery()->whereIn('id', $bIds)->get();
            }

            return $this->createView(
                $this->partial . '.create',
                'Deal',
                [
                    'deal' => $deal,
                    'coupons' => $coupons,
                    'services' => $services,
                    'branches' => $branches,
                ]
            );
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Create view of Deals
     * @author Zeeshan N
     */
    public function save(SaveRequest $request)
    {
        try {
            DB::beginTransaction();
            if (!empty($request->deal_image)) {
                $request['image'] = $this->uploadFile('deal_image', DEAL_PATH);
            }

            $deal = $this->deal->updateDealDetails($request);
            if ($deal) {
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
            $deal = $this->deal->newQuery()->where('id', $id)->first();
            if ($deal) {
                $deal->status = DELETE;
                if ($deal->update()) {
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

    // /**
    //  * Description - Edit view of Coupon
    //  * @author Zeeshan N
    //  */
    // public function edit(Request $request, $id)
    // {
    //     try {
    //         $couponCode = $this->couponCode->newQuery()->activeStatus()->first();
    //         $coupons = $this->coupon->newQuery()->activeStatus()->whereNull('branch_id')->get();

    //         $branches = $this->branch->newQuery()->activeStatus()->take(5)->get();

    //         if ($coupons) {
    //             return $this->createView(
    //                 $this->partial . '.generate',
    //                 'Generate Coupon',
    //                 [
    //                     'couponCode' => $couponCode,
    //                     'coupons' => $coupons,
    //                     'branches'    => $branches,
    //                 ]
    //             );
    //         }
    //         session()->flash('error', __('general.no_record_found'));
    //         return redirect()->back();
    //     } catch (Exception $e) {
    //         session()->flash('error', __('general.error_msg'));
    //         return redirect()->back();
    //     }
    // }

    /**
     * Description - Update Coupon
     * @author Zeeshan N
     */
    public function update(UpdateRequest $request)
    {
        try {
            DB::beginTransaction();
            $model = $this->deal->newQuery()->where('id', $request['id'])->first();
            if (!empty($request->deal_image)) {
                $request['image'] = $this->uploadFile('deal_image', DEAL_PATH);
            }

            $deal = $model->updateDealDetails($request);
            if ($deal) {
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
}
