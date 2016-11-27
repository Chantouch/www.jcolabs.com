<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Model\frontend\Candidate;
use App\Models\CandidateInfo;
use App\Models\EduDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $candidate->update($data);

        return redirect()->route('candidate.dashboard')->with('message', 'Personal/Contact Info has been added');

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function createEduDetails()
    {
        $id = auth()->guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        $degree_level = EduDetails::degree_level();
        if (count($candidate->educations) == 0) {
            return view('candidates.edu.create', compact('degree_level'));
        } else {
            return redirect()->route('candidate.edit.edu.details')->with('message', 'Edit your change if needed');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeEduDetails(Request $request)
    {

        $id = auth()->guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        if (count($candidate->educations) == 0) {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), EduDetails::rules($request));
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->with('error', 'Please review your fields');
            }

            foreach ($request->city_id as $key => $n) {
                $entry = [
                    'candidate_id' => $id,
                    'city_id' => $request->city_id[$key],
                    'degree_level' => $request->degree_level[$key],
                    'description' => $request->description[$key],
                    'end_date' => $request->end_date[$key],
                    'grade' => $request->grade[$key],
                    'is_studying' => $request->is_studying[$key],
                    'field_of_study' => $request->field_of_study[$key],
                    'school_university_name' => $request->school_university_name[$key],
                    'start_date' => $request->start_date[$key],
                    'country_name' => $request->country_name[$key],
                ];

                EduDetails::create($entry);
            }

            DB::commit();

            return redirect()->route('candidate.dashboard')->with('message', 'Your education added successfully');

        } else {
            return redirect()->route('candidate.edit.edu_details')->with('message', 'Edit your change if needed');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function editEduDetails()
    {
        $id = Auth::guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        $degree_level = EduDetails::degree_level();
        $educations = EduDetails::where('candidate_id', $id)->get();
        if (count($candidate->educations) >= 1) {
            return view('candidates.edu.edit', compact('educations', 'degree_level'));
        } else {
            return redirect()->route('candidate.create.edu.details')->with('message', 'You can not edit without filling up your bio');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateEduDetails(Request $request)
    {
        $data = $request->all();
        $id = auth()->guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        $edu = EduDetails::where('candidate_id', $id)->get();
        if (count($candidate->educations) >= 1) {
            DB::beginTransaction();
            foreach ($edu as $i => $value) {
                $rules = [
                    'city_id' . $edu[$i]->city_id => 'required',
                    'degree_level' . $edu[$i]->degree_level => 'required',
                ];
                $this->validate($request, $rules);
                $candidate_edu_details = EduDetails::with('candidate')->find($data['eduIds'][$i]);
                $candidate_edu_details->city_id = $data['city_id' . $value->city_id];
                $candidate_edu_details->degree_level = $data['degree_level' . $value->degree_level];
//                $candidate_edu_details->description = $data['description' . str_replace("/[^A-Za-z0-9?![:space:]]/", "_", $value->description)];
//                $candidate_edu_details->end_date = $data['end_date' . Carbon::parse($value->end_date)->format('d_M_Y')];
                $candidate_edu_details->grade = $data['grade' . $value->grade];
                $candidate_edu_details->is_studying = $data['is_studying' . $value->is_studying];
//                $candidate_edu_details->field_of_study = $data['field_of_study' . $value->field_of_study];
                $candidate_edu_details->country_name = $data['country_name' . $value->country_name];
                $candidate_edu_details->school_university_name = $data['school_university_name' . $value->school_university_name];
//                $candidate_edu_details->start_date = $data['start_date' . $value->start_date];
                $candidate_edu_details->update();

            }


            DB::commit();

            return redirect()->route('candidate.dashboard')->with('message', 'Educational Information has been Updated!');
        } else {

            return redirect()->route('candidate.create.edu.details')->with('message', 'You can not edit without inserting data');
        }
    }
}
