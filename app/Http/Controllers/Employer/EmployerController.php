<?php

namespace App\Http\Controllers\Employer;

use App\Helpers\BaseHelper;
use App\Http\Controllers\Controller;
use App\Model\backend\Employer;
use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\DepartmentType;
use App\Models\District;
use App\Models\EmployerDocument;
use App\Models\Exam;
use App\Models\IndustryType;
use App\Models\Position;
use App\Models\PostedJob;
use App\Models\Subject;
use Cviebrock\EloquentSluggable\Tests\Models\Post;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Image;
use Validator;
use DB;
use Vinkla\Hashids\HashidsManager;

class EmployerController extends Controller
{

    protected $hashid;

    /**
     * Create a new controller instance.
     *
     * @param HashidsManager $hashidsManager
     */
    public function __construct(HashidsManager $hashidsManager)
    {
        $this->middleware('employer');
        return $this->hashid = $hashidsManager;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {

        return view('employers.dashboard');

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listJobs()
    {
        $id = Auth::guard('employer')->user()->id;
        $jobs = PostedJob::with('industry')->where('created_by', '=', $id)->paginate(20);
        return view('employers.jobs.index', compact('jobs'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createJob()
    {
        $industries = IndustryType::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $cities = City::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $districts = District::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $exams = Exam::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $subjects = Subject::where('status', 1)->orderBy('name')->pluck('name', 'id');
        return view('employers.jobs.create', compact('industries', 'cities', 'exams', 'subjects', 'districts'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeJob(Request $request)
    {
        if (Auth::guard('employer')->user()->verified_by == 0 || Auth::guard('employer')->user()->enrollment_no == '') {
            return redirect()->back()->withInput()->with('message', BaseHelper::getMessage('employer_not_active'));
        }

        $validator = Validattor::make($data = $request->all(), PostedJob::$rules, PostedJob::$message);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Some files has errors. Please correct it and then try it again.');
        }

        $data['created_by'] = Auth::guard('employer')->user()->id;
        DB::beginTransaction();

        //Generate job id
        $records = PostedJob::withTrashed()->count();
        $current_id = 1;
        if (!$records == 0) {
            $current_id = PostedJob::withTrashed()->orderBy('id', 'DESC')->first()->id + 1;
        }
        $job_id = 'EMP_JOB' . str_pad($current_id, 6, '0', STR_PAD_LEFT);
        $data['emp_job_id'] = $job_id;
        $data['status'] = 1;
        $job = PostedJob::create($data);
        if (!$job) {
            DB::rollbackTransaction();
            return redirect()->back()->withInput()->with('message', 'Unable to process your requires');
        }
        DB::commit();
        return redirect()->route('employer.jobs.index')->with('message', 'New job has been Posted');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewJob($id)
    {
        $decoded = $this->hashid->decode($id);
        $id = $decoded[0];
        $results = PostedJob::with('industry')->with('district')->with('exam')->with('subject')->with('employer')->findOrFail($id);
        return view('employers.post_jobs.view', compact('results'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateJobStatus($id, Request $request)
    {
        $decoded = $this->hashid->decode($id);
        $id = $decoded[0];
        $status = 1;
        $route_name = $request->route()->getName();
        if ($route_name == 'employer.update_job_status_filled_up') {
            $status = 2;
        } elseif ($route_name == 'employer.update_job_status_active') {
            $status = 1;
        } elseif ($route_name == 'employer.update_job_status_disabled') {
            $status = 0;
        }
        $model = PostedJob::findOrFail($id);
        $model->status = $status;

        if ($model->save())
            return redirect()->back()->with('message', 'Job status has been updated');
        else
            return redirect()->back()->with('message', 'Unable to process please try again');
    }


    public function viewCompanyProfile()
    {
        $profile = Auth::guard('employer')->user();
        $departments = ['' => '--- Choose Department---'] + DepartmentType::where('status', 1)->orderBy('name')->pluck('name', 'id')->toArray();;
        $positions = ['' => '--- Choose Position ---'] + Position::where('status', 1)->orderBy('name')->pluck('name', 'id')->toArray();
        $id = Auth::guard('employer')->user()->id;
        $all_jobs = PostedJob::with('employer')->where('created_by', $id)->paginate(2);
        $total_jobs = PostedJob::where('created_by', $id)
            ->count();
        $jobs_not_verified = PostedJob::with('industry')->where('created_by', $id)
            ->where('status', 0)
            ->get();
        $jobs_available = PostedJob::with('industry')->where('created_by', $id)
            ->where('status', 1)
            ->get(); //to gel all jobs that is marked as available/published
        $jobs_filled_up = PostedJob::with('industry')->where('created_by', $id)
            ->where('status', 2)
            ->get();
        return view('employers.company.profile', compact('all_jobs', 'positions', 'departments', 'profile', 'total_jobs', 'jobs_not_verified', 'jobs_available', 'jobs_filled_up'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteJob($id)
    {

        $decode = $this->hashid->deocde($id);
        $id = $decode[0];
        $city = PostedJob::findOrFail($id);
        if (empty($city)) {

            Flash::error('City not found');

            return redirect(route('admin.cities.index'));
        }

        if ($city->delete())
            return redirect()->back()->with('message', 'The Job has been Successfully deleted.');
        else
            return redirect()->back()->with('message', 'Unable to process your request. Please try again.');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showChangePasswordForm()
    {
        return view('employers.company.change-password');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showDocumentUploadForm()
    {
        $doc_types = [
            '' => '--Select--',
            'pan_card' => 'PAN CARD',
            'company_firm_rc' => 'Company/firm Registration certificate',
            'trade_license' => 'Trade License',
            'govt_dept_rc' => 'Govt Department Registration Certificate',
            'others' => 'Others'
        ];
        return view('employers.documents.create', compact('doc_types'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doDocumentUploadForm(Request $request)
    {

        $validator = Validator::make($data = $request->all(), EmployerDocument::$rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput()->with('message', 'Some fields has errors. Please correct it and then try again');

        $id = Auth::guard('employer')->user()->id;
        $data['employer_id'] = $id;
        $destination_path = public_path('uploads/employers/' . $id);
        if (!file_exists($destination_path)) {
            mkdir($destination_path, 0777, true);
        }
        if ($request->hasFile('doc_url')) {

            if ($request->file('doc_url')->isValid()) {
                $fileName = uniqid($request->doc_type . '_') . '.' . $request->file('doc_url')->getClientOriginalExtension();
                $request->file('doc_url')->move($destination_path, $fileName);
                $data['doc_url'] = 'uploads/employers/' . $id . '/' . $fileName;
            }
        }

        $status = EmployerDocument::create($data);
        if (!$status)
            return redirect()->back()->withInput()->with('message', 'Unable to process your request');

        return redirect()->route('employer.documents.uploaded.index')->with('message', 'Documents has been uploaded successfully!');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showDocumentLists()
    {
        $id = Auth::guard('employer')->user()->id;
        $results = Employer::find($id)->documents()->get();
        //$results = EmployerDocument::where('candidate');documents
        return view('employers.documents.index', compact('results'));
    }

    /**
     * @param $id
     */
    public function deleteDocument($id)
    {
        # code...
        //TODO decode the id and soft delete/ perm delete it
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showUpdateCompanyProfile()
    {

        $organization_sector = ['Private' => 'Private', 'Central Govt' => 'Central Govt', 'State Govt' => 'State Govt', 'Central PSU' => 'Central PSU', 'State PSU' => 'State PSU', 'Local Bodies' => 'Local Bodies', 'Statutory Bodies' => 'Statutory Bodies', 'Others' => 'Others'];
        $industries = IndustryType::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $profile = Auth::guard('employer')->user();
        $profile_id = Auth::guard('employer')->user()->id;
        $position = Position::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $district = District::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $city = City::where('status', 1)->orderBy('name')->pluck('name', 'id');
        return view('employers.company.edit', compact('profile', 'profile_id', 'position', 'industries', 'organization_sector', 'city', 'district'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCompanyProfile(Request $request)
    {
        $employer = new Employer();
        $data = $request->all();
        $validator = Validator::make($data, $employer->rules(), Employer::$messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $id = Auth::guard('employer')->user()->id;
        $profile = Auth::guard('employer')->user();
        $path = 'uploads/employers/profile/' . $id . '/';
        $path_small = 'uploads/employers/small/' . $id . '/';
        $path_avatar = 'uploads/employers/avatar/' . $id . '/';
        $destination_path = public_path($path);
        $destination_small = public_path($path_small);
        $destination_avatar = public_path($path_avatar);

        if ($request->hasFile('photo')) {
            if ($request->file('photo')->isValid()) {

                if (!file_exists($destination_path)) {
                    mkdir($destination_path, 0777, true);
                }

                if (!file_exists($destination_avatar)) {
                    mkdir($destination_avatar, 0777, true);
                }

                if (!file_exists($destination_small)) {
                    mkdir($destination_small, 0777, true);
                }

                $avatar = Image::make($request->file('photo'))->resize(256, 256);
                $profile_image = Image::make($request->file('photo'))->resize(800, 385);
                $profile_small = Image::make($request->file('photo'))->resize(200, 40);
                //to remove space from string
                $company_name = preg_replace('/\s+/', '', $request->organization_name);
                $fileName = uniqid($company_name . '_') . '_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
                $oldName = $profile->photo;
                $avatar->save($destination_avatar . '/' . $fileName, 100);
                $profile_image->save($destination_path . '/' . $fileName, 100);
                $profile_small->save($destination_small . '/' . $fileName, 100);
                //$request->file('photo')->move($destination_path, $fileName);
                $data['path'] = $path;
                $data['photo'] = $fileName;
                //$storage = Storage::delete($destination_path . $oldName);

            }
        }

        $profile->update($data);
        return redirect(route('employers.dashboard'))->with('alert-success', 'You have updated your profile');

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function jobExpired()
    {
        $current_date = date('Y-m-d');
        $expired = PostedJob::with('employer')->where('closing_date', '<', $current_date)->paginate(20);
        return view('employers.expired_jobs.index', compact('expired'));
    }

}
