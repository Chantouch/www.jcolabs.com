<?php

namespace App\Http\Controllers\Employer;

use App\Helpers\BaseHelper;
use App\Http\Requests\CreatePostJobRequest;
use App\Http\Requests\UpdatePostJobRequest;
use App\Model\backend\Employer;
use App\Models\Category;
use App\Models\City;
use App\Models\ContactPerson;
use App\Models\District;
use App\Models\Exam;
use App\Models\IndustryType;
use App\Models\Language;
use App\Models\PostedJob;
use App\Models\Qualification;
use App\Models\Subject;
use App\Repositories\PostJobRepository;
use App\Http\Controllers\AppBaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Mews\Purifier\Facades\Purifier;
use Prettus\Repository\Criteria\RequestCriteria;
use Prophecy\Exception\Prediction\FailedPredictionException;
use Psy\Exception\ErrorException;
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
        $id = Auth::guard('employer')->user()->id;
        $jobs = PostedJob::where('created_by', $id)->get();
        if (count($jobs) == 0) {
            return redirect()->route('employer.postJobs.create')->with('message', 'Please post your jobs to view it.');
        }
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
        $id = Auth::guard('employer')->user()->id;
        $emp = Auth::guard('employer')->user();
        $contact_person = ContactPerson::where('employer_id', $id)->orderBy('contact_name')->pluck('contact_name', 'id');

        try {

            if ($emp->industry_id == null) {
                return redirect()->back()->with('alert-warning', 'Please update your company profile first to start posting your job.');
            }

            $industries = IndustryType::where('status', 1)->orderBy('name')->pluck('name', 'id');
            $cities = City::where('status', 1)->orderBy('name')->pluck('name', 'id');
            $districts = District::where('status', 1)->orderBy('name')->pluck('name', 'id');
            $exams = Exam::where('status', 1)->orderBy('name')->pluck('name', 'id');
            $subjects = Subject::where('status', 1)->orderBy('name')->pluck('name', 'id');
            $genders = ['ANY' => 'ANY', 'MALE' => 'MALE', 'FEMALE' => 'FEMALE', 'OTHERS' => 'OTHERS',];
            $job_types = Employer::job_types();
            $job_levels = Employer::job_level();
            $qualifications = Qualification::where('status', 1)->orderBy('name')->pluck('name', 'id');
            $lang = Language::where('status', 1)->orderBy('name')->pluck('name', 'id');
            $job_categories = Category::where('status', 1)->orderBy('name')->pluck('name', 'id');
            $company = Auth::guard('employer')->user();
            $publish_date = Carbon::now();
            return view('employers.post_jobs.create', compact('publish_date', 'emp', 'qualifications', 'lang', 'job_levels', 'industries', 'company', 'cities', 'exams', 'subjects', 'districts', 'genders', 'job_types', 'physical_challenge', 'job_categories', 'contact_person'));

        } catch (ErrorException $exception) {
            return redirect('/employers/dashboard')->with('message', ' Please complete your profile company to post your post.');
        }
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

//        dd($request);

        if (Auth::guard('employer')->user()->verified_by == 0 || Auth::guard('employer')->user()->enrollment_no == '') {
            return redirect()->back()->withInput()->with('message', BaseHelper::getMessage('employer_not_active'));
        }

        $validator = Validator::make($data = $request->all(), PostedJob::$rules, PostedJob::$message);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Some files has errors. Please correct it and then try it again.');

        }

        $data['created_by'] = Auth::guard('employer')->user()->id;
        $data['description'] = Purifier::clean($request->description);
        $data['requirement_description'] = Purifier::clean($request->requirement_description);

        try {

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
            $published_date = date('Y-m-d', strtotime($request->published_date));
            $data['published_date'] = $published_date;
            $closing_date = date('Y-m-d', strtotime($request->closing_date));
            $data['closing_date'] = $closing_date;

            $job = PostedJob::create($data);

            if ($job) {
                $job->languages()->attach($request->languages_id);
            }

        } catch (ErrorException $exception) {

        }

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

        $emp = Auth::guard('employer')->user();
        $languages = Language::all();
        $lang = array();
        foreach ($languages as $language) {
            $lang[$language->id] = $language->name;
        }
        $qualifications = Qualification::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $job_levels = Employer::job_level();
        $postJob = $this->postJobRepository->findWithoutFail($id);
        $industries = IndustryType::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $cities = City::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $districts = District::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $exams = Exam::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $subjects = Subject::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $genders = ['ANY' => 'ANY', 'MALE' => 'MALE', 'FEMALE' => 'FEMALE', 'OTHERS' => 'OTHERS',];
        $job_types = Employer::job_types();
        $job_categories = Category::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $contact_person = ContactPerson::orderBy('contact_name')->pluck('contact_name', 'id');
        $publish_date = Carbon::now();

        if (empty($postJob)) {

            Flash::error('The job you are looking for maybe deleted or unavailable.');

            return redirect(route('employer.postJobs.index'));
        }
        return view('employers.post_jobs.edit', compact('publish_date','lang', 'emp', 'qualifications', 'job_levels', 'postJob', 'contact_person', 'industries', 'cities', 'exams', 'subjects', 'districts', 'genders', 'job_types', 'job_categories'));
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

        $data = $request->all();

        if (empty($postJob)) {
            Flash::error('The job you are looking for maybe deleted or unavailable.');

            return redirect(route('employer.postJobs.index'));
        }

        $data['description'] = Purifier::clean($request->description);
        $data['requirement_description'] = Purifier::clean($request->requirement_description);

        $postJob = $this->postJobRepository->update($data, $id);

        if ($postJob) {
            if (isset($request->languages_id)) {
                $postJob->languages()->sync($request->languages_id);
            } else {
                $postJob->languages()->sync(array());
            }
        }

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

        $postJob->languages()->detach();

        $this->postJobRepository->delete($id);

        Flash::success('Post Job deleted successfully.');

        return redirect(route('employer.postJobs.index'));
    }
}
