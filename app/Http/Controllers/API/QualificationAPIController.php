<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateQualificationAPIRequest;
use App\Http\Requests\API\UpdateQualificationAPIRequest;
use App\Models\Qualification;
use App\Repositories\QualificationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class QualificationController
 * @package App\Http\Controllers\API
 */

class QualificationAPIController extends AppBaseController
{
    /** @var  QualificationRepository */
    private $qualificationRepository;

    public function __construct(QualificationRepository $qualificationRepo)
    {
        $this->qualificationRepository = $qualificationRepo;
    }

    /**
     * Display a listing of the Qualification.
     * GET|HEAD /qualifications
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->qualificationRepository->pushCriteria(new RequestCriteria($request));
        $this->qualificationRepository->pushCriteria(new LimitOffsetCriteria($request));
        $qualifications = $this->qualificationRepository->all();

        return $this->sendResponse($qualifications->toArray(), 'Qualifications retrieved successfully');
    }

    /**
     * Store a newly created Qualification in storage.
     * POST /qualifications
     *
     * @param CreateQualificationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateQualificationAPIRequest $request)
    {
        $input = $request->all();

        $qualifications = $this->qualificationRepository->create($input);

        return $this->sendResponse($qualifications->toArray(), 'Qualification saved successfully');
    }

    /**
     * Display the specified Qualification.
     * GET|HEAD /qualifications/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Qualification $qualification */
        $qualification = $this->qualificationRepository->findWithoutFail($id);

        if (empty($qualification)) {
            return $this->sendError('Qualification not found');
        }

        return $this->sendResponse($qualification->toArray(), 'Qualification retrieved successfully');
    }

    /**
     * Update the specified Qualification in storage.
     * PUT/PATCH /qualifications/{id}
     *
     * @param  int $id
     * @param UpdateQualificationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQualificationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Qualification $qualification */
        $qualification = $this->qualificationRepository->findWithoutFail($id);

        if (empty($qualification)) {
            return $this->sendError('Qualification not found');
        }

        $qualification = $this->qualificationRepository->update($input, $id);

        return $this->sendResponse($qualification->toArray(), 'Qualification updated successfully');
    }

    /**
     * Remove the specified Qualification from storage.
     * DELETE /qualifications/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Qualification $qualification */
        $qualification = $this->qualificationRepository->findWithoutFail($id);

        if (empty($qualification)) {
            return $this->sendError('Qualification not found');
        }

        $qualification->delete();

        return $this->sendResponse($id, 'Qualification deleted successfully');
    }
}
