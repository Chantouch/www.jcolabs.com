<?php

namespace App\Http\Controllers\Candidate;

use App\Model\frontend\Candidate;
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
        $id = auth()->guard('candidate')->user()->id;
        $candidate = Candidate::find($id);
        $professionals = ProfessionalSkill::with('candidate')->where('candidate_id', $id)->paginate(10);
        if (count($candidate->professionals) >= 1) {
            return view('candidates.professionals.index', compact('professionals'));
        } else {
            return redirect()->route('candidate.professionals.create')->with('message', 'You can not view without inserting data');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $level = ProfessionalSkill::level();
        $experience = ProfessionalSkill::experience();
        return view('candidates.professionals.create', compact('level', 'experience'));
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
        return redirect()->route('candidate.professionals.index')->with('message', 'Your professional skills added successfully');
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
        return view('candidates.professionals.show', compact('professional'));
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
        $level = ProfessionalSkill::level();
        $experience = ProfessionalSkill::experience();
        return view('candidates.professionals.edit', compact('professional', 'level', 'experience'));
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
        return redirect()->route('candidate.professionals.index')->with('message', 'Professional skill added successfully');
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
        return redirect()->route('candidate.professionals.index')->with('message', 'Professional skill deleted successfully');
    }
}
