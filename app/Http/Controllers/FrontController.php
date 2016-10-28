<?php

namespace App\Http\Controllers;

use App\Models\PostedJob;
use Illuminate\Http\Request;

use App\Http\Requests;

class FrontController extends Controller
{
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
}
