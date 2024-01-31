<?php
namespace App\Http\Controllers\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class CustomLogoutController  extends Controller
{
    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function admin_logout(Request $request)
    {
                Auth::guard('admin')->logout();
                $request->session()->forget('guard.admin');
                return redirect('/admin/login');
    }

    public function user_logout(Request $request)
    {
                Auth::guard('web')->logout();
                $request->session()->forget('guard.web');
                return redirect('/');
    }


}
