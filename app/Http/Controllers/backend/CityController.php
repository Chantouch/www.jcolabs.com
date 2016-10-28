<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests\CreateCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use App\Repositories\CityRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Str;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Redirect;

class CityController extends AppBaseController
{
    /** @var  CityRepository */
    private $cityRepository;

    public function __construct(CityRepository $cityRepo)
    {
        $this->cityRepository = $cityRepo;
        $this->middleware('admin');
    }

    /**
     * Display a listing of the City.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->cityRepository->pushCriteria(new RequestCriteria($request));
        $cities = $this->cityRepository->all();

        return view('backend.cities.index')
            ->with('cities', $cities);
    }

    /**
     * Show the form for creating a new City.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.cities.create');
    }

    /**
     * Store a newly created City in storage.
     *
     * @param CreateCityRequest $request
     *
     * @return Redirect
     */
    public function store(CreateCityRequest $request)
    {
        $input = $request->all();

        $city = $this->cityRepository->create($input);

        Flash::success('City saved successfully.');

        return redirect(route('admin.cities.index'));
    }

    /**
     * Display the specified City.
     *
     * @param $slug
     * @return Redirect
     * @internal param int $id
     */
    public function show($slug, $id)
    {

        $city = City::where('slug', $slug)->firstOrFail();

        if (empty($city)) {
            Flash::error('City not found');

            return redirect(route('admin.cities.index'));
        }

        if ($slug != Str::slug($city->slug))
            return Redirect::route('admin.cities.index', array('id' => $city->id, 'slug' => $city->slug), 301);

        return view('backend.cities.show', compact('city'));

    }

    /**
     * Show the form for editing the specified City.
     *
     * @param  int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $city = $this->cityRepository->findWithoutFail($id);

        if (empty($city)) {
            Flash::error('City not found');

            return redirect(route('admin.cities.index'));
        }

        return view('backend.cities.edit')->with('city', $city);
    }

    /**
     * Update the specified City in storage.
     *
     * @param  int $id
     * @param UpdateCityRequest $request
     *
     * @return Redirect
     */
    public function update($id, UpdateCityRequest $request)
    {
        $city = City::findOrFail($id);

        if (empty($city)) {
            Flash::error('City not found');

            return redirect(route('admin.cities.index'));
        }

        $city->slug = null;

        $city = $this->cityRepository->update($request->all(), $id);

        Flash::success('City updated successfully.');

        return redirect(route('admin.cities.index'));
    }

    /**
     * Remove the specified City from storage.
     *
     * @param  int $id
     *
     * @return Redirect
     */
    public function destroy($id)
    {
        $city = $this->cityRepository->findWithoutFail($id);

        if (empty($city)) {
            Flash::error('City not found');

            return redirect(route('admin.cities.index'));
        }

        $this->cityRepository->delete($id);

        Flash::success('City deleted successfully.');

        return redirect(route('admin.cities.index'));
    }
}
