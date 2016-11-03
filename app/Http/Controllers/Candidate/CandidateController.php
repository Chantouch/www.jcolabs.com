<?php

namespace App\Http\Controllers\Candidate;

use App\Model\frontend\Candidate;
use App\Models\CandidateInfo;
use App\Models\City;
use App\Models\District;
use App\Models\ProofResidense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;
use Validator;

class CandidateController extends Controller
{

    private $candidate_id;

    public function __construct()
    {
        // $this->candidate_id = Auth::guard('candidate')->user()->id;
    }

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
            dd(count($candidate->bio));
            return view('webfront.candidate.create', compact('gender', 'religion', 'marital_status', 'city', 'district', 'proof_residence', 'relocate'));
        } else {
            return redirect()->route('candidate.edit.resume')->with('message', 'Review your your bio again');
        }

    }

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

    public function updateResume(Request $request)
    {
        $validator = Validator::make($date = $request->all(), CandidateInfo::$rules, CandidateInfo::$messages);
        $validator = CandidateInfo::getValidationRules($rules = 'update');
        $candidate_id = Auth::guard('candidate')->user();
        $candidate = Candidate::find($candidate_id->id);
        $check_if_valid = $this->validate($request, $validator);
    }

}
