<?php

/**
 * Description - Seller Service Class
 * @author Zeeshan N
 */

namespace App\Http\Controllers\Admin\SellerService;

use Exception;
use App\Models\Role;
use App\Models\Seller;
use App\Models\Category;
use App\Models\Platform;
use App\Models\BranchItem;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\SellerService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\SaveRequest;
use App\Http\Requests\Admin\Role\UpdateRequest;

class SellerServiceController extends Controller
{
    /**
     * @author Zeeshan N
     */

    public $partial, $sellerService, $ssItem, $seller, $platform, $category, $permission, $role;

    public function __construct()
    {
        $this->partial = 'admin.seller-service.';
        $this->sellerService = new SellerService();
        $this->ssItem = new BranchItem();
        $this->seller = new Seller();
        $this->platform = new Platform();
        $this->category = new Category();
        $this->permission = new Permission();
        $this->role = new Role();
    }

    /**
     * Description - Create Lists of Business
     * @author Zeeshan N
     */
    public function listing(Request $request)
    {
        try {
            $platforms = $this->platform->newQuery()->activeStatus()->get();
            $categories = $this->category->newQuery()->activeStatus()->get();
            $sellerServices = $this->sellerService->newQuery();
            if (!empty($request['platform_ids'])) {
                $sellerServices = $sellerServices->whereIn('platform_id', $request['platform_ids']);
            }
            if (!empty($request['status'])) {
                $sellerServices = $sellerServices->whereIn('status', $request['status']);
            }
            if (!empty($request['category_ids'])) {
                $sellerServices = $sellerServices->whereHas('platform', function ($q) use ($request) {
                    $q->whereHas('categories', function ($qu) use ($request) {
                        $qu->whereIn('id', $request['category_ids']);
                    });
                });
                // dd($sellerServices);
            }
            $sellerServices = $sellerServices
                ->activeStatus()
                ->orWhere->customStatus([PENDING])
                ->whereHas('seller', function ($q) {
                    $q->where('status', ACTIVE);
                })
                ->paginate(PAGINATE);
            return $this->createView($this->partial . 'index', 'Business', ['sellerServices' => $sellerServices, 'platforms' => $platforms, 'categories' => $categories]);
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Create view of Branch
     * @author Zeeshan N
     */
    public function create(Request $request)
    {
        try {
            // $roles = $this->role->newQuery()->activeRole()->get();
            // $permissions = $this->permission->newQuery()->activePermission()->get();
            $permissions = $this->permission->newQuery()->get();
            return $this->createView(
                $this->partial . '.create',
                'Roles',
                ['permissions' => $permissions]
            );
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Create view of Branch
     * @author Zeeshan N
     */
    public function save(SaveRequest $request)
    {
        try {
            DB::beginTransaction();
            $role = $this->role->updateRoleDetails($request);
            if ($role) {
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
     * Description - Delete Branch
     * @author Zeeshan N
     */
    public function delete(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $sellerService = $this->sellerService->newQuery()->where('id', $id)->first();
            if ($sellerService) {
                $sellerService->status = DELETE;
                if ($sellerService->update()) {
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
     * Description - Edit view of Branch
     * @author Zeeshan N
     */
    public function edit(Request $request, $id)
    {
        try {
            $sellerService = $this->sellerService->newQuery()->where('id', $id)->first();
            if ($sellerService) {
                return $this->createView(
                    $this->partial . '.details',
                    'Business',
                    [
                        'sellerService'    => $sellerService,
                    ]
                );
            }
            session()->flash('error', 'Business Not Found');
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Update Role
     * @author Zeeshan N
     */
    public function update(UpdateRequest $request)
    {
        try {
            DB::beginTransaction();
            $model = $this->role->newQuery()->where('id', $request['id'])->first();
            $role = $model->updateRoleDetails($request);
            if ($role) {
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
     * Description - Delete Business
     * @author Zeeshan N
     */
    public function updateSellerServiceStatus(Request $request, $id, $status)
    {
        try {
            DB::beginTransaction();
            $sellerService = $this->sellerService->newQuery()->where('id', $id)->first();

            if (!empty($sellerService)) {
                $seller = $sellerService->createdBy;
                if ($seller->status != ACTIVE) {
                    $seller->status = ACTIVE;
                    if (!$seller->save()) {
                        DB::rollBack();
                        session()->flash('error', __('general.error_updating'));
                    }
                }
                $sellerService->status = $status;
                if ($sellerService->save()) {
                    DB::commit();
                    session()->flash('success', __('general.status_updated'));
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
     * Description - Delete Business
     * @author Zeeshan N
     */
    public function updateSellerServiceItemStatus(Request $request, $id, $status)
    {
        try {
            DB::beginTransaction();
            $ssItem = $this->ssItem->newQuery()->where('id', $id)->first();

            if (!empty($ssItem)) {

                $ssItem->status = $status;
                if ($ssItem->save()) {
                    DB::commit();
                    session()->flash('success', __('general.status_updated'));
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
