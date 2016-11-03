<?php

namespace App\Http\Controllers\Employer;

use App\Model\backend\Employer;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChangePasswordController extends Controller
{

    /**
     * @param array $data
     * @return mixed
     */
    public function credentialRule(array  $data)
    {
        $message = [
            'current_password.required' => 'Please enter your current password',
            'password.required' => 'Please enter new password',
        ];

        $validator = Validator::make($data, [
            'current_password' => 'required',
            'password' => 'required|same:password',
            'confirm_new_password' => 'required|same:password',
        ]);

        return $validator;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|string
     */
    public function changePassword(Request $request)
    {
        $auth = Auth::guard('employer')->user();
        if ($auth) {
            $request_data = $request->all();
            $validator = $this->credentialRule($request_data);
            if ($validator->fails()) {
//                return response()->json(array('error' => $validator->getMessageBag()->toArray()), 400);
                $this->throwValidationException($request, $validator);
                return redirect()->route('employer.company.show_form_change_password')->with('error', $validator)->withInput();
            } else {
                $current_password = $auth->password;
                if (Hash::check($request_data['current_password'], $current_password)) {
                    $id = $auth->id;
                    $obj_user = Employer::find($id);
                    $obj_user->password = bcrypt($request_data['password']);
                    $obj_user->save();
                    return redirect()->back()->with('status', 'Password already changed successfully');
                } else {
//                    $error = array('current_password' => 'Please enter correct current password');
                    return redirect()->route('employer.company.show_form_change_password')->with('error', 'Please enter the correct current password')->withInput();
//                    return response()->json(array('error' => $error), 400);
                }
            }
        } else {
            return redirect()->intended('employers/dashboard')->with('message', 'Thanks');
        }
    }
}
