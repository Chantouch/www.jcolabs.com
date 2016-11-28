<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Model\frontend\Candidate;
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
            return redirect()->route('candidate.edu.details')->with('message', 'Edit your change if needed');
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function eduDetails()
    {
        $id = auth()->guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        $edu = EduDetails::where('candidate_id', $id)->get();
        if (count($candidate->educations) >= 1) {
            return view('candidates.edu.index', compact('edu'));
        } else {
            return redirect()->route('candidate.create.edu.details')->with('message', 'You can not edit without inserting data');
        }
    }

    /**
     * @param $idEdu
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showEdu($idEdu)
    {
        $id = auth()->guard('candidate')->user()->id;
        $edu = EduDetails::where('candidate_id', $id)->find($idEdu);
        return view('candidates.edu.show', compact('edu'));
    }

    /**
     * @param $idEdu
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editEdu($idEdu)
    {
        $id = Auth::guard('candidate')->user()->id;
        $degree_level = EduDetails::degree_level();
        $edu = EduDetails::where('candidate_id', $id)->find($idEdu);
        if (empty($edu)) {
            return redirect()->route('candidate.dashboard')->with('error', 'We can not find your education, Please consider to add one more! ');
        }
        return view('candidates.edu.edit', compact('edu', 'degree_level'));
    }

    public function updateEdu($idEdu, Request $request)
    {
        try {
            DB::beginTransaction();

            $edu = EduDetails::with('candidate')->find($idEdu);
            if (empty($edu)) {
                return redirect()->route('candidate.dashboard')->with('error', 'We can not find your education, Please consider to add one more! ');
            }
            $data = $request->all();
            $validator = Validator::make($data, EduDetails::$rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', ' Please check your fields again.');
            }
            $edu->update($data);
        } catch (ErrorException $errorException) {

        }
        DB::commit();
        return redirect()->route('candidate.edu.details')->with('message', 'Your education has been updated successfully');

    }

    public function deleteEdu($idEdu)
    {
        $id = Auth::guard('candidate')->user()->id;
        $edu = EduDetails::where('candidate_id', $id)->find($idEdu);
        if (empty($edu)) {
            return redirect()->route('candidate.dashboard')->with('error', 'Your Edu can not be found.');
        }
        $edu->delete($idEdu);
        return redirect()->route('candidate.edu.details')->with('message', 'Edu deleted successfully');
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
                $candidate_edu_details->description = $data['description' . EduDetails::clean($value->description)];
//                $candidate_edu_details->end_date = $data['end_date' . $value->end_date];
                $candidate_edu_details->grade = $data['grade' . $value->grade];
                $candidate_edu_details->is_studying = $data['is_studying' . $value->is_studying];
                $candidate_edu_details->field_of_study = $data['field_of_study' . EduDetails::clean($value->field_of_study)];
                $candidate_edu_details->country_name = $data['country_name' . $value->country_name];
                $candidate_edu_details->school_university_name = $data['school_university_name' . $value->school_university_name];
                $candidate_edu_details->start_date = $data['start_date' . Carbon::parse($value->start_date)->format('d_m_Y')];
                $candidate_edu_details->update();

            }


            DB::commit();

            return redirect()->route('candidate.dashboard')->with('message', 'Educational Information has been Updated!');
        } else {

            return redirect()->route('candidate.create.edu.details')->with('message', 'You can not edit without inserting data');
        }
    }


    public function langDetails()
    {
        $id = auth()->guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        $lang = CandidateLanguageInfo::where('candidate_id', $id)->get();
        if (count($candidate->language) >= 1) {
            return view('candidates.languages.index', compact('lang'));
        } else {
            return redirect()->route('candidate.create.language.details')->with('message', 'You can not edit without inserting data');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function createLang()
    {
        $id = Auth::guard('candidate')->user()->id;
        $level = CandidateLanguageInfo::level();
        $candidate = Candidate::find($id);

        if (count($candidate->language) == 0) {
            return view('candidates.languages.create', compact('level'));
        } else {
            return redirect()->route('candidate.lang.details')->with('message', 'Edit your change if needed more languages');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeLang(Request $request)
    {
        $id = Auth::guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        if (count($candidate->language) >= 0) {
            DB::beginTransaction();
            foreach ($request->name as $key => $n) {
                $entry = [
                    'candidate_id' => $id,
                    //'language_id'	    => $request->language_id[$key],
                    'name' => $n,
                    'read' => $request->read[$key],
                    'write' => $request->write[$key],
                    'speak' => $request->speak[$key],
                    'listen' => $request->listen[$key],
                ];

                CandidateLanguageInfo::create($entry);
            }
            DB::commit();
            return redirect()->route('candidate.dashboard')->with('message', 'Language details has been added');
        } else {
            return redirect()->back()->with('message', 'Language details already exists');
        }
    }

    /**
     * @param $idLang
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function editLang($idLang)
    {
        $id = Auth::guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        $level = CandidateLanguageInfo::level();
        if (count($candidate->language) >= 1) {
            $language = CandidateLanguageInfo::where('candidate_id', $id)->find($idLang);
            return view('candidates.languages.edit', compact('language', 'level'));
        } else {
            return redirect()->route('candidate.dashboard')->with('message', 'Edit your change if needed more languages');
        }
    }

    /**
     * @param $idLang
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateLang($idLang, Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $id = Auth::guard('candidate')->user()->id;
            $language = CandidateLanguageInfo::where('candidate_id', $id)->find($idLang);
            if (empty($language)) {
                return redirect()->route('candidate.dashboard')->with('error', 'You language can be found.');
            }
            $validator = Validator::make($data, CandidateLanguageInfo::$rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Please review your fields again');
            }

            $commit = $language->update($data);
            if (!$commit) {
                DB::rollbackTransaction();
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Unable to process your request right now');
            }

        } catch (ErrorException $errorException) {

        }
        DB::commit();
        return redirect()->route('candidate.lang.details')->with('message', 'Language updated successfully');
    }

    /**
     * @param $idLang
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteLang($idLang)
    {
        $id = Auth::guard('candidate')->user()->id;
        $language = CandidateLanguageInfo::where('candidate_id', $id)->find($idLang);
        if (empty($language)) {
            return redirect()->route('candidate.dashboard')->with('error', 'You language can be found.');
        }
        $language->delete($idLang);
        return redirect()->route('candidate.lang.details')->with('message', 'Language deleted successfully');
    }

    public function getExperiences()
    {
        $id = Auth::guard('candidate')->user()->id;
        $experiences = CandidateExpDetails::with('candidate')->where('candidate_id', $id)->get()->forPage('5', '5');
        $candidate = Candidate::find($id);
        if (count($candidate->experience) == 0) {
            return redirect()->route('candidate.experiences.details.create')->with('error', 'You can not view without insert data');
        }
        return view('candidates.experiences.index', compact('experiences'));
    }

    public function createExperiences()
    {
        $id = Auth::guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        if (count($candidate->experience) == 0) {
            $sectors = IndustryType::where('status', 1)->orderBy('name')->pluck('name', 'id');
            $departments = DepartmentType::where('status', 1)->orderBy('name')->pluck('name', 'id');
            $cities = City::where('status', 1)->orderBy('name')->pluck('name', 'id');
            $subjects = Subject::where('status', 1)->orderBy('name')->pluck('name', 'id');
            return view('candidates.experiences.create', compact('sectors', 'subjects', 'cities', 'departments'));
        } else {
            return redirect()->route('candidate.edit.exp_details')->with('status', 'Edit your change if needed dd');
        }
    }
}
