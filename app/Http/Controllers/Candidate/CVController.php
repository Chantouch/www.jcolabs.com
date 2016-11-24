<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Model\frontend\Candidate;
use App\Models\CandidateInfo;
use Illuminate\Http\Request;
use Validator;

class CVController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function personalInfo()
    {
        $c_id = auth()->guard('candidate')->user();
        return view('candidates.personal_info', compact('c_id'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePersonalInfo(Request $request)
    {
        $candidate_info = new CandidateInfo();
        $validator = Validator::make($data = $request->all(), $candidate_info->rules(), $candidate_info::$messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $candidate = auth()->guard('candidate')->user();

        $candidate->update($data);

        return redirect()->route('candidate.dashboard')->with('message', 'Personal/Contact Info has been added');

    }
}
