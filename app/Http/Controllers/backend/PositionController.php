<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests\CreatePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Repositories\PositionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PositionController extends AppBaseController
{
    /** @var  PositionRepository */
    private $positionRepository;

    public function __construct(PositionRepository $positionRepo)
    {
        $this->positionRepository = $positionRepo;
    }

    /**
     * Display a listing of the Position.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->positionRepository->pushCriteria(new RequestCriteria($request));
        $positions = $this->positionRepository->all();

        return view('backend.positions.index')
            ->with('positions', $positions);
    }

    /**
     * Show the form for creating a new Position.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.positions.create');
    }

    /**
     * Store a newly created Position in storage.
     *
     * @param CreatePositionRequest $request
     *
     * @return Response
     */
    public function store(CreatePositionRequest $request)
    {
        $input = $request->all();

        $position = $this->positionRepository->create($input);

        Flash::success('Position saved successfully.');

        return redirect(route('admin.positions.index'));
    }

    /**
     * Display the specified Position.
     *
     * @param  int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $position = $this->positionRepository->findWithoutFail($id);

        if (empty($position)) {
            Flash::error('Position not found');

            return redirect(route('admin.positions.index'));
        }

        return view('backend.positions.show')->with('position', $position);
    }

    /**
     * Show the form for editing the specified Position.
     *
     * @param  int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $position = $this->positionRepository->findWithoutFail($id);

        if (empty($position)) {
            Flash::error('Position not found');

            return redirect(route('admin.positions.index'));
        }

        return view('backend.positions.edit')->with('position', $position);
    }

    /**
     * Update the specified Position in storage.
     *
     * @param  int              $id
     * @param UpdatePositionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePositionRequest $request)
    {
        $position = $this->positionRepository->findWithoutFail($id);

        if (empty($position)) {
            Flash::error('Position not found');

            return redirect(route('admin.positions.index'));
        }

        $position = $this->positionRepository->update($request->all(), $id);

        Flash::success('Position updated successfully.');

        return redirect(route('admin.positions.index'));
    }

    /**
     * Remove the specified Position from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $position = $this->positionRepository->findWithoutFail($id);

        if (empty($position)) {
            Flash::error('Position not found');

            return redirect(route('admin.positions.index'));
        }

        $this->positionRepository->delete($id);

        Flash::success('Position deleted successfully.');

        return redirect(route('admin.positions.index'));
    }
}
