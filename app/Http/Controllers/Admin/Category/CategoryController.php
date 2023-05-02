<?php

/**
 * @author Zeeshan N
 * @class Category
 */

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\DeleteRequest;
use App\Http\Requests\Admin\Category\EditRequest;
use App\Http\Requests\Admin\Category\SaveRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;
use App\Models\Platform;;;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * @author Zeeshan N
     */
    public $partial, $category, $platform;

    public function __construct()
    {
        $this->partial = 'admin.category.';
        $this->category = new Category();
        $this->platform = new Platform();
    }

    /**
     * Description - Create Lists of Category
     * @author Zeeshan N
     */
    public function listing(Request $request)
    {
        try {
            $category = $this->category->newQuery()->activeCategory()->paginate(PAGINATE);
            return $this->createView($this->partial . 'index', 'Category', ['category' => $category]);
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Create view of Category
     * @author Zeeshan N
     */
    public function create(Request $request)
    {
        try {
            $parentCategory = $this->category->newQuery()->fetchParent()->get();
            $platforms = $this->platform->newQuery()->activePlatform()->get();
            return $this->createView(
                $this->partial . '.create',
                'Category',
                ['parentCategory' => $parentCategory, 'platforms' => $platforms]
            );
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Create view of Category
     * @author Zeeshan N
     */
    public function save(SaveRequest $request)
    {
        try {
            DB::beginTransaction();
            if (!empty($request->category_image)) {
                $request['image'] = $this->uploadFile('category_image', CATEGORY_PATH);
            }
            if (!empty($request->category_banner)) {
                $request['banner'] = $this->uploadFile('category_banner', CATEGORY_PATH);
            }
            if (!isset($request['sub_category'])) {
                $request['parent_id'] = NULL;
            }
            $platform = $this->category->updateCategoryDetails($request);
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
     * Description - Delete Category
     * @author Zeeshan N
     */
    public function delete(DeleteRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $platform = $this->category->newQuery()->where('id', $id)->activeCategory()->first();
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
     * Description - Edit view of Category
     * @author Zeeshan N
     */
    public function edit(EditRequest $request, $id)
    {
        try {
            $category = $this->category->newQuery()->where('id', $id)->activeCategory()->first();
            $parentCategory = $this->category->newQuery()->fetchParent()->where([['id', '!=', $id]])->get();
            $platforms = $this->platform->newQuery()->activePlatform()->get();
            if ($category) {
                return $this->createView(
                    $this->partial . '.create',
                    'Category',
                    [
                        'parentCategory' => $parentCategory,
                        'platforms'       => $platforms,
                        'category'       => $category,
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

    /**
     * Description - Updae Category
     * @author Zeeshan N
     */
    public function update(UpdateRequest $request)
    {
        try {
            DB::beginTransaction();
            $model = $this->category->newQuery()->where('id', $request['id'])->first();
            if (!empty($request->category_image)) {
                $request['image'] = $this->uploadFile('category_image', CATEGORY_PATH);
            }
            if (!empty($request->category_banner)) {
                $request['banner'] = $this->uploadFile('category_banner', CATEGORY_PATH);
            }
            if (!isset($request['sub_category'])) {
                $request['parent_id'] = NULL;
            }
            $service = $model->updateCategoryDetails($request);
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
