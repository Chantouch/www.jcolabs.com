<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests\CreateDepartmentTypeRequest;
use App\Http\Requests\UpdateDepartmentTypeRequest;
use App\Repositories\DepartmentTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DepartmentTypeController extends AppBaseController
{
    /** @var  DepartmentTypeRepository */
    private $departmentTypeRepository;

    public function __construct(DepartmentTypeRepository $departmentTypeRepo)
    {
        $this->departmentTypeRepository = $departmentTypeRepo;
        $this->middleware('admin');
    }

    /**
     * Display a listing of the DepartmentType.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->departmentTypeRepository->pushCriteria(new RequestCriteria($request));
        $departmentTypes = $this->departmentTypeRepository->all();

        return view('backend.department_types.index')
            ->with('departmentTypes', $departmentTypes);
    }

    /**
     * Show the form for creating a new DepartmentType.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.department_types.create');
    }

    /**
     * Store a newly created DepartmentType in storage.
     *
     * @param CreateDepartmentTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateDepartmentTypeRequest $request)
    {
        $input = $request->all();

        $departmentType = $this->departmentTypeRepository->create($input);

        Flash::success('Department Type saved successfully.');

        return redirect(route('admin.departmentTypes.index'));
    }

    /**
     * Display the specified DepartmentType.
     *
     * @param  int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $departmentType = $this->departmentTypeRepository->findWithoutFail($id);

        if (empty($departmentType)) {

            Flash::error('Department Type not found');

            return redirect(route('admin.departmentTypes.index'));
        }

        return view('backend.department_types.show')->with('departmentType', $departmentType);
    }

    /**
     * Show the form for editing the specified DepartmentType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $departmentType = $this->departmentTypeRepository->findWithoutFail($id);

        if (empty($departmentType)) {
            Flash::error('Department Type not found');

            return redirect(route('admin.departmentTypes.index'));
        }

        return view('backend.department_types.edit')->with('departmentType', $departmentType);
    }

    /**
     * Update the specified DepartmentType in storage.
     *
     * @param  int              $id
     * @param UpdateDepartmentTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDepartmentTypeRequest $request)
    {
        $departmentType = $this->departmentTypeRepository->findWithoutFail($id);

        if (empty($departmentType)) {
            Flash::error('Department Type not found');

            return redirect(route('admin.departmentTypes.index'));
        }

        $departmentType = $this->departmentTypeRepository->update($request->all(), $id);

        Flash::success('Department Type updated successfully.');

        return redirect(route('admin.departmentTypes.index'));
    }

    /**
     * Remove the specified DepartmentType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $departmentType = $this->departmentTypeRepository->findWithoutFail($id);

        if (empty($departmentType)) {
            Flash::error('Department Type not found');

            return redirect(route('admin.departmentTypes.index'));
        }

        $this->departmentTypeRepository->delete($id);

        Flash::success('Department Type deleted successfully.');

        return redirect(route('admin.departmentTypes.index'));
    }
}
