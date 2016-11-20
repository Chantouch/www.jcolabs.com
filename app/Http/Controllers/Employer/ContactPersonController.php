<?php

namespace App\Http\Controllers\Employer;

use App\Http\Requests\CreateContactPersonRequest;
use App\Http\Requests\UpdateContactPersonRequest;
use App\Model\backend\Employer;
use App\Models\ContactPerson;
use App\Models\DepartmentType;
use App\Models\IndustryType;
use App\Models\Position;
use App\Repositories\ContactPersonRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Validator;
use Illuminate\Support\Facades\DB;

class ContactPersonController extends AppBaseController
{
    /** @var  ContactPersonRepository */
    private $contactPersonRepository;

    public function __construct(ContactPersonRepository $contactPersonRepo)
    {
        $this->contactPersonRepository = $contactPersonRepo;
    }

    /**
     * Display a listing of the ContactPerson.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $employer = Auth::guard('employer')->user()->id;
        $this->contactPersonRepository->pushCriteria(new RequestCriteria($request));
//        $contactPeople = $this->contactPersonRepository->with('department')->;
//
//
//        $employer = Auth::guard('employer')->user()->id;
        $contactPeople = ContactPerson::with('department')->where('employer_id', $employer)->orderBy('contact_name', 'asc')->paginate(5);
        return view('employers.contact_people.index', compact('contactPeople'));
    }

    /**
     * Show the form for creating a new ContactPerson.
     *
     * @return Response
     */
    public function create()
    {

        $departments = ['' => '--- Choose Department---'] + DepartmentType::where('status', 1)->orderBy('name')->pluck('name', 'id')->toArray();;
        $positions = ['' => '--- Choose Position ---'] + Position::where('status', 1)->orderBy('name')->pluck('name', 'id')->toArray();
        return view('employers.contact_people.create', compact('departments', 'positions'));
    }

    /**
     * Store a newly created ContactPerson in storage.
     *
     * @param CreateContactPersonRequest $request
     *
     * @return Redirect
     */
    public function store(CreateContactPersonRequest $request)
    {

        $validator = Validator::make($data = $request->all(), ContactPerson::$rules);

        if ($validator->fails())
            return Redirect::back()->withErrors($validator)->withInput()->with('message', 'Some fields has errors. Please correct it and then try again');

        $data['employer_id'] = Auth::guard('employer')->user()->id;

        DB::beginTransaction();

        $job = ContactPerson::create($data);
        if (!$job) {
            DB::rollbackTransaction();
            return Redirect::back()->withInput()->with('message', 'Unable to process your request');
        }

        DB::commit();

        Flash::success('Contact Person saved successfully.');

        return redirect(route('employer.contactPeople.index'));
    }

    /**
     * Display the specified ContactPerson.
     *
     * @param  int $id
     *
     * @return \Illuminate\Contracts\View\Factory|Redirect|\Illuminate\View\View
     */
    public function show($id)
    {
        $contactPerson = $this->contactPersonRepository->findWithoutFail($id);

        if (empty($contactPerson)) {
            Flash::error('Contact Person not found');

            return redirect(route('employer.contactPeople.index'));
        }

        return view('employers.contact_people.show')->with('contactPerson', $contactPerson);
    }

    /**
     * Show the form for editing the specified ContactPerson.
     *
     * @param  int $id
     *
     * @return Redirect
     */
    public function edit($id)
    {
        $departments = DepartmentType::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $positions = Position::where('status', 1)->orderBy('name')->pluck('name', 'id');

        $contactPerson = $this->contactPersonRepository->findWithoutFail($id);

        if (empty($contactPerson)) {
            Flash::error('Contact Person not found');

            return redirect(route('employer.contactPeople.index'));
        }

        return view('employers.contact_people.edit', compact('contactPerson', 'departments', 'positions'));
    }

    /**
     * Update the specified ContactPerson in storage.
     *
     * @param  int $id
     * @param UpdateContactPersonRequest|Request $request
     * @return Redirect
     */
    public function update($id, Request $request)
    {

        $validator = Validator::make($data = $request->all(), ContactPerson::rules($id));

        if ($validator->fails())
            return Redirect::back()->withErrors($validator)->withInput()->with('message', 'Some fields has errors. Please correct it and then try again');

        $contactPerson = $this->contactPersonRepository->findWithoutFail($id);

        if (empty($contactPerson)) {
            Flash::error('Contact Person not found');

            return redirect(route('employer.contactPeople.index'));
        }

        $contactPerson = $this->contactPersonRepository->update($request->all(), $id);

        Flash::success('Contact Person updated successfully.');

        return redirect(route('employer.contactPeople.index'));
    }

    /**
     * Remove the specified ContactPerson from storage.
     *
     * @param  int $id
     *
     * @return Redirect
     */
    public function destroy($id)
    {
        $contactPerson = $this->contactPersonRepository->findWithoutFail($id);

        if (empty($contactPerson)) {
            Flash::error('Contact Person not found');

            return redirect(route('employer.contactPeople.index'));
        }

        $this->contactPersonRepository->delete($id);

        Flash::success('Contact Person deleted successfully.');

        return redirect(route('employer.contactPeople.index'));
    }
}
