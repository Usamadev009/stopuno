<?php

/**
 * @Author Zeeshan N
 * @Class Dashboard
 */

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\SellerService;
use App\Models\Category;
use App\Models\Deal;
use App\Models\Order;
use App\Models\Platform;;;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public $partial, $platform, $sellerService, $category, $deal, $user, $order;

    public function __construct()
    {
        $this->partial = 'admin.dashboard.index';
        $this->platform = new Platform();
        $this->sellerService = new SellerService();
        $this->category = new Category();
        $this->deal = new Deal();
        $this->user = new User();
        $this->order = new Order();
    }

    /**
     * Description - Create view of Dashboard
     */
    public function index(Request $request)
    {
        $platformCount = $this->platform->newQuery()->activeStatus()->count();
        $sellerServiceCount = $this->sellerService->newQuery()->activeStatus()->count();
        $categoryCount = $this->category->newQuery()->activeStatus()->count();
        $dealsCount = $this->deal->newQuery()->activeStatus()->count();
        $orderPendingCount = $this->order->newQuery()->where('order_status', 'pending')->count();
        $orderCompletedCount = $this->order->newQuery()->where('order_status', 'completed')->count();
        $userCount = $this->user->newQuery()->activeStatus()->whereNotIn('id', [SUPER_ADMIN, ADMIN])->count();
        return $this->createView($this->partial, 'Dashboard', [
            'platformCount' => $platformCount,
            'sellerServiceCount' => $sellerServiceCount,
            'categoryCount' => $categoryCount,
            'dealsCount' => $dealsCount,
            'userCount' => $userCount,
            'orderPendingCount' => $orderPendingCount,
            'orderCompletedCount' => $orderCompletedCount
        ]);
    }

    public function create(Request $request)
    {
        return $this->createView($this->partial, 'User');
    }
}
