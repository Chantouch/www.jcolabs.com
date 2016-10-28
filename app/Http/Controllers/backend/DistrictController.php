<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests\CreateDistrictRequest;
use App\Http\Requests\UpdateDistrictRequest;
use App\Models\City;
use App\Repositories\DistrictRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DistrictController extends AppBaseController
{
    /** @var  DistrictRepository */
    private $districtRepository;

    public function __construct(DistrictRepository $districtRepo)
    {
        $this->districtRepository = $districtRepo;
        $this->middleware('admin');
    }

    /**
     * Display a listing of the District.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->districtRepository->pushCriteria(new RequestCriteria($request));
        $districts = $this->districtRepository->with('city')->paginate(20);

        return view('backend.districts.index')
            ->with('districts', $districts);
    }

    /**
     * Show the form for creating a new District.
     *
     * @return Response
     */
    public function create()
    {
        $cities = City::where('status', 1)->orderBy('name')->pluck('name', 'id');
        return view('backend.districts.create' ,compact('cities'));
    }

    /**
     * Store a newly created District in storage.
     *
     * @param CreateDistrictRequest $request
     *
     * @return Response
     */
    public function store(CreateDistrictRequest $request)
    {
        $input = $request->all();

        $district = $this->districtRepository->create($input);

        Flash::success('District saved successfully.');

        return redirect(route('admin.districts.index'));
    }

    /**
     * Display the specified District.
     *
     * @param  int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {

        $cities = City::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $district = $this->districtRepository->findWithoutFail($id);

        if (empty($district)) {
            Flash::error('District not found');

            return redirect(route('admin.districts.index'));
        }

        return view('backend.districts.show', compact('district', 'cities'));
    }

    /**
     * Show the form for editing the specified District.
     *
     * @param  int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $cities = City::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $district = $this->districtRepository->findWithoutFail($id);

        if (empty($district)) {
            Flash::error('District not found');

            return redirect(route('admin.districts.index'));
        }

        return view('backend.districts.edit', compact('district', 'cities'));
    }

    /**
     * Update the specified District in storage.
     *
     * @param  int $id
     * @param UpdateDistrictRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDistrictRequest $request)
    {
        $district = $this->districtRepository->findWithoutFail($id);

        if (empty($district)) {
            Flash::error('District not found');

            return redirect(route('admin.districts.index'));
        }

        $district = $this->districtRepository->update($request->all(), $id);

        Flash::success('District updated successfully.');

        return redirect(route('admin.districts.index'));
    }

    /**
     * Remove the specified District from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $district = $this->districtRepository->findWithoutFail($id);

        if (empty($district)) {
            Flash::error('District not found');

            return redirect(route('admin.districts.index'));
        }

        $this->districtRepository->delete($id);

        Flash::success('District deleted successfully.');

        return redirect(route('admin.districts.index'));
    }
}
