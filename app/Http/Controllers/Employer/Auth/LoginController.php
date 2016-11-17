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

        $email = $request->input('email');
        $password = $request->input('password');
        $this->validate($request, ['email' => 'required|email|exists:employers,email', 'password' => 'required'], ['email.exists' => 'Email does not exists in our system']);
        if (auth()->guard('employer')->attempt(['email' => $email, 'password' => $password, 'status' => 1])) {
            $auth = Auth::guard('employer')->user();
            $organization_name = $auth->organization_name;
            $profile_photo = $auth->photo;
            $contact_name = $auth->contact_name;
            $photo_url = $auth->photo;
            $user_since = $auth->created_at->diffforhumans();
            Session::put('organization_name', $organization_name);
            Session::put('profile_photo', $profile_photo);
            Session::put('contact_name', $contact_name);
            Session::put('photo_url', $photo_url);
            Session::put('user_since', $user_since);
            Session::put('employer_info', $auth);
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
