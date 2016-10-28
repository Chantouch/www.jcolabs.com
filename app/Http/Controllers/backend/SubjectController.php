<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests\CreateSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Repositories\SubjectRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SubjectController extends AppBaseController
{
    /** @var  SubjectRepository */
    private $subjectRepository;

    public function __construct(SubjectRepository $subjectRepo)
    {
        $this->subjectRepository = $subjectRepo;
        $this->middleware('admin');
    }

    /**
     * Display a listing of the Subject.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->subjectRepository->pushCriteria(new RequestCriteria($request));
        $subjects = $this->subjectRepository->all();

        return view('backend.subjects.index')
            ->with('subjects', $subjects);
    }

    /**
     * Show the form for creating a new Subject.
     *
     * @return Response
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created Subject in storage.
     *
     * @param CreateSubjectRequest $request
     *
     * @return Response
     */
    public function store(CreateSubjectRequest $request)
    {
        $input = $request->all();

        $subject = $this->subjectRepository->create($input);

        Flash::success('Subject saved successfully.');

        return redirect(route('admin.subjects.index'));
    }

    /**
     * Display the specified Subject.
     *
     * @param  int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $subject = $this->subjectRepository->findWithoutFail($id);

        if (empty($subject)) {
            Flash::error('Subject not found');

            return redirect(route('admin.subjects.index'));
        }

        return view('backend.subjects.show')->with('subject', $subject);
    }

    /**
     * Show the form for editing the specified Subject.
     *
     * @param  int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $subject = $this->subjectRepository->findWithoutFail($id);

        if (empty($subject)) {
            Flash::error('Subject not found');

            return redirect(route('admin.subjects.index'));
        }

        return view('backend.subjects.edit')->with('subject', $subject);
    }

    /**
     * Update the specified Subject in storage.
     *
     * @param  int $id
     * @param UpdateSubjectRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSubjectRequest $request)
    {
        $subject = $this->subjectRepository->findWithoutFail($id);

        if (empty($subject)) {
            Flash::error('Subject not found');

            return redirect(route('admin.subjects.index'));
        }

        $subject = $this->subjectRepository->update($request->all(), $id);

        Flash::success('Subject updated successfully.');

        return redirect(route('admin.subjects.index'));
    }

    /**
     * Remove the specified Subject from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $subject = $this->subjectRepository->findWithoutFail($id);

        if (empty($subject)) {
            Flash::error('Subject not found');

            return redirect(route('admin.subjects.index'));
        }

        $this->subjectRepository->delete($id);

        Flash::success('Subject deleted successfully.');

        return redirect(route('admin.subjects.index'));
    }
}
