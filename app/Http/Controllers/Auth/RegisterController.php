<?php

/**
 * @Author Zeeshan N
 * @Class Login
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\SellerService;
use App\Models\Category;
use App\Models\Platform;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public $component, $user;

    public function __construct()
    {
        $this->component = 'components.auth.';
        $this->user = new User();
    }

    public function index(Request $request)
    {
        $services = Service::activeStatus()->get();
        $categories = Category::activeStatus()->get();
        $branch = Branch::get();
        return view($this->component . 'register', compact('services', 'categories', 'branch'));
    }
}
