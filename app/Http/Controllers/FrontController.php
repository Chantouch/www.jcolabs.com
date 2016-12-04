<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplyJobRequest;
use App\Mail\ApplyJobMail;
use App\Model\backend\Employer;
use App\Model\frontend\Candidate;
use App\Models\ApplyJob;
use App\Models\Category;
use App\Models\City;
use App\Models\IndustryType;
use App\Models\PostedJob;
use App\Repositories\FrontRepositoryEloquent;
use Cviebrock\EloquentSluggable\Tests\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Mews\Purifier\Facades\Purifier;
use Mockery\CountValidator\Exception;
use Psy\Exception\ErrorException;
use Validator;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Flash;
use DB;

class FrontController extends Controller
{

    private $frontRepository;

    /**
     * FrontController constructor.
     * @param FrontRepositoryEloquent $eloquent
     */
    public function __construct(FrontRepositoryEloquent $eloquent)
    {
        $this->frontRepository = $eloquent;
        $this->middleware('guest');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $current_date = date('Y-m-d');
        $posted_jobs = PostedJob::with('industry', 'employer')->where('status', 1)->where('closing_date', '>=', $current_date)->orderBy('created_at', 'DESC')->paginate(20);
        $top_jobs = PostedJob::with('industry', 'employer')->where('status', 1)->where('closing_date', '>=', $current_date)->orderBy('salary_offered_min', 'DESC')->take(5)->get();
        $posted_job_count = PostedJob::count();
        $jobs_filled_up = PostedJob::where('status', 2)->get();
        $companies = Employer::where('status', 1)->orderBy('created_at', 'DESC')->get();
        $job_contracts = PostedJob::with('industry', 'employer')->where('status', 1)->where('job_type', 'Contract')->orderBy('created_at', 'DESC')->paginate(20);
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
     * @return \Exception|ErrorException
     * @internal param int $id
     */
    public function show($category, $industry, $id, $slug)
    {
        $current_date = date('Y-m-d');
        try {
            $job = PostedJob::with('industry', 'employer')->where('slug', $slug)->first();
            if ($job->closing_date < $current_date) {
                return redirect()->route('home')->with('error', 'The job you are looking for may expired, Please find other jobs!!');
            }
            $category = Category::with('jobs')->where('status', 1)->limit(5)->get();
            $industry = IndustryType::with('jobs')->where('status', 1)->orderBy('name', 'ASC')->take(5)->get();
            $company = Employer::with('jobs')->where('status', 1)->limit(5)->get();
            $city = City::with('jobs')->where('status', 1)->take(5)->get();
            $emp_jobs = PostedJob::with('industry', 'employer')->where('status', 1)->where('closing_date', '>=', $current_date)->orderBy('post_name', 'ASC')->paginate(20);
            $related_jobs = PostedJob::with('industry', 'employer')->where('status', 1)->where('closing_date', '>=', $current_date)->orderBy('created_at', 'DES')->get();
            if (empty($job)) {
                Flash::error('Job not found');
                return redirect(route('home'))->with('error', 'Job not found');
            }
        } catch (ErrorException $errorException) {
            return $errorException;
        }
        return view('webfront.jobs.view', compact('job', 'city', 'company', 'category', 'industry', 'emp_jobs', 'related_jobs'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchByFunction($slug)
    {
        $cat = Category::with('jobs')->where('slug', $slug)->firstOrFail();
        $current_date = date('Y-m-d');
        $categories = PostedJob::with('industry', 'employer')->where('category_id', '=', $cat->id)->where('status', 1)->where('closing_date', '>=', $current_date)->orderBy('created_at', 'DESC')->paginate(20);
        return view('webfront.jobs.searchby', compact('categories'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchByIndustry($slug)
    {
        $industry = IndustryType::with('jobs')->where('slug', $slug)->firstOrFail();
        $current_date = date('Y-m-d');
        $industries = PostedJob::with('industry', 'employer')->where('industry_id', '=', $industry->id)->where('status', 1)->where('closing_date', '>=', $current_date)->orderBy('created_at', 'DESC')->paginate(20);
        return view('webfront.jobs.searchby', compact('industries'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchByCompany($slug)
    {
        $company = Employer::with('jobs')->where('slug', $slug)->firstOrFail();
        $current_date = date('Y-m-d');
        $companies = PostedJob::with('industry', 'employer')->where('created_by', '=', $company->id)->where('status', 1)->where('closing_date', '>=', $current_date)->orderBy('created_at', 'DESC')->paginate(20);
        return view('webfront.jobs.searchby', compact('companies'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchByCity($slug)
    {
        $city = City::with('jobs')->where('slug', $slug)->firstOrFail();
        $current_date = date('Y-m-d');
        $cities = PostedJob::with('industry', 'employer')->where('place_of_employment_city_id', '=', $city->id)->where('status', 1)->where('closing_date', '>=', $current_date)->orderBy('created_at', 'DESC')->paginate(20);
        return view('webfront.jobs.searchby', compact('cities'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function allFunction()
    {
        $functions = Category::all();
        return view('webfront.search.all', compact('functions'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function allIndustry()
    {
        $industries = IndustryType::all();
        return view('webfront.search.all', compact('industries'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function allCompany()
    {
        $companies = Employer::all();
        return view('webfront.search.all', compact('companies'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function allCity()
    {
        $cities = City::all();
        return view('webfront.search.all', compact('cities'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function jobsSearch(Request $request)
    {

        $q = PostedJob::query();
        $category = Category::with('jobs')->where('status', 1)->limit(5)->get();
        $industry = IndustryType::with('jobs')->where('status', 1)->orderBy('name', 'ASC')->take(5)->get();
        $company = Employer::with('jobs')->where('status', 1)->limit(5)->get();
        $city = City::with('jobs')->where('status', 1)->take(5)->get();
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
        return view('webfront.jobs.search', compact('job', 'jobs', 'city', 'company', 'category', 'industry'));
    }


    public function jobSearch(Request $request)
    {
        $current_date = date('Y-m-d');
        $category = Category::with('jobs')->where('status', 1)->limit(5)->get();
        $industry = IndustryType::with('jobs')->where('status', 1)->orderBy('name', 'ASC')->take(5)->get();
        $company = Employer::with('jobs')->where('status', 1)->limit(5)->get();
        $city = City::with('jobs')->where('status', 1)->take(5)->get();
        $top_jobs = PostedJob::with('industry', 'employer')->where('status', 1)->where('closing_date', '>=', $current_date)->orderBy('salary_offered_min', 'DESC')->take(5)->get();
        $city_list = City::with('jobs')->where('status', 1)->pluck('name', 'id');
        $query = PostedJob::query();
        $cities = $request->input('city');
        $post_name = $request->input('name');
        $salary_min = $request->input('salary');
        $experiences = $request->input('experiences');
        if ($cities) {
            $query->where(function ($q) use ($cities) {
                $q->where('post_name', 'like', "$cities%")
                    ->orWhere('place_of_employment_city_id', 'like', "$cities%");
            });
        }

        if ($post_name) {
            $query->where(function ($q) use ($post_name) {
                $q->where('post_name', 'like', "$post_name%")
                    ->orWhere('place_of_employment_city_id', 'like', "$post_name%");
            });
        }

        if ($salary_min) {
            $query->where(function ($q) use ($salary_min) {
                $q->where('post_name', 'like', "$salary_min%")
                    ->orWhere('salary_offered_max', 'like', "$salary_min%");
            });
        }

        if ($experiences) {
            $query->where(function ($q) use ($experiences) {
                $q->where('post_name', 'like', "$experiences%")
                    ->orWhere('preferred_experience', 'like', "$experiences%");
            });
        }

        $jobs = $query->orderBy('post_name', 'DESC')->paginate(20);

        //dd($jobs);

        return view('webfront.jobs.search', compact('jobs', 'city_list', 'top_jobs', 'city', 'company', 'category', 'industry'));

        //        $query = DB::table('posted_jobs')
//            ->select('id', 'post_name', 'emp_job_id', 'status',
//                'job_type', 'level', 'other_benefits', 'created_by', 'salary_offered_max',
//                'salary_offered_min', 'no_of_post', 'industry_id', 'place_of_employment_city_id',
//                'place_of_employment_district_id', 'preferred_age_min', 'preferred_age_max',
//                'category_id', 'preferred_religion', 'subject_id', 'specialization', 'preferred_experience',
//                'physical_height', 'physical_weight', 'description', 'requirement_description',
//                'category_id', 'contact_person_id', 'published_date', 'closing_date', 'qualification_id',
//                'is_negotiable', 'field_of_study', 'preferred_sex');

    }


    //For candidate apply job directly from site
    /**
     * @param $id
     * @param ApplyJobRequest|Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @internal param $job_id
     */
    public function applyJob($id, Request $request)
    {

        $validator = Validator::make($data = $request->all(), ApplyJob::rule());
        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Please fix errors, and try once again');
        }

        DB::beginTransaction();
        $job = PostedJob::find($id);

        try {
            $path = 'uploads/applies/cv/' . date('Y/m/d/h-i');
            $destination_path = public_path($path);
            if ($request->hasFile('cv')) {
                if ($request->file('cv')) {
                    if (!file_exists($destination_path)) {
                        mkdir($destination_path, 0777, true);
                    }

                    $fileName = preg_replace('/\s+/', '', $request->name) . '_' . 'cv.' . $request->file('cv')->getClientOriginalExtension();
                    $request->file('cv')->move($destination_path, $fileName);
                    $data['cv'] = $path . '/' . $fileName;

                }
            }
            $job_id = $job->id;
            $data['job_id'] = $job_id;
            $data['message'] = Purifier::clean($request->message);
            $apply = ApplyJob::create($data);

            $email = new ApplyJobMail(new ApplyJob([

                'name' => $request->name,
                'phone' => $request->phone,
                'cv' => $request->cv,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'job' => $job,

            ]));
            Mail::to('chantouchsek.cs83@gmail.com')->send($email);

        } catch (Exception $exception) {

        }

        if (!$apply) {

            DB::rollbackTransaction();
            return redirect()->back()->withInput()->with('error', 'Error in you transaction');

        }

        DB::commit();
        return redirect()->back()->withInput()->with('message', "You are successfully applied to {$job->post_name}");

    }

}
