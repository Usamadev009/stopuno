<?php

/**
 * @author Zeeshan N
 * @class Driver Pay
 */

namespace App\Http\Controllers\Admin\DriverPay;

use App\Http\Controllers\Controller;
use App\Models\Delivery;

use App\Http\Requests\Admin\Driverpay\SaveRequest;
use App\Http\Requests\Admin\Driverpay\UpdateRequest;
use Exception;

use Illuminate\Support\Facades\DB;

use App\Models\DriverPay;
use App\Models\Platform;
use Illuminate\Http\Request;

class DriverPayController extends Controller
{
    /**
     * @author Zeeshan N
     */

    public $partial, $driverPay, $service, $delivery;

    public function __construct()
    {
        $this->partial = 'admin.driver-pay.';
        $this->driverPay = new DriverPay();
        $this->service = new Platform();
        $this->delivery = new Delivery();

    }

    /**
     * Description - Create Lists of Driver Pay
     * @author Zeeshan N
     */
    public function listing(Request $request)
    {
        try {
            $driverPays = $this->driverPay->newQuery()->activeDriverPay()->paginate(PAGINATE);
            return $this->createView(
                $this->partial . 'index',
                'DriverPay',
                ['driverPays' => $driverPays]
            );
        } catch (Exception $e) {
            dd($e->getMessage());
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Create view of Driver Pay
     * @author Zeeshan N
     */
    public function create(Request $request)
    {
        try {
            $deliveryServiceIds = $this->driverPay->newQUery()->distinct()->where('status', '!=', DELETE)->pluck('platform_id')->toArray();
            $services = $this->service->newQuery()->whereNotIn('id', $deliveryServiceIds)->activePlatform()->get();
            return $this->createView($this->partial . '.create', 'DriverPay', ['services' => $services]);
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Create view of delivery
     * @author Zeeshan N
     */
    public function save(SaveRequest $request)
    {
        try {
            DB::beginTransaction();
            foreach ($request['service_ids'] as $key => $service_id) {
                $request['service_id'] = $service_id;
                $model = $this->driverPay->newInstance();
                $driverPay = $model->updateDriverPayDetails($request);
                if (!$driverPay) {
                    break;
                }
            }
            if ($driverPay) {
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
     * Description - Delete delivery
     * @author Zeeshan N
     */
    public function delete(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $delivery = $this->delivery->newQuery()->where('id', $id)->activedelivery()->first();
            if ($delivery) {
                $delivery->status = DELETE;
                if ($delivery->update()) {
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
     * Description - Edit view of delivery
     * @author Zeeshan N
     */
    public function edit(Request $request, $id)
    {
        try {
            $deliveryServiceIds = $this->delivery->newQuery()->distinct()->where('id', '!=', $id)->where('status', '!=', DELETE)->pluck('platform_id')->toArray();
            $services = $this->service->newQuery()->whereNotIn('id', $deliveryServiceIds)->activePlatform()->get();
            $delivery = $this->delivery->newQuery()->where('id', $id)->activedelivery()->first();
            return $this->createView($this->partial . '.create', 'Delivery', ['services' => $services, 'delivery' => $delivery]);
            session()->flash('error', 'delivery Not Found');
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Updae delivery
     * @author Zeeshan N
     */
    public function update(UpdateRequest $request)
    {
        try {
            DB::beginTransaction();
            $model = $this->driverPay->newQuery()->where('id', $request['id'])->first();

            $request['service_id'] = $request['service_ids'][0];

            $driverPay = $model->updateDriverPayDetails($request);
            if ($driverPay) {
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
