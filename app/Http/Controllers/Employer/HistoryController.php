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
        $history = PostedJob::with('revisions')->orderBy('id', 'DESC')->find($id);
        return view('employers.histories.jobs-activities', compact('history'));
    }
}
