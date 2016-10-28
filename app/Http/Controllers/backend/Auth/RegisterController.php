<?php

namespace App\Http\Controllers\backend\Auth;

use App\Mail\AdminActivation;
use App\Model\backend\Admin;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use League\Flysystem\Exception;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
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
        $this->middleware('guest');
    }

    public function getRegisterForm()
    {
        return view('backend/auth/register');
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return Admin
     */
    protected function create(array $data)
    {
        $email_token = str_random(30);
        return Admin::create([
            'name' => $data['name'],
            'mobile_no' => $data['mobile_no'],
            'email' => $data['email'],
            'email_token' => $email_token,
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function saveRegisterForm(Request $request)
    {
        $messages = array(
            'name.required' => 'Please enter name',
            'email.required' => 'Please enter email',
            'email.unique' => 'This email is already taken. Please input a another email',
            'password.required' => 'Please enter password',
        );

        $rules = array(
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        );

        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
            return redirect('admin/register')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {
            $admin = $this->create($request->all());
            $email = new AdminActivation(new Admin([
                'name' => $admin->name,
                'email_token' => $admin->email_token,
            ]));
            Mail::to($admin->email)->send($email);
            DB::commit();
            if ($admin->id) {
                return redirect('admin/login')->with('status', 'Admin register successfully, We have sent you an email to activate your account.');
            } else {
                return redirect('admin/register')->with('status', 'Admin not register. Please try again');
            }

        } catch (Exception $e) {
            DB::rollback();
            return back()->withErrors('error', 'Error while registering in our website, Please contact to our Teach Support');
        }

    }


    public function verify($token)
    {
        Admin::where('email_token', $token)->firstOrFail()->verified();
        return redirect('/admin/login')->with('status', 'You activated your account, Please login here!');
    }
}
