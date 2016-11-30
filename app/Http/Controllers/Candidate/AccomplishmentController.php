<?php

namespace App\Http\Controllers\Candidate;

use App\Model\frontend\Candidate;
use App\Models\Accomplishment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psy\Exception\ErrorException;
use DB;
use Validator;

class AccomplishmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $c_id = auth()->guard('candidate')->user()->id;
        $candidate = Candidate::find($c_id);
        $accomplishments = Accomplishment::with('candidate')->orderBy('title')->where('candidate_id', $c_id)->get();
        if (count($candidate->accomplishments) >= 1) {
            return view('candidates.accomplishments.index', compact('accomplishments'));
        } else {
            return redirect()->route('candidate.accomplishments.create')->with('message', 'You can not edit without inserting data');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('candidates.accomplishments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = auth()->guard('candidate')->user()->id;
            $validator = Validator::make($data = $request->all(), Accomplishment::rules(), Accomplishment::messages());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Error');
            }
            foreach ($request->title as $key => $value) {
                $entries = [
                    'candidate_id' => $id,
                    'title' => $request->title[$key],
                    'date' => $request->date[$key],
                    'description' => $request->description[$key],
                ];

                $ps = Accomplishment::create($entries);
                if (!$ps) {
                    DB::rollbackTransaction();
                    return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Unable to process your request');
                }
            }
        } catch (ErrorException $errorException) {

        }
        DB::commit();
        return redirect()->route('candidate.accomplishments.index')->with('message', 'Your reference  added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = auth()->guard('candidate')->user()->id;
        $accomplishment = Accomplishment::with('candidate')->where('candidate_id', $id);
        return view('candidates.accomplishments.show', compact('reference'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $c_id = auth()->guard('candidate')->user()->id;
        $accomplishment = Accomplishment::with('candidate')->where('candidate_id', $c_id)->find($id);
        return view('candidates.accomplishments.edit', compact('reference'));
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
            $c_id = auth()->guard('candidate')->user()->id;
            $accomplishment = Accomplishment::with('candidate')->where('candidate_id', $c_id)->find($id);
            if (empty($accomplishment)) {
                return redirect()->route('candidate.accomplishments.index')->with('error', 'Accomplishment not found');
            }
            $validator = Validator::make($data = $request->all(), Accomplishment::rules(), Accomplishment::messages());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Error');
            }

            $accomplishment = $accomplishment->update($data);
            if (!$accomplishment) {
                DB::rollbackTransaction();
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Unable to process your request right now');
            }
        } catch (ErrorException $errorException) {

        }
        DB::commit();
        return redirect()->route('candidate.accomplishments.index')->with('message', 'Accomplishment added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $c_id = auth()->guard('candidate')->user()->id;
        $accomplishment = Accomplishment::with('candidate')->where('candidate_id', $c_id)->find($id);
        if (empty($accomplishment)) {
            return redirect()->route('candidate.accomplishments.index')->with('error', 'Accomplishment not found');
        }
        $accomplishment->delete();
        return redirect()->route('candidate.accomplishments.index')->with('message', 'Accomplishment deleted successfully');
    }
}
