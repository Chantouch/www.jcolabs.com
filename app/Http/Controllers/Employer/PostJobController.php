<?php

namespace App\Http\Controllers\Employer;

use App\Helpers\BaseHelper;
use App\Http\Requests\CreatePostJobRequest;
use App\Http\Requests\UpdatePostJobRequest;
use App\Models\City;
use App\Models\ContactPerson;
use App\Models\District;
use App\Models\Exam;
use App\Models\IndustryType;
use App\Models\PostedJob;
use App\Models\Subject;
use App\Repositories\PostJobRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Validator;
use DB;

class PostJobController extends AppBaseController
{
    /** @var  PostJobRepository */
    private $postJobRepository;

    public function __construct(PostJobRepository $postJobRepo)
    {
        $this->postJobRepository = $postJobRepo;
        $this->middleware('employer');
    }

    /**
     * Display a listing of the PostJob.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->postJobRepository->pushCriteria(new RequestCriteria($request));
        $postJobs = PostedJob::with('industry')->with('city', 'subject', 'district', 'exam')->paginate(20);

        return view('employers.post_jobs.index')
            ->with('postJobs', $postJobs);
    }

    /**
     * Show the form for creating a new PostJob.
     *
     * @return Response
     */
    public function create()
    {
        $industries = IndustryType::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $cities = City::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $districts = District::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $exams = Exam::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $subjects = Subject::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $genders = ['ANY' => 'ANY', 'MALE' => 'MALE', 'FEMALE' => 'FEMALE', 'OTHERS' => 'OTHERS',];
        $job_types = ['Full Time' => 'Full Time', 'Part Time' => 'Part Time'];
        $physical_challenge = ['YES' => 'YES', 'NO' => 'NO'];
        $ex_service = ['YES' => 'YES', 'NO' => 'NO'];
        $job_sub_categories = ['Govt. Regular' => 'Govt. Regular', 'Govt. Contractual' => 'Govt. Contractual', 'Pvt. Regular' => 'Pvt. Regular', 'Pvt. Contractual' => 'Pvt. Contractual', 'Not Specified' => 'Not Specified'];
        $contact_person = ContactPerson::orderBy('contact_name')->pluck('contact_name', 'id');
        $company = Auth::guard('employer')->user();
        return view('employers.post_jobs.create', compact('industries', 'company', 'ex_service', 'cities', 'exams', 'subjects', 'districts', 'genders', 'job_types', 'physical_challenge', 'job_sub_categories', 'contact_person'));
    }

    /**
     * Store a newly created PostJob in storage.
     *
     * @param CreatePostJobRequest $request
     *
     * @return Response
     */
    public function store(CreatePostJobRequest $request)
    {

        if (Auth::guard('employer')->user()->verified_by == 0 || Auth::guard('employer')->user()->enrollment_no == '') {
            return redirect()->back()->withInput()->with('message', BaseHelper::getMessage('employer_not_active'));
        }

        $validator = Validator::make($data = $request->all(), PostedJob::$rules, PostedJob::$message);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Some files has errors. Please correct it and then try it again.');
        }

        $data['created_by'] = Auth::guard('employer')->user()->id;
        DB::beginTransaction();

        //Generate job id
        $records = PostedJob::withTrashed()->count();
        $current_id = 1;
        if (!$records == 0) {
            $current_id = PostedJob::withTrashed()->orderBy('id', 'DESC')->first()->id + 1;
        }
        $job_id = 'EMP_JOB' . str_pad($current_id, 6, '0', STR_PAD_LEFT);
        $data['emp_job_id'] = $job_id;
        $data['status'] = 1;
        $job = PostedJob::create($data);

        if (!$job) {
            DB::rollbackTransaction();
            return redirect()->back()->withInput()->with('message', 'Unable to process your requires');
        }
        DB::commit();
        return redirect()->route('employer.postJobs.index')->with('message', 'New job has been Posted');

    }

    /**
     * Display the specified PostJob.
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {
        $postJob = PostedJob::where('slug', $slug)->with('industry')->with('city', 'subject', 'district', 'exam')->firstOrFail();

        if (empty($postJob)) {
            Flash::error('Post Job not found');

            return redirect(route('employer.postJobs.index'));
        }

        return view('employers.post_jobs.show')->with('postJob', $postJob);
    }

    /**
     * Show the form for editing the specified PostJob.
     *
     * @param  int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $postJob = $this->postJobRepository->findWithoutFail($id);
        $industries = IndustryType::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $cities = City::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $districts = District::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $exams = Exam::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $subjects = Subject::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $genders = ['ANY' => 'ANY', 'MALE' => 'MALE', 'FEMALE' => 'FEMALE', 'OTHERS' => 'OTHERS',];
        $job_types = ['Full Time' => 'Full Time', 'Part Time' => 'Part Time'];
        $physical_challenge = ['YES' => 'YES', 'NO' => 'NO'];
        $ex_service = ['YES' => 'YES', 'NO' => 'NO'];
        $contact_person = ContactPerson::orderBy('contact_name')->pluck('contact_name', 'id');
        $job_sub_categories = ['Govt. Regular' => 'Govt. Regular', 'Govt. Contractual' => 'Govt. Contractual', 'Pvt. Regular' => 'Pvt. Regular', 'Pvt. Contractual' => 'Pvt. Contractual', 'Not Specified' => 'Not Specified'];

        if (empty($postJob)) {

            Flash::error('The job you are looking for maybe deleted or unavailable.');

            return redirect(route('employer.postJobs.index'));
        }
        return view('employers.post_jobs.edit', compact('postJob', 'contact_person', 'ex_service', 'industries', 'cities', 'exams', 'subjects', 'districts', 'genders', 'job_types', 'physical_challenge', 'job_sub_categories'));
    }

    /**
     * Update the specified PostJob in storage.
     *
     * @param  int $id
     * @param UpdatePostJobRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostJobRequest $request)
    {
        $postJob = $this->postJobRepository->findWithoutFail($id);

        if (empty($postJob)) {
            Flash::error('The job you are looking for maybe deleted or unavailable.');

            return redirect(route('employer.postJobs.index'));
        }

        $postJob = $this->postJobRepository->update($request->all(), $id);

        Flash::success('Post Job updated successfully.');

        return redirect(route('employer.postJobs.index'));
    }

    /**
     * Remove the specified PostJob from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $postJob = $this->postJobRepository->findWithoutFail($id);

        if (empty($postJob)) {
            Flash::error('Post Job not found');

            return redirect(route('employer.postJobs.index'));
        }

        $this->postJobRepository->delete($id);

        Flash::success('Post Job deleted successfully.');

        return redirect(route('employer.postJobs.index'));
    }
}
