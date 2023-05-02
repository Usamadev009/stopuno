<?php

namespace App\Http\Controllers\Admin\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellerController extends Controller
{
    /**
     * @author Zeeshan N
     */

    public $partial, $seller;

    public function __construct()
    {
        $this->partial = 'admin.platforms.';
        $this->seller = new Seller();
    }

    /**
     * Description - Update Seller Status
     * @author Zeeshan N
     */
    public function statusUpdate(Request $request, $id, $status)
    {
        try {
            DB::beginTransaction();
            $seller = $this->seller->newQuery()->where('id', $id)->first();
            if (!empty($seller)) {
                if ($seller->status != ACTIVE) {
                    $seller->status = ACTIVE;
                    if (!$seller->save()) {
                        DB::rollBack();
                        session()->flash('error', __('general.error_updating'));
                    }
                }
                $seller->status = $status;
                if ($seller->save()) {
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
