<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests\CreateIndustryTypeRequest;
use App\Http\Requests\UpdateIndustryTypeRequest;
use App\Repositories\IndustryTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class IndustryTypeController extends AppBaseController
{
    /** @var  IndustryTypeRepository */
    private $industryTypeRepository;

    public function __construct(IndustryTypeRepository $industryTypeRepo)
    {
        $this->industryTypeRepository = $industryTypeRepo;
        $this->middleware('admin');
    }

    /**
     * Display a listing of the IndustryType.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->industryTypeRepository->pushCriteria(new RequestCriteria($request));
        $industryTypes = $this->industryTypeRepository->all();

        return view('backend.industry_types.index')
            ->with('industryTypes', $industryTypes);
    }

    /**
     * Show the form for creating a new IndustryType.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.industry_types.create');
    }

    /**
     * Store a newly created IndustryType in storage.
     *
     * @param CreateIndustryTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateIndustryTypeRequest $request)
    {
        $input = $request->all();

        $industryType = $this->industryTypeRepository->create($input);

        Flash::success('Industry Type saved successfully.');

        return redirect(route('admin.industryTypes.index'));
    }

    /**
     * Display the specified IndustryType.
     *
     * @param  int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $industryType = $this->industryTypeRepository->findWithoutFail($id);

        if (empty($industryType)) {
            Flash::error('Industry Type not found');

            return redirect(route('admin.industryTypes.index'));
        }

        return view('backend.industry_types.show')->with('industryType', $industryType);
    }

    /**
     * Show the form for editing the specified IndustryType.
     *
     * @param  int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $industryType = $this->industryTypeRepository->findWithoutFail($id);

        if (empty($industryType)) {
            Flash::error('Industry Type not found');

            return redirect(route('admin.industryTypes.index'));
        }

        return view('backend.industry_types.edit')->with('industryType', $industryType);
    }

    /**
     * Update the specified IndustryType in storage.
     *
     * @param  int $id
     * @param UpdateIndustryTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIndustryTypeRequest $request)
    {
        $industryType = $this->industryTypeRepository->findWithoutFail($id);

        if (empty($industryType)) {
            Flash::error('Industry Type not found');

            return redirect(route('admin.industryTypes.index'));
        }

        $industryType = $this->industryTypeRepository->update($request->all(), $id);

        Flash::success('Industry Type updated successfully.');

        return redirect(route('admin.industryTypes.index'));
    }

    /**
     * Remove the specified IndustryType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $industryType = $this->industryTypeRepository->findWithoutFail($id);

        if (empty($industryType)) {
            Flash::error('Industry Type not found');

            return redirect(route('admin.industryTypes.index'));
        }

        $this->industryTypeRepository->delete($id);

        Flash::success('Industry Type deleted successfully.');

        return redirect(route('admin.industryTypes.index'));
    }
}
