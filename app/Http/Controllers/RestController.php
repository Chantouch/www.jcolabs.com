<?php
/**
 * Created by PhpStorm.
 * User: GDNT
 * Date: 26-Oct-16
 * Time: 11:38 AM
 */

namespace App\Http\Controllers;

use App\Helpers\BaseHelper;
use App\Model\frontend\Candidate;
use App\Models\CandidateEduDetails;
use App\Models\CandidateExpDetails;
use App\Models\CandidateInfo;
use App\Models\CandidateLanguageInfo;
use App\Models\City;
use App\Models\ContactPerson;
use App\Models\District;
use App\Models\PostedJob;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

class RestController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public static function getDistricts(Request $request)
    {
        $id = $request->city_id;
        return District::where('city_id', $id)->get();
    }

    /**
     * @param Request $request
     * @return mixed
     *
     */
    public static function getContactPersonDetails(Request $request)
    {
        $id = Auth::guard('employer')->user()->id;
        $contact_person = ContactPerson::where('employer_id', $id)->orderBy('contact_name')->pluck('contact_name', 'id');
        return $contact_person;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public static function searchJob(Request $request)
    {
        $data = PostedJob::select("post_name as name")->where("post_name", "LIKE", "%{$request->input('query')}%")->get();
        return response()->json($data);
    }


    public static function searchByCity(Request $request)
    {
        $data = City::select("id as id", "name as name")->where("name", "LIKE", "%{$request->input('city')}%")->get();
        return response()->json($data);
    }

    /**
     * @param $candidate_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewCandidateProfile($candidate_id)
    {
        //Hashids::getDefaultConnection();
        $decoded = Hashids::decode($candidate_id);
        //return count($decoded);
        //code for displaying full profle with bio, educations detals, experience details and so
        $candidate = Candidate::find($decoded)->first();
        //return $candidate;
        $info = CandidateInfo::where('candidate_id', $decoded)->first();
        //$edu = CandidateEduDetails::where('candidate_id', $decoded)->get();
        $edu = CandidateEduDetails::where('candidate_id', $decoded)
            ->join('exams', 'candidate_edu_details.exam_id', '=', 'exams.id')
            ->join('boards', 'candidate_edu_details.board_id', '=', 'boards.id')
            ->join('subjects', 'candidate_edu_details.subject_id', '=', 'subjects.id')
            ->select('exams.name as exam_name', 'exams.exam_category',
                'candidate_edu_details.specialization', 'candidate_edu_details.pass_year', 'candidate_edu_details.percentage',
                'boards.name as board_name', 'subjects.name as subject_name'
            )
            ->get();
        //::join('candidates', 'candidate_info.candidate_id', '=', 'candidates.id')
        $lang = CandidateLanguageInfo::where('candidate_id', $decoded)->get();

        $exp = CandidateExpDetails::where('candidate_id', $decoded)
            ->join('industry_types', 'candidate_experience_details.industry_id', '=', 'industry_types.id')
            ->join('subjects', 'candidate_experience_details.experience_id', '=', 'subjects.id')
            ->select('subjects.name as exp_type', 'industry_types.name as sector',
                'candidate_experience_details.post_held', 'candidate_experience_details.year_experience',
                'candidate_experience_details.salary', 'candidate_experience_details.employers_name')
            ->orderBy('candidate_experience_details.id', 'DESC')
            ->get();

        return view('backend.applications.profile', compact('candidate', 'info', 'edu', 'lang', 'exp'));
    }

    public function viewIdentityCard($candidate_id)
    {

        if (!BaseHelper::check_candidate($candidate_id)) {

            return redirect()->back()->with('message', 'The Profile has not enough information available to view Identity Card!');
        }

        $result = Candidate::join('candidate_info', 'candidates.id', '=', 'candidate_info.candidate_id')
            ->join('proof_details', 'candidate_info.proof_details_id', '=', 'proof_details.id')
            ->join('candidate_edu_details', 'candidates.id', '=', 'candidate_edu_details.candidate_id')
            ->join('exams', 'candidate_edu_details.exam_id', '=', 'exams.id')
            ->join('subjects', 'candidate_edu_details.subject_id', '=', 'subjects.id')
            ->select('candidates.id', 'candidate_info.full_name', 'candidate_info.index_card_no', 'candidate_info.created_at', 'candidate_info.dob', 'exams.name as exam_name', 'subjects.name as subject', 'proof_details.name as id_proof', 'candidate_info.proof_no', 'candidate_info.photo_url')
            ->where('candidates.id', $candidate_id)
            //->first();
            ->get();
        //return Hashids::encode($result->photo_url);
        return view('backend.applications.identity_card', compact('result'));
    }

}