<?php

namespace App\Http\Controllers\Employer\Auth;

use App\Mail\EmployerActivation;
use App\Model\backend\Employer;
use App\Model\frontend\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use League\Flysystem\Exception;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;

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
        $this->middleware('guest:employer');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRegisterForm()
    {
        return view('employers.auth.register');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return Employer
     */
    protected function create(array $data)
    {
        //Generate Temp enrollment ID Job id
        $records = Employer::all()->count();
        $current_id = 1;
        if (!$records == 0) {
            $current_id = Employer::all()->last()->id + 1;
        }
        $enroll_id = 'TMP_EMP' . date('Y') . str_pad($current_id, 5, '0', STR_PAD_LEFT);

        return Employer::create([
            'contact_name' => $data['contact_name'],
            'organization_name' => $data['organization_name'],
            'contact_mobile_no' => $data['contact_mobile_no'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'confirmation_code' => str_random(30),
            'temp_enrollment_no' => $enroll_id,
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
            'contact_name.required' => 'Please enter name',
            'organization_name.required' => 'Please enter organization name',
            'contact_mobile_no.required' => 'Please enter mobile phone',
            'email.required' => 'Please enter email',
            'email.unique' => 'This email is already taken. Please input a another email',
            'password.required' => 'Please enter password',
            'terms.required' => 'Please accept to our term and condition',
        );

        $rules = array(
            'contact_name' => 'required|max:255',
            'organization_name' => 'required|max:255',
            'contact_mobile_no' => 'required',
            'email' => 'required|email|max:255|unique:employers',
            'password' => 'required|min:6|confirmed',
            'terms' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
            return redirect('employer/register')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            $employer = $this->create($request->all());
            $email = new EmployerActivation(new Employer([
                'contact_name' => $employer->contact_name,
                'confirmation_code' => $employer->confirmation_code,
            ]));
            Mail::to($employer->email)->send($email);
            DB::commit();
            if ($employer->id) {
                return redirect('/employer/login')->withInput()->with('status', 'You have successfully register with our website, please check your email to activate your account.');
            } else {
                return redirect('employer/register')->withInput()->with('status', 'Employer not register. Please try again');
            }
        } catch (Exception $e) {
            DB::rollback();
            return back()->withInput()->withErrors('status', 'Error while registering in our website, Please contact to our Teach Support');
        }
    }

    /**
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify($token)
    {

        try {

            Employer::where('confirmation_code', $token)->firstOrFail()->verified();

        } catch (ModelNotFoundException $exception) {

            return back()->with('status', 'The token already used, or broken.');

        }

        return redirect('employer/login')->withInput()->with('status', 'You already activated your account, Please login here!');
    }
}
