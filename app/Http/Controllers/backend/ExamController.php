<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests\CreateExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Repositories\ExamRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ExamController extends AppBaseController
{
    /** @var  ExamRepository */
    private $examRepository;

    public function __construct(ExamRepository $examRepo)
    {
        $this->examRepository = $examRepo;
        $this->middleware('admin');
    }

    /**
     * Display a listing of the Exam.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->examRepository->pushCriteria(new RequestCriteria($request));
        $exams = $this->examRepository->all();

        return view('backend.exams.index')
            ->with('exams', $exams);
    }

    /**
     * Show the form for creating a new Exam.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.exams.create');
    }

    /**
     * Store a newly created Exam in storage.
     *
     * @param CreateExamRequest $request
     *
     * @return Response
     */
    public function store(CreateExamRequest $request)
    {
        $input = $request->all();

        $exam = $this->examRepository->create($input);

        Flash::success('Exam saved successfully.');

        return redirect(route('admin.exams.index'));
    }

    /**
     * Display the specified Exam.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $exam = $this->examRepository->findWithoutFail($id);

        if (empty($exam)) {
            Flash::error('Exam not found');

            return redirect(route('admin.exams.index'));
        }

        return view('backend.exams.show')->with('exam', $exam);
    }

    /**
     * Show the form for editing the specified Exam.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $exam = $this->examRepository->findWithoutFail($id);

        if (empty($exam)) {
            Flash::error('Exam not found');

            return redirect(route('admin.exams.index'));
        }

        return view('backend.exams.edit')->with('exam', $exam);
    }

    /**
     * Update the specified Exam in storage.
     *
     * @param  int              $id
     * @param UpdateExamRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExamRequest $request)
    {
        $exam = $this->examRepository->findWithoutFail($id);

        if (empty($exam)) {
            Flash::error('Exam not found');

            return redirect(route('admin.exams.index'));
        }

        $exam = $this->examRepository->update($request->all(), $id);

        Flash::success('Exam updated successfully.');

        return redirect(route('admin.exams.index'));
    }

    /**
     * Remove the specified Exam from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $exam = $this->examRepository->findWithoutFail($id);

        if (empty($exam)) {
            Flash::error('Exam not found');

            return redirect(route('admin.exams.index'));
        }

        $this->examRepository->delete($id);

        Flash::success('Exam deleted successfully.');

        return redirect(route('admin.exams.index'));
    }
}
