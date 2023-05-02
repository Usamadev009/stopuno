<?php

/**
 * @author Zeeshan N
 * @class Service
 */


namespace App\Http\Controllers\Admin\Platforms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Platform\DeleteRequest;
use App\Http\Requests\Admin\Platform\EditRequest;
use App\Http\Requests\Admin\Platform\SaveRequest;
use App\Http\Requests\Admin\Platform\UpdateRequest;
use App\Models\Platform;;;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlatformsController extends Controller
{
    /**
     * @author Zeeshan N
     */

    public $partial, $platform;

    public function __construct()
    {
        $this->partial = 'admin.platforms.';
        $this->platform = new Platform();
    }

    /**
     * Description - Create Lists of Platform
     * @author Zeeshan N
     */
    public function listing(Request $request)
    {
        try {
            $platforms = $this->platform->newQuery()->activePlatform()->whereNull('parent_id')->paginate(PAGINATE);
            return $this->createView(
                $this->partial . 'index',
                'Platforms',
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
    public function create(Request $request)
    {
        try {
            // $parentPlatform = $this->platform->newQuery()->fetchParent()->get();
            $parentPlatform = $this->platform->newQuery()->activeStatus()->get();
            return $this->createView($this->partial . '.create', 'Platforms', ['parentPlatform' => $parentPlatform]);
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Create view of Platform
     * @author Zeeshan N
     */
    public function save(SaveRequest $request)
    {
        try {
            DB::beginTransaction();
            if (!empty($request->platform_image)) {
                $request['image'] = $this->uploadFile('platform_image', PLATFORMS_PATH);
            }
            // if (!isset($request['sub_platform'])) {
            //     $request['parent_id'] = NULL;
            // }

            $platform = $this->platform->updatePlatformDetails($request);
            if ($platform) {
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
     * Description - Delete Platform
     * @author Zeeshan N
     */
    public function delete(DeleteRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $platform = $this->platform->newQuery()->where('id', $id)->activePlatform()->first();
            if ($platform) {
                $platform->status = DELETE;
                if ($platform->update()) {
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
     * Description - Detail view of platform
     * @author Zeeshan N
     */
    public function view(Request $request, $id)
    {
        try {
            $platform = $this->platform->newQuery()->where('id', $id)->activePlatform()->first();
            if ($platform) {
                return $this->createView(
                    $this->partial . '.detail',
                    'Platform',
                    [
                        'platform'       => $platform,
                    ]
                );
            }
            session()->flash('error', 'Platofrm Not Found');
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Edit view of Platform
     * @author Zeeshan N
     */
    public function edit(EditRequest $request, $id)
    {
        try {
            $platform = $this->platform->newQuery()->where('id', $id)->activePlatform()->first();
            $parentPlatform = $this->platform->newQuery()->fetchParent()->where('id', '!=', $id)->get();
            if ($platform) {
                return $this->createView(
                    $this->partial . '.create',
                    'Platforms',
                    [
                        'parentPlatform' => $parentPlatform,
                        'platform'       => $platform,
                    ]
                );
            }
            session()->flash('error', 'Platform Not Found');
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Updae Platform
     * @author Zeeshan N
     */
    public function update(UpdateRequest $request)
    {
        try {
            DB::beginTransaction();
            $model = $this->platform->newQuery()->where('id', $request['id'])->first();
            if (!empty($request->platform_image)) {
                $request['image'] = $this->uploadFile('platform_image', PLATFORMS_PATH);
            }
            // if (!isset($request['sub_platform'])) {
            //     $request['parent_id'] = NULL;
            // }

            $service = $model->updatePlatformDetails($request);
            if ($service) {
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
