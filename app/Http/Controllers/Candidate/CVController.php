<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CVController extends Controller
{
    public function personalInfo()
    {
        $c_id = auth()->guard('candidate')->user();
        return view('candidates.personal_info', compact('c_id'));
    }
}
