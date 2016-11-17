<?php

namespace App\Http\Controllers\backend;

use App\Model\Candidate;
use App\Model\backend\Employer;
use App\Model\backend\User;
use App\Models\CandidateInfo;
use App\Models\PostedJob;
use Hashids\Hashids;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Psy\Exception\ErrorException;
use Vinkla\Hashids\HashidsManager;

class AdminController extends Controller
{

    private $hashid;

    /**
     * Create a new controller instance.
     *
     * @param HashidsManager $hashidsManager
     */
    public function __construct(HashidsManager $hashidsManager)
    {
        return $this->hashid = $hashidsManager;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.dashboard');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function jobListAll()
    {
        $jobs = PostedJob::with('industry')->orderBy('id', 'DESC')->paginate(20);
        return view('backend.jobs.index', compact('jobs'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function employerListAll()
    {
        try {
            $employers = Employer::with('industry')->orderBy('id', 'DESC')->paginate(10);
            return view('backend.employers.index', compact('employers'));
        } catch (ErrorException $exception) {
            return redirect()->back();
        }

    }

    /**
     * @param $employer_id
     * @return int
     */
    public function viewEmployerProfile($employer_id)
    {
        $auth = Auth::guard('employer')->user();
        $id = $this->hashid->decode($employer_id);
        $employer = Employer::with('city', 'district')->find($id)->first();
        //return $employer->photo;
        $total_jobs = PostedJob::where('created_by', $id)
            ->count();
        $jobs_not_verified = PostedJob::with('industry')->where('created_by', $id)
            ->where('status', 0)
            ->get();
        $jobs_available = PostedJob::with('industry')->where('created_by', $id)
            ->where('status', 1)
            ->get(); //to gel all jobs that is marked as available/published

        $jobs_filled_up = PostedJob::with('industry')->where('created_by', $id)
            ->where('status', 2)
            ->get();
        return view('backend.employers.profile', compact('auth', 'city', 'district', 'employer', 'jobs_not_verified', 'jobs_available', 'jobs_filled_up', 'total_jobs'));

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewJob($id)
    {
        $decode = $this->hashid->decode($id);
        $id = $decode[0];
        $result = PostedJob::with('industry')->with('district', 'exam', 'subject', 'employer')->findOrFail($id);
        return view('backend.employer.view', compact('result'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function jobUpdateStatus($id, Request $request)
    {

        $decode = $this->hashid->decode($id);
        $id = $decode[0];
        $modal = PostedJob::findOrFail($id);
        $modal->status = $request->status;

        if ($modal->save()) {
            return redirect()->back()->with('message', 'Status has been successfully Updated');
        } else {
            return redirect()->back()->with('message', 'Unable to process your request');
        }

    }

    public function verifyEmployer($id)
    {
//        $decode = $this->hashid->decode($id);
//        $id = $decode[0];
        try {
            $employer = Employer::findOrFail($id);
            $employer->enrollment_no = str_replace('TMP_', '', $employer->temp_enrollment_no);
            $employer->temp_enrollment_no = null;
            $employer->verified_by = Auth::guard('admin')->user()->id;

            if ($employer->save()) {
                return redirect()->back()->with('message', 'The Employer ' . $employer->organization_name . ' has been Approved Successfully');
            } else {
                return redirect()->back()->with('message', 'Unable to process your request. Please try again');
            }

        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('message', 'The employer has not found!. 404');
        }
    }

    /**
     * @param $id
     * @return string
     */
    public function adminsAccounts()
    {
        //TODO list all admin view on admin panel except id 1 cause he is superadmin and all logic for mangaing admins needs to be coded
        return 'Hello Admin';
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function applicationsReceived()
    {

        $applications = CandidateInfo::join('candidates', 'candidate_info.candidate_id', '=', 'candidates.id')
            ->where('candidate_info.index_card_no', '!=', 'NULL')
            ->where('candidate_info.index_card_no', '!=', '')
            ->where('candidates.verified_status', 'Not Verified')
            ->select('candidates.id', 'candidate_info.full_name', 'candidate_info.index_card_no as index_card_no',
                'candidate_info.sex as sex', 'candidate_info.address as address')
            ->get();

        return view('backend.applications.received', compact('applications'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function applicationsVerified()
    {
        $verified = CandidateInfo::join('candidates', 'candidate_info.candidate_id', '=', 'candidates.id')
            ->where('candidates.verified_status', 'Verified')
            ->where('candidate_info.index_card_no', '!=', 'NULL')
            ->where('candidate_info.index_card_no', '!=', '')
            ->select('candidates.id', 'candidate_info.full_name', 'candidate_info.index_card_no as index_card_no',
                'candidate_info.sex as sex', 'candidate_info.address as address')
            ->get();

        return view('backend.applications.verified', compact('verified'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function applicationsSuspended()
    {
        $results = CandidateInfo::join('candidates', 'candidate_info.candidate_id', '=', 'candidates.id')
            ->where('candidates.verified_status', 'Halted')
            // ->where('candidate_info.index_card_no', '!=', 'NULL')
            // ->where('candidate_info.index_card_no', '!=', '')
            ->select('candidates.id', 'candidate_info.full_name', 'candidate_info.index_card_no as index_card_no',
                'candidate_info.sex as sex', 'candidate_info.address as address')
            ->get();

        return view('backend.applications.suspended', compact('results'));
    }

    /**
     * @param $candidate_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyCandidate($candidate_id)
    {
        //This will approve the candiate
        //Hashids::getDefaultConnection();
        $decoded = $this->hashid->decode($candidate_id);
        $id = $decoded[0];
        $candidate = Candidate::find($decoded)->first();
        $candidate->verified_status = 'Verified';
        $candidate->verified_by = Auth::guard('admin')->user()->id;

        if ($candidate->save()) {

            return redirect()->route('admin.applications_verified')->with('message', 'The Application has been Verified Successfully');

        } else {
            return redirect()->back()->with('message', 'Unable to process your request. Please try again or contact TechSupport.');
        }
    }

    /**
     * @param $candidate_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function suspendCandidate($candidate_id)
    {

        $decoded = $this->hashid->decode($candidate_id);
        $id = $decoded[0];
        $candidate = Candidate::find($id)->first();
        $candidate->verified_status = 'Halted';
        $candidate->verified_by = Auth::guard('admin')->user()->id;

        if ($candidate->save()) {

            return redirect()->route('admin.applications_suspended')->with('message', 'The Application has been Halted');

        } else {
            return redirect()->back()->with('message', 'Unable to process your request. Please try again or contact TechSupport.');
        }
    }


}
