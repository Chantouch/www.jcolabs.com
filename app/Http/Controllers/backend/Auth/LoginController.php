<?php

namespace App\Http\Controllers\backend\Auth;

use App\Model\backend\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLoginForm()
    {

        return view('backend/auth/login');

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(Request $request)
    {

        $email = $request->input('email');
        $password = $request->input('password');
        $this->validate($request, ['email' => 'required|email|exists:admins,email', 'password' => 'required'], ['email.exists' => 'Email does not exists in our system']);
        if (auth()->guard('admin')->attempt([
            'email' => $email,
            'password' => $password,
            'verified' => 1,
            'is_super_admin' => 1
        ])
        ) {
            Session::flash('success', 'You have successfully logged in to dashboard');
            return redirect()->intended('admin/dashboard');
        } else {
            return redirect()->intended('admin/login')->withInput()->with('error', 'Sorry you have permission to access this page or Invalid Login Credentials !');
        }

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        auth()->guard('admin')->logout();
        return redirect()->intended('admin/login');
    }

}
