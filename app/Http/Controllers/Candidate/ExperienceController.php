<?php

namespace App\Http\Controllers\Candidate;

use App\Model\frontend\Candidate;
use App\Models\CandidateExpDetails;
use App\Models\City;
use App\Models\DepartmentType;
use App\Models\IndustryType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use Validator;
use Psy\Exception\ErrorException;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::guard('candidate')->user()->id;
        $experiences = CandidateExpDetails::where('candidate_id', $id)->get();
        $candidate = Candidate::find($id);
        if (count($candidate->experience) == 0) {
            return redirect()->route('candidate.experiences.create')->with('error', 'You can not view without insert data');
        }
        return view('candidates.experiences.index', compact('experiences'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Auth::guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        if (count($candidate->experience) == 0) {
            $sectors = IndustryType::where('status', 1)->orderBy('name')->pluck('name', 'id');
            $departments = DepartmentType::where('status', 1)->orderBy('name')->pluck('name', 'id');
            $cities = City::where('status', 1)->orderBy('name')->pluck('name', 'id');
            $career_level = CandidateExpDetails::career_level();
            $contract_type = CandidateExpDetails::contract_type();
            return view('candidates.experiences.create', compact('contract_type', 'sectors', 'career_level', 'cities', 'departments'));
        } else {
            return redirect()->route('candidate.experiences.index')->with('status', 'Edit your change if needed dd');
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
        if (count($candidate->experience) == 0) {
            DB::beginTransaction();
            foreach ($request->company_name as $key => $n) {

                $entry = [
                    'candidate_id' => $id,
                    'city_id' => $request->city_id[$key],
                    'career_level' => $request->career_level[$key],
                    'company_name' => $request->company_name[$key],
                    'salary' => $request->salary[$key],
                    'contract_type' => $request->contract_type[$key],
                    'industry_id' => $request->industry_id[$key],
                    'country' => $request->country[$key],
                    'department_id' => $request->department_id[$key],
                    'description' => $request->description[$key],
                    'end_date' => $request->end_date[$key],
                    'is_working' => $request->is_working[$key],
                    'job_title' => $request->job_title[$key],
                    'start_date' => $request->start_date[$key],
                ];
                CandidateExpDetails::create($entry);
            }

            DB::commit();
            return redirect()->route('candidate.dashboard')->with('message', 'Experience Details has been added.');
        } else {
            return redirect()->route('candidate.experiences.index')->with('message', 'Edit your change if needed ss');
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
        $experience = CandidateExpDetails::where('candidate_id', $c_id)->find($id);
        if (empty($experience)) {
            return redirect()->route('candidate.experiences.index')->with('error', 'Your experience is not found.');
        }
        if (count($candidate->experience) >= 1) {
            $sectors = IndustryType::where('status', 1)->orderBy('name')->pluck('name', 'id');
            $departments = DepartmentType::where('status', 1)->orderBy('name')->pluck('name', 'id');
            $cities = City::where('status', 1)->orderBy('name')->pluck('name', 'id');
            $career_level = CandidateExpDetails::career_level();
            $contract_type = CandidateExpDetails::contract_type();
            return view('candidates.experiences.edit', compact('departments', 'cities', 'sectors', 'career_level', 'contract_type', 'experience'));
        } else {
            return redirect()->route('candidate.experiences.create')->with('status', 'Edit your change if needed more experience');
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
        $experience = CandidateExpDetails::where('candidate_id', $c_id)->find($id);
        if (empty($experience)) {
            return redirect()->route('candidate.experiences.index')->with('error', 'Your experience is not found.');
        }
        if (count($candidate->experience) >= 1) {
            $sectors = IndustryType::where('status', 1)->orderBy('name')->pluck('name', 'id');
            $departments = DepartmentType::where('status', 1)->orderBy('name')->pluck('name', 'id');
            $cities = City::where('status', 1)->orderBy('name')->pluck('name', 'id');
            $career_level = CandidateExpDetails::career_level();
            $contract_type = CandidateExpDetails::contract_type();
            return view('candidates.experiences.edit', compact('departments', 'cities', 'sectors', 'career_level', 'contract_type', 'experience'));
        } else {
            return redirect()->route('candidate.experiences.create')->with('status', 'Edit your change if needed more experience');
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
            $validator = Validator::make($data = $request->all(), CandidateExpDetails::$rules);
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator)->with('error', 'Error in your fields');
            }
            $c_id = Auth::guard('candidate')->user()->id;
            $candidate = Candidate::find($id);
            $experience = CandidateExpDetails::with('candidate')->where('candidate_id', $c_id)->find($id);
            if (empty($experience)) {
                return redirect()->route('candidate.experiences.index')->with('error', 'Your experience is not found.');
            }
            if (count($candidate->experience) >= 1) {
                $experience = $experience->update($data);
                if (!$experience) {
                    DB::rollbackTransaction();
                    return redirect()->back()->withInput()->with('error', 'Unable to process your request right now');
                }
            } else {
                return redirect()->route('candidate.experiences.create')->with('status', 'Edit your change if needed more experience');
            }
        } catch (ErrorException $errorException) {

        }
        DB::commit();
        return redirect()->route('candidate.experiences.index')->with('message', 'Your experience updated successfully');
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
        $experience = CandidateExpDetails::where('candidate_id', $c_id)->find($id);
        if (empty($experience)) {
            return redirect()->route('candidate.experiences.index')->with('error', 'Your experience is not found.');
        }
        $experience->delete();
        return redirect()->route('candidate.experiences.index')->with('message', 'Your experience deleted successfully');
    }
}
