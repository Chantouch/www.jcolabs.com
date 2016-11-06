<?php

namespace App\Http\Controllers\Candidate;

use App\Helpers\BaseHelper;
use App\Model\frontend\Candidate;
use App\Models\Board;
use App\Models\CandidateEduDetails;
use App\Models\CandidateExpDetails;
use App\Models\CandidateInfo;
use App\Models\CandidateLanguageInfo;
use App\Models\City;
use App\Models\District;
use App\Models\Exam;
use App\Models\IndustryType;
use App\Models\Language;
use App\Models\ProofResidense;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Queue\RedisQueue;
use Illuminate\Support\Facades\Auth;
use Session;
use Response;
use DB;
use Validator;

class CandidateController extends Controller
{

    private $candidate_id;
    private $route = 'candidate.';

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
        $id = Auth::guard('candidate')->user()->id;
        $auth = Auth::guard('candidate')->user();
        $data['candidate_id'] = $id;
        $candidate = Candidate::find($id);

        $check_if_valid = $this->validate($request, $validator);

        $name = preg_replace('/\s+/', '', $auth->name);

        if (count($candidate->bio) == 1) {
            if ($check_if_valid) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $candidate_info = CandidateInfo::where('candidate_id', $id)->firstOrFail();
            $path = 'uploads/candidates/' . date('Y') . '/' . $id;
            $destination_path = public_path($path);
            if (!file_exists($destination_path)) {
                mkdir($destination_path, 0777, true);
            }

            if ($request->hasFile('cv_url')) {
                if ($request->file('cv_url')->isValid()) {
                    $fileName = $name . '_' . 'cv.' . $request->file('cv_url')->getClientOriginalExtension();
                    $request->file('cv_url')->move($destination_path, $fileName);
                    $data['cv_url'] = $path . '/' . $fileName;
                }
            }

            if ($request->hasFile('photo_url')) {
                if ($request->file('photo_url')->isValid()) {
                    $fileName = $name . '_' . 'photo.' . $request->file('photo_url')->getClientOriginalExtension();
                    $request->file('photo_url')->move($destination_path, $fileName);
                    $data['photo_url'] = $path . '/' . $fileName;
                }
            }

            $candidate_info->fill($data);

            if (!$candidate_info->save()) {
                return redirect()->back()->withInput()->with('message', 'Unable to update your bio');
            } else {
                return redirect()->route('candidate.dashboard')->with('message', 'Personal/Contact Info has been added');
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function editEduDetails()
    {
        $id = Auth::guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        $exams = Exam::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $boards = Board::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $subjects = Subject::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $res = CandidateEduDetails::where('candidate_id', $id)->get();
        if (count($candidate->education) >= 1) {
            return view('webfront.candidate.edu.edit', compact('res', 'exams', 'boards', 'subjects'));
        } else {
            return redirect()->route('candidate.create.edu_details')->with('message', 'You can not edit without filling up your bio');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function createExperienceDetails()
    {
        $id = Auth::guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        if (count($candidate->experience) == 0) {
            $sectors = IndustryType::where('status', 1)->orderBy('name')->pluck('name', 'id');
            $subjects = Subject::where('status', 1)->orderBy('name')->pluck('name', 'id');
            return view('webfront.candidate.experience.create', compact('sectors', 'subjects'));
        } else {
            return redirect()->route('candidate.edit.exp_details')->with('status', 'Edit your change if needed dd');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeExperienceDetails(Request $request)
    {
        $id = Auth::guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        if (count($candidate->experience) == 0) {

            DB::beginTransaction();

            foreach ($request->employers_name as $key => $n) {

                $entry = [
                    'candidate_id' => $id,
                    'employers_name' => $request->employers_name[$key],
                    'post_held' => $request->post_held[$key],
                    'year_experience' => $request->year_experience[$key],
                    'salary' => $request->salary[$key],
                    'experience_id' => $request->experience_id[$key],
                    'industry_id' => $request->industry_id[$key],
                ];

                CandidateExpDetails::create($entry);
            }

            DB::commit();

            return redirect()->route('candidate.dashboard')->with('message', 'Experience Details has been added.');

        } else {
            return redirect()->route('candidate.edit.exp_details')->with('message', 'Edit your change if needed ss');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function editExperienceDetails(Request $request)
    {
        $id = Auth::guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        if (count($candidate->experience) >= 1) {
            $res = CandidateExpDetails::where('candidate_id', $id)->get();
            $sectors = IndustryType::where('status', 1)->orderBy('name')->pluck('name', 'id');
            $subjects = Subject::where('status', 1)->orderBy('name')->pluck('name', 'id');
            $url = $this->route . 'update.exp_details';
            return view('webfront.candidate.experience.exp_details_edit', compact('sectors', 'subjects', 'res', 'url'));
        } else {
            return redirect()->route('candidate.create.language_details')->with('status', 'Edit your change if needed more experience');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateExperienceDetails(Request $request)
    {
        $data = $request->all();
        $id = Auth::guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        if (count($candidate->experience) >= 1) {
            for ($i = 0; $i < count($data['expIds']); $i++) {
                $k = $i + 1;
                $rules = [
                    'employers_name_' . $k => 'required|max:50',
                    'post_held_' . $k => 'required|max:50',
                    'year_experience_' . $k => 'numeric|max:99',
                    'salary_' . $k => 'required|numeric',
                    'experience_id_' . $k => 'required',
                    'industry_id_' . $k => 'required',
                ];

                $this->validate($request, $rules);

                $candidate_exp_details = CandidateExpDetails::find($data['expIds'][$i]);

                $candidate_exp_details->employers_name = $data['employers_name_' . $k];
                $candidate_exp_details->post_held = $data['post_held_' . $k];
                $candidate_exp_details->year_experience = $data['year_experience_' . $k];
                $candidate_exp_details->salary = $data['salary_' . $k];
                $candidate_exp_details->experience_id = $data['experience_id_' . $k];
                $candidate_exp_details->industry_id = $data['industry_id_' . $k];

                $candidate_exp_details->save();
            }

            return redirect()->route('candidate.dashboard')->with('message', 'Experience Information has been Updated');
        } else {
            return redirect()->route('candidate.create.exp_details')->with('message', 'You can not edit without inserting data');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function createLanguageDetails()
    {
        $id = Auth::guard('candidate')->user()->id;
        $candidate = Candidate::find($id);

        if (count($candidate->language) == 0) {
            $languages = Language::where('status', 1)->orderBy('name')->pluck('name', 'id');
            $url = $this->route . 'store.language_details';

            return view('webfront.candidate.languages.language_details', compact('languages', 'url'));
        } else {
            return redirect()->route($this->route . 'edit.language_details')->with('message', 'Edit your change if needed more languages');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeLanguageDetails(Request $request)
    {
        $id = Auth::guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        if (count($candidate->language) >= 0) {
            DB::beginTransaction();
            foreach ($request->language_id as $key => $n) {
                $entry = [
                    'candidate_id' => $id,
                    //'language_id'	    => $request->language_id[$key],
                    'language_id' => $n,
                    'can_read' => $request->can_read[$key],
                    'can_write' => $request->can_write[$key],
                    'can_speak' => $request->can_speak[$key],
                    'can_speak_fluently' => $request->can_speak_fluently[$key],
                ];

                CandidateLanguageInfo::create($entry);
            }
            DB::commit();
            return redirect()->route($this->route . 'dashboard')->with('message', 'Language details has been added');
        } else {
            return redirect()->back()->with('message', 'Language details already exists');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function editLanguageDetails()
    {
        $id = Auth::guard('candidate')->user()->id;
        $candidate = Candidate::find($id);

        if (count($candidate->language) >= 1) {
            $res = CandidateLanguageInfo::where('candidate_id', $id)->get();
            $languages = Language::where('status', 1)->orderBy('name')->pluck('name', 'id');
            $url = $this->route . 'update.language_details';
            return view('webfront.candidate.languages.language_details_edit', compact('languages', 'url', 'res'));
        } else {
            return redirect()->route($this->route . 'dashboard')->with('message', 'Edit your change if needed more languages');
        }
    }

    public function updateLanguageDetails(Request $request)
    {
        $data = $request->all();
        $id = Auth::guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        if (count($candidate->language) >= 1) {
            for ($i = 0; $i < count($data['langIds']); $i++) {
                $k = $i + 1;
                $rules = [
                    'can_read_' . $k => 'required|in:YES,NO',
                    'can_write_' . $k => 'required|in:YES,NO',
                    'can_speak_' . $k => 'required|in:YES,NO',
                    'can_speak_fluently_' . $k => 'required|in:YES,NO',
                ];

                $this->validate($request, $rules);
                $candidate_lang_details = CandidateLanguageInfo::find($data['langIds'][$i]);
                $candidate_lang_details->can_read = $data['can_read_' . $k];
                $candidate_lang_details->can_write = $data['can_write_' . $k];
                $candidate_lang_details->can_speak = $data['can_speak_' . $k];
                $candidate_lang_details->can_speak_fluently = $data['can_speak_fluently_' . $k];
                $candidate_lang_details->save();
            }
            return redirect()->route($this->route . 'dashboard')->with('message', 'Language information has been updated');
        } else {
            return redirect()->route($this->route . 'create.language_details')->with('message', 'You can not edit without inserting data');
        }
    }

    public function getIdentityCard()
    {
        $id = Auth::guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        $info = CandidateInfo::where('candidate_id', $id)->count();
        $edu = CandidateEduDetails::where('candidate_id', $id)->count();
        $lang = CandidateLanguageInfo::where('candidate_id', $id)->count();

        if ($info == 0 || $edu == 0 | $lang == 0) {
            return redirect()->back()->with('message', 'You profile has not enough information available to Generate Identity Card!<br>Please Update your profile information');
        }
        $id_card = BaseHelper::generateIdCard($id);
        $result = Candidate::join('candidate_info', 'candidates.id', '=', 'candidate_info.candidate_id')
            ->join('proof_residenses', 'candidate_info.proof_details_id', '=', 'proof_residenses.id')
            ->join('candidate_edu_details', 'candidates.id', '=', 'candidate_edu_details.candidate_id')
            ->join('exams', 'candidate_edu_details.exam_id', '=', 'exams.id')
            ->join('subjects', 'candidate_edu_details.subject_id', '=', 'subjects.id')
            ->select('candidate_info.id', 'candidate_info.full_name', 'candidate_info.created_at', 'candidate_info.dob', 'exams.name as exam_name', 'subjects.name as subject', 'proof_residenses.name as id_proof', 'candidate_info.proof_no', 'candidate_info.photo_url')
            ->where('candidates.id', $id)
            ->first();

        return view('webfront.candidate.id_card.card', compact('id_card', 'result', 'photo'));
    }

    public function file_preview($file, $year, $id, $file_name)
    {
        //files/{file}/{year}/{id}/{file_name}/preview
        $url = $file . '/' . $year . '/' . $id . '/' . $file_name;
        $path = public_path($url);
        $handler = new \Symfony\Component\HttpFoundation\File\File($path);
        $lifetime = 31556926;
        /**
         * Prepare some header variables
         */
        $file_time = $handler->getMTime(); // Get the last modified time for the file (Unix timestamp)
        $header_content_type = $handler->getMimeType();
        $header_content_length = $handler->getSize();
        $header_etag = md5($file_time . $path);
        $header_last_modified = gmdate('r', $file_time);
        $header_expires = gmdate('r', $file_time + $lifetime);

        $headers = array(
            'Content-Disposition' => 'inline; filename="' . $url . '"',
            'Last-Modified' => $header_last_modified,
            'Cache-Control' => 'must-revalidate',
            'Expires' => $header_expires,
            'Pragma' => 'public',
            'Etag' => $header_etag
        );
        /** Is the resource cached? */
        $h1 = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $header_last_modified;
        $h2 = isset($_SERVER['HTTP_IF_NONE_MATCH']) && str_replace('"', '', stripslashes($_SERVER['HTTP_IF_NONE_MATCH'])) == $header_etag;

        if ($h1 || $h2) {
            return Response::make('', 304, $headers);
            // File (image) is cached by the browser, so we don't have to send it again
        }

        $headers = array_merge($headers, array(
            'Content-Type' => $header_content_type,
            'Content-Length' => $header_content_length
        ));

        return Response::make(file_get_contents($path), 200, $headers);
    }

    public function image_preview($info)
    {

        //TODO have to code for checking whether the candidate acessing the url is meant for him or others if not his/her then restrict 404
        $info = CandidateInfo::find($info);
        $path = public_path($info->photo_url);
        $handler = new \Symfony\Component\HttpFoundation\File\File($path);
        $lifetime = 31556926;
        /**
         * Prepare some header variables
         */
        $file_time = $handler->getMTime(); // Get the last modified time for the file (Unix timestamp)
        $header_content_type = $handler->getMimeType();
        $header_content_length = $handler->getSize();
        $header_etag = md5($file_time . $path);
        $header_last_modified = gmdate('r', $file_time);
        $header_expires = gmdate('r', $file_time + $lifetime);

        $headers = array(
            'Content-Disposition' => 'inline; filename="' . $info->photo_url . '"',
            'Last-Modified' => $header_last_modified,
            'Cache-Control' => 'must-revalidate',
            'Expires' => $header_expires,
            'Pragma' => 'public',
            'Etag' => $header_etag
        );
        /** Is the resource cached? */
        $h1 = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $header_last_modified;
        $h2 = isset($_SERVER['HTTP_IF_NONE_MATCH']) && str_replace('"', '', stripslashes($_SERVER['HTTP_IF_NONE_MATCH'])) == $header_etag;

        if ($h1 || $h2) {
            return Response::make('', 304, $headers);
            // File (image) is cached by the browser, so we don't have to send it again
        }

        $headers = array_merge($headers, array(
            'Content-Type' => $header_content_type,
            'Content-Length' => $header_content_length
        ));

        return Response::make(file_get_contents($path), 200, $headers);
    }
}
