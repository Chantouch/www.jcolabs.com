<?php

namespace App\Http\Controllers\Candidate;

use App\Model\frontend\Candidate;
use App\Models\Board;
use App\Models\CandidateEduDetails;
use App\Models\CandidateInfo;
use App\Models\City;
use App\Models\District;
use App\Models\Exam;
use App\Models\ProofResidense;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Queue\RedisQueue;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;
use Validator;

class CandidateController extends Controller
{

    private $candidate_id;

    public function __construct()
    {
        // $this->candidate_id = Auth::guard('candidate')->user()->id;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {

        $candidate_id = Auth::guard('candidate')->user()->id;
        $progress = 0;
        $candidate = Candidate::find($candidate_id);

        if (count($candidate->bio) == 1)
            $progress = 25;
        if (count($candidate->education) >= 1)
            $progress = 50;
        if (count($candidate->language) >= 1)
            $progress = 75;
        if (count($candidate->experience) >= 1)
            $progress = 100;

        $i_card_status = Auth::guard('candidate')->user()->verified_status;

        return view('webfront.candidate.home', compact('progress', 'i_card_status'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function createResume()
    {
        $candidate_id = Auth::guard('candidate')->user()->id;
        $candidate = Candidate::find($candidate_id);
        $gender = CandidateInfo::$sex_options;
        $religion = CandidateInfo::$religion_options;
        $marital_status = CandidateInfo::$marital_status_options;
        $city = City::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $district = District::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $proof_residence = ProofResidense::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $relocate = CandidateInfo::$relocated_options;

        if (count($candidate->bio) == 0) {
            return view('webfront.candidate.create', compact('gender', 'religion', 'marital_status', 'city', 'district', 'proof_residence', 'relocate'));
        } else {
            return redirect()->route('candidate.edit.resume')->with('message', 'Review your your bio again');
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeResume(Request $request)
    {
        $validator = Validator::make($data = $request->all(), CandidateInfo::$rules, CandidateInfo::$messages);
        $id = Auth::guard('candidate')->user()->id;
        $auth = Auth::guard('candidate')->user();
        $data['candidate_id'] = $id;
        $candidate = Candidate::find($id);
        if (count($candidate->bio) == 0) {
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $path = 'uploads/candidates/' . date('Y') . '/' . $id;
            $destination_path = public_path($path);
            if (!file_exists($destination_path)) {
                mkdir($destination_path, 0777, true);
            }

            if ($request->hasFile('cv_url')) {
                if ($request->file('cv_url')->isValid()) {
                    $fileName = $auth->name . '_' . 'cv.' . $request->file('cv_url')->getClientOriginalExtension();
                    $request->file('cv_url')->move($destination_path, $fileName);
                    $data['cv_url'] = $path . '/' . $fileName;
                }
            }

            if ($request->hasFile('photo_url')) {
                if ($request->file('photo_url')->isValid()) {
                    $fileName = $auth->name . '_' . 'photo.' . $request->file('photo_url')->getClientOriginalExtension();
                    $request->file('photo_url')->move($destination_path, $fileName);
                    $data['photo_url'] = $path . '/' . $fileName;
                }
            }

            $info = CandidateInfo::create($data);
            return redirect()->route('candidate.dashboard')->with('message', 'Personal/Contact Info has been added');
        } else {
            return redirect()->route('candidate.edit.resume')->with('message', 'Edit your change if needed');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editResume()
    {

        $gender = CandidateInfo::$sex_options;
        $religion = CandidateInfo::$religion_options;
        $marital_status = CandidateInfo::$marital_status_options;
        $city = City::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $district = District::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $proof_residence = ProofResidense::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $relocate = CandidateInfo::$relocated_options;
        $candidate_id = Auth::guard('candidate')->user();
        $candidate = Candidate::find($candidate_id->id);
        $candidate_info = CandidateInfo::where('candidate_id', $candidate_id->id)->first();

        if (count($candidate->bio) == 1) {
            return view('webfront.candidate.edit', compact('candidate_info', 'gender', 'religion', 'marital_status', 'city', 'district', 'proof_residence', 'relocate'));
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateResume(Request $request)
    {
        $validator = Validator::make($data = $request->all(), CandidateInfo::$rules, CandidateInfo::$messages);
        $validator = CandidateInfo::getValidationRules($rules = 'update');
        $candidate_id = Auth::guard('candidate')->user();
        $candidate = Candidate::find($candidate_id->id);
        $check_if_valid = $this->validate($request, $validator);
        if (count($candidate->bio) == 1) {
            if ($check_if_valid) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $candidate_info = CandidateInfo::where('candidate_id', $candidate_id->id)->firstOrFail();
            $path = 'uploads/candidates/' . date('Y') . '/' . $candidate_id->id;
            $destination_path = public_path($path);
            if (!file_exists($destination_path)) {
                mkdir($destination_path, 0777, true);
            }

            if ($request->hasFile('cv_url')) {
                if ($request->file('cv_url')->isValid()) {
                    $fileName = $candidate_id->name . '_' . 'cv.' . $request->file('cv_url')->getClientOriginalExtension();
                    $request->file('cv_url')->move($destination_path, $fileName);
                    $data['cv_url'] = $path . '/' . $fileName;
                }
            }

            if ($request->hasFile('photo_url')) {
                if ($request->file('photo_url')->isValid()) {
                    $fileName = $candidate_id->name . '_' . 'photo.' . $request->file('photo_url')->getClientOriginalExtension();
                    $request->file('photo_url')->move($destination_path, $fileName);
                    $data['photo_url'] = $path . '/' . $fileName;
                }
            }

            $candidate_info->fill($data);

            if (!$candidate_info->save()) {
                return redirect()->back()->withInput()->with('message', 'Unable to update your bio');
            } else {
                return redirect()->route('candidate.dashboard')->with('message', 'You have successfully updated your bio');
            }
        } else {
            return redirect()->route('candidate.create.resume')->with('message', 'You can not edit without inserting data');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function createEduDetails()
    {
        $id = Auth::guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        $exams = Exam::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $boards = Board::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $subjects = Subject::where('status', 1)->orderBy('name')->pluck('name', 'id');
        if (count($candidate->education) == 0) {
            return view('webfront.candidate.edu.create', compact('exams', 'boards', 'subjects'));
        } else {
            return redirect()->route('candidate.edit.edu_details')->with('message', 'Edit your change if needed');
        }
    }

    public function storeEduDetails(Request $request)
    {
        $id = Auth::guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        if (count($candidate->education) == 0) {
            DB::beginTransaction();

            foreach ($request->exam_id as $key => $n) {
                $entry = [
                    'candidate_id' => $id,
                    'exam_id' => $request->exam_id[$key],
                    'board_id' => $request->board_id[$key],
                    'subject_id' => $request->subject_id[$key],
                    'specialization' => $request->specialization[$key],
                    'pass_year' => $request->pass_year[$key],
                    'percentage' => $request->percentage[$key],
                ];

                CandidateEduDetails::create($entry);
            }

            DB::commit();

            return redirect()->route('candidate.dashboard')->with('message', 'Your education added successfully');

        } else {
            return redirect()->route('candidate.edit.edu_details')->with('message', 'Edit your change if needed');
        }
    }


    public function editEduDetails()
    {
        $id = Auth::guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        $exams = Exam::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $boards = Board::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $subjects = Subject::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $edu = CandidateEduDetails::where('candidate_id', $id)->first();
        if (count($candidate->education) >= 1) {
            return view('webfront.candidate.edu.edit', compact('edu'));
        }
    }

    public function updateEduDetails(Request $request)
    {
        $data = $request->all();
        $id = Auth::guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        if (count($candidate->education) >= 1) {
            for ($i = 0; $i < count($data['eduIds']); $i++) {

                $k = $i + 1;
                $rules = [
                    //'candidate_id' => 'required' ,
                    'exam_id_' . $k => 'required',
                    'board_id_' . $k => 'required',
                    'subject_id_' . $k => 'sometimes',
                    'specialization_' . $k => 'required|max:50',
                    'pass_year_' . $k => 'required|numeric',
                    'percentage_' . $k => 'required|numeric'
                ];
                $this->validate($request, $rules);

                $candidate_edu_details = CandidateEduDetails::find($data['eduIds'][$i]);

                $candidate_edu_details->exam_id = $data['exam_id_' . $k];
                $candidate_edu_details->board_id = $data['board_id_' . $k];
                $candidate_edu_details->subject_id = $data['subject_id_' . $k];
                $candidate_edu_details->specialization = $data['specialization_' . $k];
                $candidate_edu_details->pass_year = $data['pass_year_' . $k];
                $candidate_edu_details->percentage = $data['percentage_' . $k];
                $candidate_edu_details->save();
            }
            return redirect()->route('candidate.dashboard')->with('message', 'Educational Information has been Updated!');
        } else {

            return redirect()->route('candidate.create.edu_details')->with('message', 'You can not edit without inserting data');
        }
    }
}
