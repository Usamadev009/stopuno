<?php

/**
 * @author Zeeshan N
 */

namespace App\Http\Controllers\Admin\User;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\SaveOfficialRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\Role;
use App\Models\Seller;

class UserController extends Controller
{
    /**
     * @author Zeeshan N
     */

    public $partial, $user, $seller, $role, $service;

    public function __construct()
    {
        $this->partial = 'admin.user.';
        $this->user = new User();
        $this->seller = new Seller();
        $this->role = new Role();
    }

    /**
     * Description - Users Listing
     * @author Zeeshan N
     */
    public function listing(Request $request)
    {
        try {
            $users = $this->user->newQuery()->whereDoesntHave('userRoles')->customStatus([ACTIVE, PENDING])->where('id', "!=", SUPER_ADMIN)->paginate(PAGINATE);
            return $this->createView($this->partial . 'index', 'Users', ['users' => $users]);
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Sellers Listing
     * @author Zeeshan N
     */
    public function sellerListing(Request $request)
    {
        try {
            $users = $this->user->newQuery()->customStatus([ACTIVE, PENDING])->where('id', "!=", SUPER_ADMIN)->whereHas('seller')->paginate(PAGINATE);
            return $this->createView($this->partial . 'index', 'Sellers', ['users' => $users]);
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Officials Listing
     * @author Zeeshan N
     */
    public function officialListing(Request $request)
    {
        try {
            $users = $this->user->newQuery()->whereHas('userRoles')->customStatus([ACTIVE, PENDING])->where('id', "!=", SUPER_ADMIN)->paginate(PAGINATE);
            return $this->createView($this->partial . 'index', 'Officials', ['users' => $users]);
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Officials Listing
     * @author Zeeshan N
     */
    public function create(Request $request)
    {
        try {
            $roles = $this->role->newQuery()->activeStatus()->where('id', '!=', SUPER_ADMIN)->get();
            return $this->createView($this->partial . 'create', 'Officials', ['roles' => $roles]);
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Edit view of User
     * @author Zeeshan N
     */
    public function edit(Request $request, $id)
    {
        try {
            if ($id == SUPER_ADMIN) {
                // session()->flash('error', 'Role Not Found');
                return redirect()->back();
            }
            $user = $this->user->newQuery()->where('id', $id)->first();
            $sellers = $this->seller->newQuery()->where('user_id', $user->id)->get();
            if ($user) {
                return $this->createView(
                    $this->partial . 'details',
                    'User',
                    [
                        'user'       => $user,
                        'sellers'       => $sellers,
                    ]
                );
            }
            session()->flash('error', 'User Not Found');
            return redirect()->back();
        } catch (Exception $e) {
            dd($e->getMessage());
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Auth Profile Information
     * @author Zeeshan N
     */
    public function profileInfo(Request $request)
    {
        try {
            $service = $this->service->newQuery()->where('id', Auth::id())->activePlatform()->first();
            $parentService = $this->service->newQuery()->fetchParent()->get();
            if ($service) {
                return $this->createView(
                    $this->partial . '.create',
                    'Services',
                    [
                        'parentService' => $parentService,
                        'service'       => $service,
                    ]
                );
            }
            session()->flash('error', 'Service Not Found');
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    public function saveOfficials(SaveOfficialRequest $request)
    {

        try {
            DB::beginTransaction();
            $model = $this->user;

            $user = $model->saveofficials($request);
            if ($user) {
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

    public function update(UpdateRequest $request)
    {

        try {
            DB::beginTransaction();
            $model = $this->user->newQuery()->where('id', $request['id'])->first();

            $user = $model->updateUserDetails($request);
            if ($user) {
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

    public function profileImage(Request $request)
    {
        try {
            DB::beginTransaction();
            $model = $this->user->newQuery()->where('id', $request['user_id'])->first();
            if (!empty($request->file)) {
                $model->image = $this->uploadFile('file', USER_PATH);
            }

            $user = $model->updateUserDetails($request);
            if ($user) {
                DB::commit();
                return response()->json(['message' => __('general.updated')], 200);
            }

            return response()->json(['message' => __('general.error_msg')], 200);
            DB::rollBack();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => __('general.error_msg')], 500);
        }
    }
}
