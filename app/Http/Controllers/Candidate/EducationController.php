<?php

namespace App\Http\Controllers\Candidate;

use App\Model\frontend\Candidate;
use App\Models\EduDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Psy\Exception\ErrorException;
use Validator;
use DB;

class EducationController extends Controller
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
        $edu = EduDetails::where('candidate_id', $id)->get();
        if (count($candidate->educations) >= 1) {
            return view('candidates.educations.index', compact('edu'));
        } else {
            return redirect()->route('candidate.educations.create')->with('message', 'You can not edit without inserting data');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = auth()->guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        $degree_level = EduDetails::degree_level();
        if (count($candidate->educations) == 0) {
            return view('candidates.educations.create', compact('degree_level'));
        } else {
            return redirect()->route('candidate.educations.index')->with('message', 'Edit your change if needed');
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
        $id = auth()->guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        if (count($candidate->educations) == 0) {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), EduDetails::rules($request));
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->with('error', 'Please review your fields');
            }

            foreach ($request->city_id as $key => $n) {
                $entry = [
                    'candidate_id' => $id,
                    'city_id' => $request->city_id[$key],
                    'degree_level' => $request->degree_level[$key],
                    'description' => $request->description[$key],
                    'end_date' => $request->end_date[$key],
                    'grade' => $request->grade[$key],
                    'is_studying' => $request->is_studying[$key],
                    'field_of_study' => $request->field_of_study[$key],
                    'school_university_name' => $request->school_university_name[$key],
                    'start_date' => $request->start_date[$key],
                    'country_name' => $request->country_name[$key],
                ];

                EduDetails::create($entry);
            }

            DB::commit();

            return redirect()->route('candidate.dashboard')->with('message', 'Your education added successfully');

        } else {
            return redirect()->route('candidate.educations.index')->with('message', 'Edit your change if needed');
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
        $c_id = auth()->guard('candidate')->user()->id;
        $edu = EduDetails::where('candidate_id', $c_id)->find($id);
        return view('candidates.educations.show', compact('edu'));
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
        $candidate = Candidate::find($c_id);
        $degree_level = EduDetails::degree_level();
        $educations = EduDetails::where('candidate_id', $c_id)->find($id);
        if (count($candidate->educations) >= 1) {
            return view('candidates.educations.edit', compact('educations', 'degree_level'));
        } else {
            return redirect()->route('candidate.educations.create')->with('message', 'You can not edit without filling up your bio');
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

            $edu = EduDetails::with('candidate')->find($id);
            if (empty($edu)) {
                return redirect()->route('candidate.dashboard')->with('error', 'We can not find your education, Please consider to add one more! ');
            }
            $data = $request->all();
            $validator = Validator::make($data, EduDetails::$rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', ' Please check your fields again.');
            }
            $edu->update($data);
        } catch (ErrorException $errorException) {

        }
        DB::commit();
        return redirect()->route('candidate.educations.index')->with('message', 'Your education has been updated successfully');

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
        $edu = EduDetails::where('candidate_id', $c_id)->find($id);
        if (empty($edu)) {
            return redirect()->route('candidate.dashboard')->with('error', 'Your Edu can not be found.');
        }
        $edu->delete($id);
        return redirect()->route('candidate.educations.index')->with('message', 'Edu deleted successfully');
    }
}
