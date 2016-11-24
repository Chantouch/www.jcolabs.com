<?php

namespace App\Http\Controllers\Candidate\Auth;

use App\Model\frontend\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use League\Flysystem\Exception;

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
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('github')->user();
        } catch (Exception $e) {
            return redirect()->route('auth.github');
        }

        $authUser = $this->findOrCreateUser($user);

        Auth::guard('candidate')->login($authUser, true);

        return redirect()->route('candidate.dashboard');
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $githubUser
     * @return Candidate
     */
    private function findOrCreateUser($githubUser)
    {
        if ($authUser = Candidate::where('github_id', $githubUser->id)->first()) {
            return $authUser;
        }
        $records = Candidate::all()->count();
        $current_id = 1;
        if (!$records == 0) {
            $current_id = Candidate::all()->last()->id + 1;
        }
        $enroll_id = 'TMP_EMP' . date('Y') . str_pad($current_id, 5, '0', STR_PAD_LEFT);
        $token = str_random(60);
        $temp_password = bcrypt('123456');
        return Candidate::create([
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'password' => $temp_password,
            'github_id' => $githubUser->id,
            'nationality' => 'Cambodian',
            'confirmation_code' => $token,
            'avatar' => $githubUser->avatar,
            'temp_enrollment_no' => $enroll_id,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLoginForm()
    {
        return view('candidates.auth.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(Request $request)
    {

        $email = $request->input('email');
        $remember = $request->input('remember');
        $password = $request->input('password');
        $this->validate($request, ['email' => 'required|email|exists:candidates,email', 'password' => 'required'], ['email.exists' => 'Email does not exists in our system']);
        if (auth()->guard('candidate')->attempt(['email' => $email, 'password' => $password, 'status' => 1], $remember)) {
            $organization_name = Auth::guard('candidate')->user()->organization_name;
            $profile_photo = Auth::guard('candidate')->user()->photo;
            $contact_name = Auth::guard('candidate')->user()->contact_name;
            $photo_url = Auth::guard('candidate')->user()->photo;
            $user_since = Auth::guard('candidate')->user()->created_at->diffforhumans();
            Session::put('organization_name', $organization_name);
            Session::put('profile_photo', $profile_photo);
            Session::put('contact_name', $contact_name);
            Session::put('photo_url', $photo_url);
            Session::put('user_since', $user_since);
            Session::put('candidate_info', Auth::guard('candidate')->user());
            return redirect()->intended('candidate/dashboard');
        } else {
            return redirect()->intended('candidate/login')->withInput()->with('error', 'Invalid password or Account is not activated.');
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        auth()->guard('candidate')->logout();
        return redirect()->intended('candidate/login');
    }

}
