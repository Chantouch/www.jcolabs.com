<?php

namespace App\Http\Controllers\Employer\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
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
        return view('employers.auth.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(Request $request)
    {

        $contact_email = $request->input('contact_email');
        $password = $request->input('password');
        $this->validate($request, ['contact_email' => 'required|email|exists:employers,contact_email', 'password' => 'required'], ['contact_email.exists' => 'Email does not exists in our system']);
        if (auth()->guard('employer')->attempt(['contact_email' => $contact_email, 'password' => $password, 'status' => 1])) {
            $organization_name = Auth::guard('employer')->user()->organization_name;
            $profile_photo = Auth::guard('employer')->user()->photo;
            $contact_name = Auth::guard('employer')->user()->contact_name;
            $photo_url = Auth::guard('employer')->user()->photo;
            $user_since = Auth::guard('employer')->user()->created_at->diffforhumans();
            Session::put('organization_name', $organization_name);
            Session::put('profile_photo', $profile_photo);
            Session::put('contact_name', $contact_name);
            Session::put('photo_url', $photo_url);
            Session::put('user_since', $user_since);
            Session::put('employer_info', Auth::guard('employer')->user());
            return redirect()->intended('employers/dashboard');
        } else {
            return redirect()->intended('employer/login')->withInput()->with('error', 'Invalid password or Account is not activated.');
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        auth()->guard('employer')->logout();
        return redirect()->intended('employer/login');
    }

}
