<?php

namespace App\Http\Controllers\Candidate;

use App\Model\frontend\Candidate;
use App\Models\CandidateLanguageInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use Psy\Exception\ErrorException;
use Validator;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        $lang = CandidateLanguageInfo::where('candidate_id', $id)->get();
        if (count($candidate->language) >= 1) {
            return view('candidates.languages.index', compact('lang'));
        } else {
            return redirect()->route('candidate.languages.create')->with('message', 'You can not edit without inserting data');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Auth::guard('candidate')->user()->id;
        $level = CandidateLanguageInfo::level();
        $candidate = Candidate::find($id);

        if (count($candidate->language) == 0) {
            return view('candidates.languages.create', compact('level'));
        } else {
            return redirect()->route('candidate.languages.index')->with('message', 'Edit your change if needed more languages');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Auth::guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        if (count($candidate->language) >= 0) {
            DB::beginTransaction();
            foreach ($request->name as $key => $n) {
                $entry = [
                    'candidate_id' => $id,
                    //'language_id'	    => $request->language_id[$key],
                    'name' => $n,
                    'read' => $request->read[$key],
                    'write' => $request->write[$key],
                    'speak' => $request->speak[$key],
                    'listen' => $request->listen[$key],
                ];

                CandidateLanguageInfo::create($entry);
            }
            DB::commit();
            return redirect()->route('candidate.dashboard')->with('message', 'Language details has been added');
        } else {
            return redirect()->back()->with('message', 'Language details already exists');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $c_id = Auth::guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        $level = CandidateLanguageInfo::level();
        if (count($candidate->language) >= 1) {
            $language = CandidateLanguageInfo::where('candidate_id', $c_id)->find($id);
            return view('candidates.languages.edit', compact('language', 'level'));
        } else {
            return redirect()->route('candidate.dashboard')->with('message', 'Edit your change if needed more languages');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $c_id = Auth::guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        $level = CandidateLanguageInfo::level();
        if (count($candidate->language) >= 1) {
            $language = CandidateLanguageInfo::where('candidate_id', $c_id)->find($id);
            return view('candidates.languages.edit', compact('language', 'level'));
        } else {
            return redirect()->route('candidate.dashboard')->with('message', 'Edit your change if needed more languages');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $c_id = Auth::guard('candidate')->user()->id;
            $language = CandidateLanguageInfo::where('candidate_id', $c_id)->find($id);
            if (empty($language)) {
                return redirect()->route('candidate.dashboard')->with('error', 'You language can be found.');
            }
            $validator = Validator::make($data, CandidateLanguageInfo::$rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Please review your fields again');
            }

            $commit = $language->update($data);
            if (!$commit) {
                DB::rollbackTransaction();
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Unable to process your request right now');
            }

        } catch (ErrorException $errorException) {

        }
        DB::commit();
        return redirect()->route('candidate.languages.index')->with('message', 'Language updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $c_id = Auth::guard('candidate')->user()->id;
        $language = CandidateLanguageInfo::where('candidate_id', $c_id)->find($id);
        if (empty($language)) {
            return redirect()->route('candidate.dashboard')->with('error', 'You language can be found.');
        }
        $language->delete($id);
        return redirect()->route('candidate.languages.index')->with('message', 'Language deleted successfully');
    }
}
