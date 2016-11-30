<?php

namespace App\Http\Controllers\Candidate;

use App\Model\frontend\Candidate;
use App\Models\Reference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psy\Exception\ErrorException;
use DB;
use Validator;

class ReferenceController extends Controller
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
        $references = Reference::with('candidate')->orderBy('company_name')->where('candidate_id', $c_id)->get();
        if (count($candidate->references) >= 1) {
            return view('candidates.references.index', compact('references'));
        } else {
            return redirect()->route('candidate.references.create')->with('message', 'You can not edit without inserting data');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('candidates.references.create');
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
            $validator = Validator::make($data = $request->all(), Reference::rules(), Reference::messages());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Error');
            }
            foreach ($request->company_name as $key => $value) {
                $entries = [
                    'candidate_id' => $id,
                    'company_name' => $request->company_name[$key],
                    'email' => $request->email[$key],
                    'first_name' => $request->first_name[$key],
                    'last_name' => $request->last_name[$key],
                    'phone_number' => $request->phone_number[$key],
                    'position' => $request->position[$key],
                ];

                $ps = Reference::create($entries);
                if (!$ps) {
                    DB::rollbackTransaction();
                    return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Unable to process your request');
                }
            }
        } catch (ErrorException $errorException) {

        }
        DB::commit();
        return redirect()->route('candidate.references.index')->with('message', 'Your reference  added successfully');
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
        $reference = Reference::with('candidate')->where('candidate_id', $id);
        return view('candidates.references.show', compact('reference'));
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
        $reference = Reference::with('candidate')->where('candidate_id', $c_id)->find($id);
        return view('candidates.references.edit', compact('reference'));
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
            $reference = Reference::with('candidate')->where('candidate_id', $c_id)->find($id);
            if (empty($reference)) {
                return redirect()->route('candidate.references.index')->with('error', 'Reference not found');
            }
            $validator = Validator::make($data = $request->all(), Reference::rules(), Reference::messages());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Error');
            }

            $reference = $reference->update($data);
            if (!$reference) {
                DB::rollbackTransaction();
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Unable to process your request right now');
            }
        } catch (ErrorException $errorException) {

        }
        DB::commit();
        return redirect()->route('candidate.references.index')->with('message', 'Reference added successfully');
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
        $reference = Reference::with('candidate')->where('candidate_id', $c_id)->find($id);
        if (empty($reference)) {
            return redirect()->route('candidate.references.index')->with('error', 'Reference not found');
        }
        $reference->delete();
        return redirect()->route('candidate.references.index')->with('message', 'Reference deleted successfully');
    }
}
