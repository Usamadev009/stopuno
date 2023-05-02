<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * @author Zeeshan N
     */

    public $partial, $order;

    public function __construct()
    {
        $this->partial = 'admin.order.';
        $this->order = new Order();
    }

    /**
     * Description - Create Lists of Order
     * @author Zeeshan N
     */
    public function listing(Request $request)
    {
        try {
            $orders = $this->order->newQuery()->paginate(PAGINATE);
            return $this->createView(
                $this->partial . 'index',
                'Orders',
                ['orders' => $orders]
            );
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Create Lists of Order
     * @author Zeeshan N
     */
    public function details($id)
    {
        try {
            $order = $this->order->newQuery()->where('id', $id)->first();
            return $this->createView(
                $this->partial . 'details',
                'Order Details',
                ['order' => $order]
            );
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }
}
