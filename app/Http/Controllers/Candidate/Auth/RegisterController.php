<?php

namespace App\Http\Controllers\Candidate\Auth;

use App\Mail\CandidateActivation;
use App\Model\frontend\Candidate;
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
        $this->middleware('guest');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRegisterForm()
    {
        return view('candidates.auth.register');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return Candidate
     */
    protected function create(array $data)
    {
        //Generate Temp enrollment ID Job id
        $records = Candidate::all()->count();
        $current_id = 1;
        if (!$records == 0) {
            $current_id = Candidate::all()->last()->id + 1;
        }
        $enroll_id = 'TMP_EMP' . date('Y') . str_pad($current_id, 5, '0', STR_PAD_LEFT);

        return Candidate::create([
            'name' => $data['name'],
            'mobile_num' => $data['mobile_num'],
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
            'name.required' => 'Please enter name',
            'mobile_num.required' => 'Please enter mobile phone',
            'email.required' => 'Please enter email',
            'email.unique' => 'This email is already taken. Please input a another email',
            'password.required' => 'Please enter password',
        );

        $rules = array(
            'name' => 'required|max:255',
            'mobile_num' => 'required',
            'email' => 'required|email|max:255|unique:candidates',
            'password' => 'required|min:6|confirmed',
        );

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
            return redirect('candidate/register')
                ->withErrors($validator)
                ->withInput();
        }
        DB::beginTransaction();
        try {
            $candidate = $this->create($request->all());
            $email = new CandidateActivation(new Candidate([
                'name' => $candidate->name,
                'confirmation_code' => $candidate->confirmation_code,
            ]));
            Mail::to($candidate->email)->send($email);
            DB::commit();
            if ($candidate->id) {
                return redirect('/candidate/login')->withInput()->with('status', 'You have successfully register with our website, please check your email to activate your account.');
            } else {
                return redirect('candidate/register')->withInput()->with('status', 'Candidate not register. Please try again');
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

            Candidate::where('confirmation_code', $token)->firstOrFail()->verified();

        } catch (ModelNotFoundException $exception) {

            return back()->with('status', 'The token already used, or broken.');

        }

        return redirect('candidate/login')->withInput()->with('status', 'You already activated your account, Please login here!');
    }
}
