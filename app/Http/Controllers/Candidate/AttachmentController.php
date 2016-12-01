<?php

namespace App\Http\Controllers\Candidate;

use App\Model\frontend\Candidate;
use App\Models\Attachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psy\Exception\ErrorException;
use DB;
use Validator;


class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $c_id = auth()->guard('candidate')->user()->id;
        $candidate = Candidate::with('attachments')->find($c_id);
        $attachments = Attachment::with('candidate')->orderBy('name')->where('candidate_id', $c_id)->get();
        if (count($candidate->attachments) >= 1) {
            return view('candidates.attachments.index', compact('attachments'));
        } else {
            return redirect()->route('candidate.attachments.create')->with('message', 'You can not edit without inserting data');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('candidates.attachments.create');
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
            $data = $request->all();
            DB::beginTransaction();
            $id = auth()->guard('candidate')->user()->id;
            $validator = Validator::make($data, Attachment::rules(), Attachment::messages());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Please review your field and try again');
            }

            $path = 'uploads/candidates/' . date('Y') . '/' . $id;
            $destination_path = public_path($path);
            if (!file_exists($destination_path)) {
                mkdir($destination_path, 0777, true);
            }
            foreach ($request->name as $key => $value) {
                if ($request->hasFile('file')) {
                    if ($request->file('file')->isValid()) {
                        $fileName = auth()->user()->name . '_' . $request->name[$key] . $request->file('file')->getClientOriginalExtension();
                        $request->file('file')->move($destination_path, $fileName);
                        $data['file'] = $path . '/' . $fileName;
                    }
                }
                $data = [
                    'candidate_id' => $id,
                    'name' => $request->name[$key],
                    'file' => $request->file[$key],
                ];

                $ps = Attachment::create($data);
                if (!$ps) {
                    DB::rollbackTransaction();
                    return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Unable to process your request');
                }
            }
        } catch (ErrorException $errorException) {

        }
        DB::commit();
        return redirect()->route('candidate.attachments.index')->with('message', 'Your reference  added successfully');
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
        $attachment = Attachment::with('candidate')->where('candidate_id', $c_id)->find($id);
        return view('candidates.attachments.show', compact('attachment'));
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
        $attachment = Attachment::with('candidate')->where('candidate_id', $c_id)->find($id);
        if (empty($attachment)) {
            return redirect()->route('candidate.attachments.index')->with('error', 'Attachment not found');
        }
        return view('candidates.attachments.edit', compact('attachment'));
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
            $attachment = Attachment::with('candidate')->where('candidate_id', $c_id)->find($id);
            if (empty($attachment)) {
                return redirect()->route('candidate.attachments.index')->with('error', 'Attachment not found');
            }
            $validator = Validator::make($data = $request->all(), Attachment::rules(), Attachment::messages());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Error');
            }

            $attachment = $attachment->update($data);
            if (!$attachment) {
                DB::rollbackTransaction();
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Unable to process your request right now');
            }
        } catch (ErrorException $errorException) {

        }
        DB::commit();
        return redirect()->route('candidate.attachments.index')->with('message', 'Attachment added successfully');
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
        $attachment = Attachment::with('candidate')->where('candidate_id', $c_id)->find($id);
        if (empty($attachment)) {
            return redirect()->route('candidate.attachments.index')->with('error', 'Attachment not found');
        }
        $attachment->delete();
        return redirect()->route('candidate.attachments.index')->with('message', 'Attachment deleted successfully');
    }
}
