<?php

namespace App\Http\Controllers;

use App\Model\backend\Employer;
use App\Model\frontend\Candidate;
use App\Models\Category;
use App\Models\City;
use App\Models\IndustryType;
use App\Models\PostedJob;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Flash;

class FrontController extends Controller
{
    /**
     * FrontController constructor.
     */
    public function __construct()
    {
        return $this->middleware('guest');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posted_jobs = PostedJob::with('industry', 'employer', 'exam', 'subject')->where('status', 1)->orderBy('created_at', 'DESC')->paginate(20);
        $top_jobs = PostedJob::with('industry', 'employer')->where('status', 1)->orderBy('salary_offered_min', 'DESC')->take(5)->get();
        $posted_job_count = PostedJob::count();
        $jobs_filled_up = PostedJob::where('status', 2)->get();
        $companies = Employer::where('status', 1)->count();
        $job_contracts = PostedJob::with('industry', 'employer', 'exam', 'subject')->where('status', 1)->where('job_type', 'Contract')->orderBy('created_at', 'DESC')->paginate(20);
        $category = Category::with('jobs')->where('status', 1)->limit(5)->get();
        $industry = IndustryType::with('jobs')->where('status', 1)->orderBy('name', 'ASC')->take(5)->get();
        $company = Employer::with('jobs')->where('status', 1)->limit(5)->get();
        $city = City::with('jobs')->where('status', 1)->take(5)->get();
        $city_list = City::with('jobs')->where('status', 1)->pluck('name', 'id');
        $applicant = Candidate::count();
        return view('webfront.index', compact('applicant', 'city_list', 'city', 'company', 'category', 'industry', 'posted_jobs', 'top_jobs', 'posted_job_count', 'jobs_filled_up', 'companies', 'job_contracts'));
    }

    /**
     * Display the specified City.
     *
     * @param $slug
     * @param $category
     * @param $industry
     * @param $id
     * @return Redirect
     * @internal param int $id
     */
    public function show($category, $industry, $id, $slug)
    {

        $job = PostedJob::where('slug', $slug)->firstOrFail();
        $category = Category::with('jobs')->where('status', 1)->limit(5)->get();
        $industry = IndustryType::with('jobs')->where('status', 1)->orderBy('name', 'ASC')->take(5)->get();
        $company = Employer::with('jobs')->where('status', 1)->limit(5)->get();
        $city = City::with('jobs')->where('status', 1)->take(5)->get();
        $emp_jobs = PostedJob::with('industry', 'employer', 'exam', 'subject')->where('status', 1)->orderBy('created_by', 'ASC')->paginate(20);
        $related_jobs = PostedJob::where('industry_id', $job->industry->id)->where('status', 1)->orderBy('created_at', 'DES')->get();

        if (empty($job)) {

            Flash::error('Job not found');

            return redirect(route('home'));
        }

        return view('webfront.jobs.view', compact('job', 'city', 'company', 'category', 'industry', 'emp_jobs', 'related_jobs'));

    }

    /**
     * @param $cat
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewByCategory($cat)
    {
        $cat = Category::find($cat)->with('jobs')->firstOrFail();
        return view('webfront.jobs.category', compact('cat'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function jobsSearch(Request $request)
    {

        $q = PostedJob::query();
        $job = PostedJob::with('industry')->with('employer')->get();
        if ($request->has('searchjob') || $request->has('searchplace')) {
//            $q->with('industry')->where('post_name', 'LIKE', "%{$request->input('searchjob')}%")
//                ->select('place_of_employment_city_id as name')->where('name', 'LIKE', "%{$request->input('searchplace')}%")->orderBy('id')->get();
            $q->search($request->get('searchjob'));
            $q->search($request->get('searchplace'));
        }

//        if ($request->has('searchplace')) {
//            $q->searchCity($request->get('searchplace'));
//        }

        $jobs = $q->orderBy('post_name', 'DESC')->paginate(20);

//        return $jobs;
        return view('webfront.jobs.search', compact('jobs', 'job'));
    }


    public function jobSearch(Request $request)
    {
        $query = PostedJob::where('place_of_employment_city_id', $request->input('searchplace'));

        if ($request->has('searchjob')) {
            $query->where('post_name', 'LIKE', '%' . $request->input('searchjob') . '%');
        }

        $query->whereHas('city', function ($q) use ($request) {
            return $q->where('id', $request->input('searchplace'))->with('city');
        });

        return $query->get();

    }

}
