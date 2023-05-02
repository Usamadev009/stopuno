<?php

/**
 * @author Zeeshan N
 * @class Delivery
 */

namespace App\Http\Controllers\Admin\Delivery;

use App\Http\Requests\Admin\Delivery\UpdateRequest;
use App\Http\Requests\Admin\Delivery\SaveRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Models\Platform;
use Exception;

class DeliveryController extends Controller
{
    /**
     * @author Zeeshan N
     */

    public $partial, $delivery, $platform;

    public function __construct()
    {
        $this->partial = 'admin.delivery.';
        $this->delivery = new Delivery();
        $this->platform = new Platform();
    }

    /**
     * Description - Create Lists of delivery
     * @author Zeeshan N
     */
    public function listing(Request $request)
    {
        try {
            $deliveries = $this->delivery->newQuery()->activeDelivery()->paginate(PAGINATE);
            return $this->createView(
                $this->partial . 'index',
                'Delivery',
                ['deliveries' => $deliveries]
            );
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Create view of delivery
     * @author Zeeshan N
     */
    public function create(Request $request)
    {
        try {
            $deliveryServiceIds = $this->delivery->newQUery()->distinct()->where('status', '!=', DELETE)->pluck('platform_id')->toArray();
            $platforms = $this->platform->newQuery()->whereNotIn('id', $deliveryServiceIds)->activePlatform()->get();
            return $this->createView($this->partial . '.create', 'Delivery', ['platforms' => $platforms]);
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

            foreach ($request['platform_ids'] as $key => $platform_id) {
                $request['platform_id'] = $platform_id;
                $model = $this->delivery->newInstance();
                $delivery = $model->updatedeliveryDetails($request);
                if (!$delivery) {
                    break;
                }
            }
            if ($delivery) {
                DB::commit();
                session()->flash('success', __('general.saved'));
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
            $platforms = $this->platform->newQuery()->whereNotIn('id', $deliveryServiceIds)->activePlatform()->get();
            $delivery = $this->delivery->newQuery()->where('id', $id)->activedelivery()->first();
            return $this->createView($this->partial . '.create', 'Delivery', ['platforms' => $platforms, 'delivery' => $delivery]);
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
            $model = $this->delivery->newQuery()->where('id', $request['id'])->first();

            $request['platform_id'] = $request['platform_ids'][0];

            $delivery = $model->updatedeliveryDetails($request);
            if ($delivery) {
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
