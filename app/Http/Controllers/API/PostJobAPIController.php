<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePostJobAPIRequest;
use App\Http\Requests\API\UpdatePostJobAPIRequest;
use App\Models\PostJob;
use App\Repositories\PostJobRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PostJobController
 * @package App\Http\Controllers\API
 */

class PostJobAPIController extends AppBaseController
{
    /** @var  PostJobRepository */
    private $postJobRepository;

    public function __construct(PostJobRepository $postJobRepo)
    {
        $this->postJobRepository = $postJobRepo;
    }

    /**
     * Display a listing of the PostJob.
     * GET|HEAD /postJobs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->postJobRepository->pushCriteria(new RequestCriteria($request));
        $this->postJobRepository->pushCriteria(new LimitOffsetCriteria($request));
        $postJobs = $this->postJobRepository->all();

        return $this->sendResponse($postJobs->toArray(), 'Post Jobs retrieved successfully');
    }

    /**
     * Store a newly created PostJob in storage.
     * POST /postJobs
     *
     * @param CreatePostJobAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePostJobAPIRequest $request)
    {
        $input = $request->all();

        $postJobs = $this->postJobRepository->create($input);

        return $this->sendResponse($postJobs->toArray(), 'Post Job saved successfully');
    }

    /**
     * Display the specified PostJob.
     * GET|HEAD /postJobs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PostJob $postJob */
        $postJob = $this->postJobRepository->findWithoutFail($id);

        if (empty($postJob)) {
            return $this->sendError('Post Job not found');
        }

        return $this->sendResponse($postJob->toArray(), 'Post Job retrieved successfully');
    }

    /**
     * Update the specified PostJob in storage.
     * PUT/PATCH /postJobs/{id}
     *
     * @param  int $id
     * @param UpdatePostJobAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostJobAPIRequest $request)
    {
        $input = $request->all();

        /** @var PostJob $postJob */
        $postJob = $this->postJobRepository->findWithoutFail($id);

        if (empty($postJob)) {
            return $this->sendError('Post Job not found');
        }

        $postJob = $this->postJobRepository->update($input, $id);

        return $this->sendResponse($postJob->toArray(), 'PostJob updated successfully');
    }

    /**
     * Remove the specified PostJob from storage.
     * DELETE /postJobs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PostJob $postJob */
        $postJob = $this->postJobRepository->findWithoutFail($id);

        if (empty($postJob)) {
            return $this->sendError('Post Job not found');
        }

        $postJob->delete();

        return $this->sendResponse($id, 'Post Job deleted successfully');
    }
}
