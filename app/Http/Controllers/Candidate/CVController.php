<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Model\frontend\Candidate;
use App\Models\CandidateEduDetails;
use App\Models\CandidateExpDetails;
use App\Models\CandidateInfo;
use App\Models\CandidateLanguageInfo;
use App\Models\City;
use App\Models\DepartmentType;
use App\Models\EduDetails;
use App\Models\IndustryType;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\Exception\ErrorException;
use Validator;
use DB;

class CVController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function personalInfo()
    {
        $c_id = auth()->guard('candidate')->user();
        $gender = Candidate::$gender;
        return view('candidates.personal_info', compact('c_id', 'gender'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePersonalInfo(Request $request)
    {

        $candidate = auth()->guard('candidate')->user();
        $validator = Validator::make($data = $request->all(), Candidate::rules($candidate->id), Candidate::$messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $dob = date('Y-m-d', strtotime($request->dob));
        $data['dob'] = $dob;
        $candidate->update($data);

        return redirect()->route('candidate.dashboard')->with('message', 'Personal/Contact Info has been added');

    }
}
