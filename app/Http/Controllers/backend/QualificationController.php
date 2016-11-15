<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests\CreateQualificationRequest;
use App\Http\Requests\UpdateQualificationRequest;
use App\Repositories\QualificationRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class QualificationController extends AppBaseController
{
    /** @var  QualificationRepository */
    private $qualificationRepository;

    public function __construct(QualificationRepository $qualificationRepo)
    {
        $this->qualificationRepository = $qualificationRepo;
    }

    /**
     * Display a listing of the Qualification.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->qualificationRepository->pushCriteria(new RequestCriteria($request));
        $qualifications = $this->qualificationRepository->all();

        return view('backend.qualifications.index')
            ->with('qualifications', $qualifications);
    }

    /**
     * Show the form for creating a new Qualification.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.qualifications.create');
    }

    /**
     * Store a newly created Qualification in storage.
     *
     * @param CreateQualificationRequest $request
     *
     * @return Response
     */
    public function store(CreateQualificationRequest $request)
    {
        $input = $request->all();

        $qualification = $this->qualificationRepository->create($input);

        Flash::success('Qualification saved successfully.');

        return redirect(route('admin.qualifications.index'));
    }

    /**
     * Display the specified Qualification.
     *
     * @param  int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $qualification = $this->qualificationRepository->findWithoutFail($id);

        if (empty($qualification)) {
            Flash::error('Qualification not found');

            return redirect(route('admin.qualifications.index'));
        }

        return view('backend.qualifications.show')->with('qualification', $qualification);
    }

    /**
     * Show the form for editing the specified Qualification.
     *
     * @param  int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $qualification = $this->qualificationRepository->findWithoutFail($id);

        if (empty($qualification)) {
            Flash::error('Qualification not found');

            return redirect(route('admin.qualifications.index'));
        }

        return view('backend.qualifications.edit')->with('qualification', $qualification);
    }

    /**
     * Update the specified Qualification in storage.
     *
     * @param  int $id
     * @param UpdateQualificationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQualificationRequest $request)
    {
        $qualification = $this->qualificationRepository->findWithoutFail($id);

        if (empty($qualification)) {
            Flash::error('Qualification not found');

            return redirect(route('admin.qualifications.index'));
        }

        $qualification = $this->qualificationRepository->update($request->all(), $id);

        Flash::success('Qualification updated successfully.');

        return redirect(route('admin.qualifications.index'));
    }

    /**
     * Remove the specified Qualification from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $qualification = $this->qualificationRepository->findWithoutFail($id);

        if (empty($qualification)) {
            Flash::error('Qualification not found');

            return redirect(route('admin.qualifications.index'));
        }

        $this->qualificationRepository->delete($id);

        Flash::success('Qualification deleted successfully.');

        return redirect(route('admin.qualifications.index'));
    }
}
