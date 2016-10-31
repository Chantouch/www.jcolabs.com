<?php

namespace App\Http\Controllers;

use App\Models\PostedJob;
use Illuminate\Http\Request;

use App\Http\Requests;
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
        $posted_jobs = PostedJob::with('industry', 'employer', 'exam', 'subject')->where('status', 1)->orderBy('created_by', 'ASC')->paginate(20);
        $top_jobs = PostedJob::with('industry', 'employer')->where('status', 1)->orderBy('salary_offered_min', 'DESC')->take(5)->get();
        //here I am taking 5 records with highest minimum salary  and only the available jobs
        // $filtered = $collection->filter(function ($item) {
        //     return $item > 2;
        // });
        return view('webfront.index', compact('posted_jobs', 'top_jobs'));
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

        if (empty($job)) {

            Flash::error('Job not found');

            return redirect(route('home'));
        }

        return view('webfront.jobs.view', compact('job'));

    }
}
