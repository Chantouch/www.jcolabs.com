<?php

namespace App\Http\Controllers\Employer;

use App\Models\PostedJob;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistoryController extends Controller
{
    public function getJobDeleted()
    {
        $histories = PostedJob::with('category', 'industry')->onlyTrashed()->get();
        return view('employers.histories.jobs', compact('histories'));
    }

    public function showJobsActivities($id)
    {
        $histories = PostedJob::with('revisionHistory')->find($id);
        return view('employers.histories.jobs-activities', compact('histories'));
    }

    public function createJobActivities()
    {
        $jobs = PostedJob::with('revisionHistory')->get();
        return view('employers.histories.job-create', compact('jobs'));
    }
}
