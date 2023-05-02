<?php

/**
 * @author Umar A
 * @Class Controller
 */

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Description - Creating View
     * @param string $partial
     * @param string $title
     * @param array $params
     * @author Umar A
     */

    public function createView($partials, $title = "", $params = [])
    {
        $params['partials'] = 'partials.' . $partials;
        $params['title'] = $title;
        return view('partials.base')->with($params);
    }

    /**
     * Description - Redirecting Back with message
     * @param string $message
     * @param string $type
     * @author Umar A
     */

    public function redirectBack($message = "", $type = 'success')
    {
        flash()->message($message, $type);
        return redirect()->back();
    }

    /**
     * Description - Redirecting Back with message
     * @param string $requestParam
     * @param string $path
     * @author Umar A
     */
    public function uploadFile($requestParam, $path)
    {
        $nameImg = \Str::random(7) . '-' . time() . '.' . request($requestParam)->getClientOriginalExtension();
        request($requestParam)->move(public_path($path), $nameImg);
        return $path . $nameImg;
    }
}
