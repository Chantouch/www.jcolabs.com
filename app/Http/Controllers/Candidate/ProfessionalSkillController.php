<?php

namespace App\Http\Controllers\Candidate;

use App\Models\ProfessionalSkill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Psy\Exception\ErrorException;
use DB;
use Validator;


class ProfessionalSkillController extends Controller
{

    /**
     * ProfessionalSkillController constructor.
     */
    function __construct()
    {
        $this->middleware('candidate');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::guard('candidate')->user()->id;
        $professional = ProfessionalSkill::with('candidate')->where('candidate_id', $id)->paginate(10);
        return view('admin.candidates.professional.index', compact('professional'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('candidates.professional.create');
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
            $id = Auth::guard('candidate')->user()->id;
            $validator = Validator::make($data = $request->all(), ProfessionalSkill::rule(), ProfessionalSkill::message());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Error');
            }
            foreach ($request->name as $key => $value) {
                $entries = [
                    'candidate_id' => $id,
                    'name' => $request->name[$key],
                    'level' => $request->level[$key],
                    'year_experience' => $request->year_experience[$key],
                ];

                $ps = ProfessionalSkill::create($entries);
                if (!$ps) {
                    DB::rollbackTransaction();
                    return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Unable to process your request');
                }
            }
        } catch (ErrorException $errorException) {

        }
        DB::commit();
        return redirect()->route('candidate.professionals.index')->with('success', 'Your professional skills added successfully');
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
        $professional = ProfessionalSkill::with('candidate')->where('candidate_id', $id);
        return view('candidates.professional.show', compact('professional'));
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
        $professional = ProfessionalSkill::with('candidate')->where('candidate_id', $c_id)->find($id);
        return view('candidates.edit', compact('professional'));
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
            $c_id = Auth::guard('candidate')->user()->id;
            $professional = ProfessionalSkill::with('candidate')->where('candidate_id', $c_id)->find($id);
            if (empty($professional)) {
                return redirect()->route('candidate.professionals.index')->with('error', 'Professional skill not found');
            }
            $validator = Validator::make($data = $request->all(), ProfessionalSkill::rule(), ProfessionalSkill::message());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Error');
            }

            $professional = $professional->update($data);
            if (!$professional) {
                DB::rollbackTransaction();
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Unable to process your request right now');
            }
        } catch (ErrorException $errorException) {

        }
        DB::commit();
        return redirect()->route('candidate.professionals.index')->with('success', 'Professional skill added successfully');
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
        $professional = ProfessionalSkill::with('candidate')->where('candidate_id', $c_id)->find($id);
        if (empty($professional)) {
            return redirect()->route('candidate.professionals.index')->with('error', 'Professional skill not found');
        }
        $professional->delete();
        return redirect()->route('candidate.professionals.index')->with('success', 'Professional skill deleted successfully');
    }
}
