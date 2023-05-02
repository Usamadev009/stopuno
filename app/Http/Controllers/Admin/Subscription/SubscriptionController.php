<?php

namespace App\Http\Controllers\Admin\Subscription;

use App\Drivers\StripePay;
use App\Http\Controllers\Controller;
use App\Models\Platform;
use App\Models\Subscription;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    /**
     * @author Zeeshan N
     */

    public $platform, $subs, $stripe, $partial;

    public function __construct()
    {
        $this->platform = new Platform();
        $this->subs = new Subscription();
        $this->stripe = new StripePay();
        $this->partial = 'admin.subscription.';
    }

    /**
     * Description - Create Lists of Platform
     * @author Zeeshan N
     */
    public function listing(Request $request)
    {
        try {
            $subscriptions = $this->subs->newQuery()->where('status', '!=', DELETE)->paginate(PAGINATE);
            return $this->createView(
                $this->partial . 'index',
                'Subscriptions',
                ['subscriptions' => $subscriptions]
            );
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Create view of Platform
     * @author Zeeshan N
     */
    public function create(Request $request)
    {
        try {
            $platforms = $this->platform->newQuery()->where('parent_id', null)->activePlatform()->get();
            return $this->createView(
                $this->partial . '.create',
                'Subscription',
                ['platforms' => $platforms]
            );
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Create view of Platform
     * @author Zeeshan N
     */
    public function save(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!empty($request->image)) {
                $request['image'] = $this->uploadFile('image', SUBSCRIPTION_PATH);
            }

            $plan = $this->stripe->createUpdatePlan($request['name'], $request['price'], $request['interval'], $request['currency'], $request['description']);

            $subs = $this->subs->updateSubscriptionDetails($request->all(), $plan);
            if ($subs) {
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
            return redirect()->back()->withInput();
        }
    }

    /**
     * Description - Delete Platform
     * @author Zeeshan N
     */
    public function delete(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $sub = $this->subs->newQuery()->where('id', $id)->first();
            if ($sub) {
                $del = $this->stripe->deleteProductPlan($sub->plan_id, $sub->product_id);
                $sub->status = DELETE;
                if ($sub->update()) {
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
     * Description - Edit view of Platform
     * @author Zeeshan N
     */
    public function edit(Request $request, $id)
    {
        try {
            $subscription = $this->subs->newQuery()->where('id', $id)->first();
            if ($subscription) {
                return $this->createView(
                    $this->partial . '.create',
                    'Subscription',
                    [
                        'subscription' => $subscription,
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
     * Description - Updae Subscription
     * @author Zeeshan N
     */
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $subscription = $this->subs->newQuery()->where('id', $request['id'])->first();
            if (!empty($request->platform_image)) {
                $request['image'] = $this->uploadFile('platform_image', PLATFORMS_PATH);
            }

            if ($subscription) {
                DB::beginTransaction();
                if (!empty($request->image)) {
                    $request['image'] = $this->uploadFile('image', SUBSCRIPTION_PATH);
                }

                $plan = $this->stripe->createUpdatePlan($request['name'], $request['price'], $request['interval'], $request['currency'], $request['description'], $subscription->plan_id, $subscription->product_id);

                $subs = $this->subs->updateSubscriptionDetails($request->all(), $plan);
                if ($subs) {
                    DB::commit();
                    session()->flash('success', __('general.updated'));
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
}
