<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Auth::routes();

Route::post('api/fetch/district', ['as' => 'district.by.city', 'uses' => 'RestController@getDistricts']);

Route::group(['middleware' => ['guest']], function () {

    Route::get('/', ['as' => 'home', 'uses' => 'FrontController@index']);

    Route::get('/home', function () {
        return view('frontend.home');
    });

    // ADMIN
    Route::get('admin/login', 'backend\Auth\LoginController@getLoginForm');
    Route::post('admin/authenticate', 'backend\Auth\LoginController@authenticate');

    Route::get('admin/register', 'backend\Auth\RegisterController@getRegisterForm');
    Route::post('admin/saveregister', 'backend\Auth\RegisterController@saveRegisterForm');

    Route::get('admin/register/verify/{token}', 'backend\Auth\RegisterController@verify');

    // USER 
    Route::get('user/login', 'frontend\Auth\LoginController@getLoginForm');
    Route::post('user/authenticate', 'frontend\Auth\LoginController@authenticate');

    Route::get('user/register', 'frontend\Auth\RegisterController@getRegisterForm');
    Route::post('user/saveregister', 'frontend\Auth\RegisterController@saveRegisterForm');

    // Employer
    Route::get('employer/login', 'Employer\Auth\LoginController@getLoginForm');
    Route::post('employer/authenticate', 'Employer\Auth\LoginController@authenticate');

    Route::get('employer/register', 'Employer\Auth\RegisterController@getRegisterForm');
    Route::post('employer/saveregister', 'Employer\Auth\RegisterController@saveRegisterForm');

    Route::get('employer/verify/{token}', 'Employer\Auth\RegisterController@verify');

});


Route::group(['middleware' => ['user']], function () {

    Route::post('user/logout', 'frontend\Auth\LoginController@getLogout');
    Route::get('user/dashboard', 'frontend\UserController@dashboard');
    Route::get('user/dashboard1/', function () {
        return view('frontend.dashboard');
    });
});


Route::group(['middleware' => ['admin']], function () {
    Route::group(array('prefix' => 'admin'), function () {
        Route::post('logout', 'backend\Auth\LoginController@getLogout');

        Route::get('dashboard', ['as' => 'admin.dashboard.index', 'uses' => 'backend\AdminController@index']);

        Route::group(array('prefix' => 'master'), function () {

            Route::get('job-list-all', ['as' => 'admin.jobListAll.jobListAll', 'uses' => 'backend\AdminController@jobListAll']);

            Route::get('industry-types', ['as' => 'admin.industryTypes.index', 'uses' => 'backend\IndustryTypeController@index']);
            Route::post('industry-types', ['as' => 'admin.industryTypes.store', 'uses' => 'backend\IndustryTypeController@store']);
            Route::get('industry-types/create', ['as' => 'admin.industryTypes.create', 'uses' => 'backend\IndustryTypeController@create']);
            Route::put('industry-types/{industryTypes}', ['as' => 'admin.industryTypes.update', 'uses' => 'backend\IndustryTypeController@update']);
            Route::patch('industry-types/{industryTypes}', ['as' => 'admin.industryTypes.update', 'uses' => 'backend\IndustryTypeController@update']);
            Route::delete('industry-types/{industryTypes}', ['as' => 'admin.industryTypes.destroy', 'uses' => 'backend\IndustryTypeController@destroy']);
            Route::get('industry-types/{industryTypes}', ['as' => 'admin.industryTypes.show', 'uses' => 'backend\IndustryTypeController@show']);
            Route::get('industry-types/{industryTypes}/edit', ['as' => 'admin.industryTypes.edit', 'uses' => 'backend\IndustryTypeController@edit']);


            Route::get('department-types', ['as' => 'admin.departmentTypes.index', 'uses' => 'backend\DepartmentTypeController@index']);
            Route::post('department-types', ['as' => 'admin.departmentTypes.store', 'uses' => 'backend\DepartmentTypeController@store']);
            Route::get('department-types/create', ['as' => 'admin.departmentTypes.create', 'uses' => 'backend\DepartmentTypeController@create']);
            Route::put('department-types/{departmentTypes}', ['as' => 'admin.departmentTypes.update', 'uses' => 'backend\DepartmentTypeController@update']);
            Route::patch('department-types/{departmentTypes}', ['as' => 'admin.departmentTypes.update', 'uses' => 'backend\DepartmentTypeController@update']);
            Route::delete('department-types/{departmentTypes}', ['as' => 'admin.departmentTypes.destroy', 'uses' => 'backend\DepartmentTypeController@destroy']);
            Route::get('department-types/{departmentTypes}', ['as' => 'admin.departmentTypes.show', 'uses' => 'backend\DepartmentTypeController@show']);
            Route::get('department-types/{departmentTypes}/edit', ['as' => 'admin.departmentTypes.edit', 'uses' => 'backend\DepartmentTypeController@edit']);


            Route::get('boards', ['as' => 'admin.boards.index', 'uses' => 'backend\BoardController@index']);
            Route::post('boards', ['as' => 'admin.boards.store', 'uses' => 'backend\BoardController@store']);
            Route::get('boards/create', ['as' => 'admin.boards.create', 'uses' => 'backend\BoardController@create']);
            Route::put('boards/{boards}', ['as' => 'admin.boards.update', 'uses' => 'backend\BoardController@update']);
            Route::patch('boards/{boards}', ['as' => 'admin.boards.update', 'uses' => 'backend\BoardController@update']);
            Route::delete('boards/{boards}', ['as' => 'admin.boards.destroy', 'uses' => 'backend\BoardController@destroy']);
            Route::get('boards/{boards}', ['as' => 'admin.boards.show', 'uses' => 'backend\BoardController@show']);
            Route::get('boards/{boards}/edit', ['as' => 'admin.boards.edit', 'uses' => 'backend\BoardController@edit']);


            Route::get('subjects', ['as' => 'admin.subjects.index', 'uses' => 'backend\SubjectController@index']);
            Route::post('subjects', ['as' => 'admin.subjects.store', 'uses' => 'backend\SubjectController@store']);
            Route::get('subjects/create', ['as' => 'admin.subjects.create', 'uses' => 'backend\SubjectController@create']);
            Route::put('subjects/{subjects}', ['as' => 'admin.subjects.update', 'uses' => 'backend\SubjectController@update']);
            Route::patch('subjects/{subjects}', ['as' => 'admin.subjects.update', 'uses' => 'backend\SubjectController@update']);
            Route::delete('subjects/{subjects}', ['as' => 'admin.subjects.destroy', 'uses' => 'backend\SubjectController@destroy']);
            Route::get('subjects/{subjects}', ['as' => 'admin.subjects.show', 'uses' => 'backend\SubjectController@show']);
            Route::get('subjects/{subjects}/edit', ['as' => 'admin.subjects.edit', 'uses' => 'backend\SubjectController@edit']);


            Route::get('languages', ['as' => 'admin.languages.index', 'uses' => 'backend\LanguageController@index']);
            Route::post('languages', ['as' => 'admin.languages.store', 'uses' => 'backend\LanguageController@store']);
            Route::get('languages/create', ['as' => 'admin.languages.create', 'uses' => 'backend\LanguageController@create']);
            Route::put('languages/{languages}', ['as' => 'admin.languages.update', 'uses' => 'backend\LanguageController@update']);
            Route::patch('languages/{languages}', ['as' => 'admin.languages.update', 'uses' => 'backend\LanguageController@update']);
            Route::delete('languages/{languages}', ['as' => 'admin.languages.destroy', 'uses' => 'backend\LanguageController@destroy']);
            Route::get('languages/{languages}', ['as' => 'admin.languages.show', 'uses' => 'backend\LanguageController@show']);
            Route::get('languages/{languages}/edit', ['as' => 'admin.languages.edit', 'uses' => 'backend\LanguageController@edit']);


            Route::get('proof-residences', ['as' => 'admin.proofResidenses.index', 'uses' => 'backend\ProofResidenseController@index']);
            Route::post('proof-residences', ['as' => 'admin.proofResidenses.store', 'uses' => 'backend\ProofResidenseController@store']);
            Route::get('proof-residences/create', ['as' => 'admin.proofResidenses.create', 'uses' => 'backend\ProofResidenseController@create']);
            Route::put('proof-residences/{proofResidenses}', ['as' => 'admin.proofResidenses.update', 'uses' => 'backend\ProofResidenseController@update']);
            Route::patch('proof-residences/{proofResidenses}', ['as' => 'admin.proofResidenses.update', 'uses' => 'backend\ProofResidenseController@update']);
            Route::delete('proof-residences/{proofResidenses}', ['as' => 'admin.proofResidenses.destroy', 'uses' => 'backend\ProofResidenseController@destroy']);
            Route::get('proof-residences/{proofResidenses}', ['as' => 'admin.proofResidenses.show', 'uses' => 'backend\ProofResidenseController@show']);
            Route::get('proof-residences/{proofResidenses}/edit', ['as' => 'admin.proofResidenses.edit', 'uses' => 'backend\ProofResidenseController@edit']);

            Route::pattern('id', '\d+');
            Route::pattern('hash', '[a-z0-9]+');
            Route::pattern('hex', '[a-f0-9]+');
            Route::pattern('uuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');
            Route::pattern('base', '[a-zA-Z0-9]+');
            Route::pattern('slug', '[a-z0-9-]+');

            Route::get('cities', ['as' => 'admin.cities.index', 'uses' => 'backend\CityController@index']);
            Route::post('cities', ['as' => 'admin.cities.store', 'uses' => 'backend\CityController@store']);
            Route::get('cities/create', ['as' => 'admin.cities.create', 'uses' => 'backend\CityController@create']);
            Route::put('cities/{cities}', ['as' => 'admin.cities.update', 'uses' => 'backend\CityController@update']);
            Route::patch('cities/{cities}', ['as' => 'admin.cities.update', 'uses' => 'backend\CityController@update']);
            Route::delete('cities/{cities}', ['as' => 'admin.cities.destroy', 'uses' => 'backend\CityController@destroy']);
            Route::get('cities/{slug?}/{id}', ['as' => 'admin.cities.show', 'uses' => 'backend\CityController@show']);
            Route::get('cities/{cities}/edit', ['as' => 'admin.cities.edit', 'uses' => 'backend\CityController@edit']);


            Route::get('districts', ['as' => 'admin.districts.index', 'uses' => 'backend\DistrictController@index']);
            Route::post('districts', ['as' => 'admin.districts.store', 'uses' => 'backend\DistrictController@store']);
            Route::get('districts/create', ['as' => 'admin.districts.create', 'uses' => 'backend\DistrictController@create']);
            Route::put('districts/{districts}', ['as' => 'admin.districts.update', 'uses' => 'backend\DistrictController@update']);
            Route::patch('districts/{districts}', ['as' => 'admin.districts.update', 'uses' => 'backend\DistrictController@update']);
            Route::delete('districts/{districts}', ['as' => 'admin.districts.destroy', 'uses' => 'backend\DistrictController@destroy']);
            Route::get('districts/{districts}', ['as' => 'admin.districts.show', 'uses' => 'backend\DistrictController@show']);
            Route::get('districts/{districts}/edit', ['as' => 'admin.districts.edit', 'uses' => 'backend\DistrictController@edit']);


            Route::get('exams', ['as' => 'admin.exams.index', 'uses' => 'backend\ExamController@index']);
            Route::post('exams', ['as' => 'admin.exams.store', 'uses' => 'backend\ExamController@store']);
            Route::get('exams/create', ['as' => 'admin.exams.create', 'uses' => 'backend\ExamController@create']);
            Route::put('exams/{exams}', ['as' => 'admin.exams.update', 'uses' => 'backend\ExamController@update']);
            Route::patch('exams/{exams}', ['as' => 'admin.exams.update', 'uses' => 'backend\ExamController@update']);
            Route::delete('exams/{exams}', ['as' => 'admin.exams.destroy', 'uses' => 'backend\ExamController@destroy']);
            Route::get('exams/{exams}', ['as' => 'admin.exams.show', 'uses' => 'backend\ExamController@show']);
            Route::get('exams/{exams}/edit', ['as' => 'admin.exams.edit', 'uses' => 'backend\ExamController@edit']);


            Route::get('positions', ['as' => 'admin.positions.index', 'uses' => 'backend\PositionController@index']);
            Route::post('positions', ['as' => 'admin.positions.store', 'uses' => 'backend\PositionController@store']);
            Route::get('positions/create', ['as' => 'admin.positions.create', 'uses' => 'backend\PositionController@create']);
            Route::put('positions/{positions}', ['as' => 'admin.positions.update', 'uses' => 'backend\PositionController@update']);
            Route::patch('positions/{positions}', ['as' => 'admin.positions.update', 'uses' => 'backend\PositionController@update']);
            Route::delete('positions/{positions}', ['as' => 'admin.positions.destroy', 'uses' => 'backend\PositionController@destroy']);
            Route::get('positions/{positions}', ['as' => 'admin.positions.show', 'uses' => 'backend\PositionController@show']);
            Route::get('positions/{positions}/edit', ['as' => 'admin.positions.edit', 'uses' => 'backend\PositionController@edit']);

            //Admin List view proposed on Admin Panel
            Route::get('accounts/view/{id}', ['as' => 'admin.admins_accounts.view', 'uses' => 'backend\AdminController@adminsAccounts']);


        });

        //Employer Module on Admin Panel
        Route::group(array('prefix' => 'employers'), function () {
            Route::get('/', ['as' => 'admin.employers.employerListAll', 'uses' => 'backend\AdminController@employerListAll']);
            Route::get('view/profile/{employer_id}', ['as' => 'admin.employer_view_profile', 'uses' => 'backend\AdminController@viewEmployerProfile']);
            Route::get('verify/{id}', ['as' => 'admin.employerVerify', 'uses' => 'backend\AdminController@verifyEmployer']);
        });


        Route::group(array('prefix' => 'candidates'), function () {
            Route::get('applications/received', ['as' => 'admin.applications_received', 'uses' => 'backend\AdminController@applicationsReceived']);
            //Route::get('candidates/view/i_card/{candidate_id}', ['as' => 'admin.view.i_card', 'uses' => 'RestController@viewIdentityCard']);
            //Route::get('candidates/view/profile/{candidate_id}', ['as' => 'admin.view.profile', 'uses' => 'RestController@viewCandidateProfile']);
            Route::get('verify/profile/{candidate_id}', ['as' => 'admin.verify.profile', 'uses' => 'backend\AdminController@verifyCandidate']);
            Route::get('applications/verified', ['as' => 'admin.applications_verified', 'uses' => 'backend\AdminController@applicationsVerified']);
            Route::get('suspend/profile/{candidate_id}', ['as' => 'admin.suspend.profile', 'uses' => 'backend\AdminController@suspendCandidate']);
            Route::get('applications/suspended', ['as' => 'admin.applications_suspended', 'uses' => 'backend\AdminController@applicationsSuspended']);
        });
    });
//End route admin
});

Route::group(['middleware' => ['employer']], function () {

    Route::group(array('prefix' => 'employers'), function () {

        Route::get('dashboard', 'Employer\EmployerController@dashboard');
        Route::post('logout', 'Employer\Auth\LoginController@getLogout');

        Route::get('account-settings/contact-person', ['as' => 'employer.contactPeople.index', 'uses' => 'Employer\ContactPersonController@index']);
        Route::post('account-settings/contact-person', ['as' => 'employer.contactPeople.store', 'uses' => 'Employer\ContactPersonController@store']);
        Route::get('account-settings/contact-person/create', ['as' => 'employer.contactPeople.create', 'uses' => 'Employer\ContactPersonController@create']);
        Route::put('account-settings/contact-person/{contactPeople}', ['as' => 'employer.contactPeople.update', 'uses' => 'Employer\ContactPersonController@update']);
        Route::patch('account-settings/contact-person/{contactPeople}', ['as' => 'employer.contactPeople.update', 'uses' => 'Employer\ContactPersonController@update']);
        Route::delete('account-settings/contact-person/{contactPeople}', ['as' => 'employer.contactPeople.destroy', 'uses' => 'Employer\ContactPersonController@destroy']);
        Route::get('account-settings/contact-person/{contactPeople}', ['as' => 'employer.contactPeople.show', 'uses' => 'Employer\ContactPersonController@show']);
        Route::get('account-settings/contact-person/{contactPeople}/edit', ['as' => 'employer.contactPeople.edit', 'uses' => 'Employer\ContactPersonController@edit']);

        Route::get('/jobs/create', ['as' => 'employer.jobs.create', 'uses' => 'Employer\EmployerController@createJob']);
        Route::post('/jobs/create', ['as' => 'employer.jobs.store', 'uses' => 'Employer\EmployerController@storeJob']);
        Route::get('/jobs/list', ['as' => 'employer.jobs.index', 'uses' => 'Employer\EmployerController@listJobs']);
        Route::get('/jobs/view/{num}', ['as' => 'employer.jobs.view', 'uses' => 'Employer\EmployerController@viewJob']);

        Route::get('account-settings/company/change-password', ['as' => 'employer.company.show_form_change_password', 'uses' => 'Employer\EmployerController@showChangePasswordForm']);

        Route::get('post-jobs/all', ['as' => 'employer.postJobs.index', 'uses' => 'Employer\PostJobController@index']);
        Route::post('post-jobs', ['as' => 'employer.postJobs.store', 'uses' => 'Employer\PostJobController@store']);
        Route::get('post-jobs/create', ['as' => 'employer.postJobs.create', 'uses' => 'Employer\PostJobController@create']);
        Route::put('post-jobs/{postJobs}', ['as' => 'employer.postJobs.update', 'uses' => 'Employer\PostJobController@update']);
        Route::patch('post-jobs/{postJobs}', ['as' => 'employer.postJobs.update', 'uses' => 'Employer\PostJobController@update']);
        Route::delete('post-jobs/{postJobs}', ['as' => 'employer.postJobs.destroy', 'uses' => 'Employer\PostJobController@destroy']);
        Route::get('post-jobs/{postJobs}', ['as' => 'employer.postJobs.show', 'uses' => 'Employer\PostJobController@show']);
        Route::get('post-jobs/{postJobs}/edit', ['as' => 'employer.postJobs.edit', 'uses' => 'Employer\PostJobController@edit']);

        Route::get('/job/update_status/disabled/{num}', ['as' => 'employer.update_job_status_disabled', 'uses' => 'Employer\EmployerController@updateJobStatus']);
        Route::get('/job/update_status/active/{num}', ['as' => 'employer.update_job_status_active', 'uses' => 'Employer\EmployerController@updateJobStatus']);
        Route::get('/job/update_status/filled_up/{num}', ['as' => 'employer.update_job_status_filled_up', 'uses' => 'Employer\EmployerController@updateJobStatus']);

        Route::get('account-settings/company/profile', ['as' => 'employer.company.profile', 'uses' => 'Employer\EmployerController@viewCompanyProfile']);
        Route::get('documents/upload/all', ['as' => 'employer.documents.upload.all', 'uses' => 'Employer\EmployerController@viewCompanyProfile']);
        Route::get('documents/upload/all', ['as' => 'employer.documents.upload.all', 'uses' => 'Employer\EmployerController@viewCompanyProfile']);

        Route::get('/documents-uploaded/list', ['as' => 'employer.documents.uploaded.index', 'uses' => 'Employer\EmployerController@showDocumentLists']);
        Route::get('/documents-uploaded/form', ['as' => 'employer.documents.uploaded.form', 'uses' => 'Employer\EmployerController@showDocumentUploadForm']);
        Route::post('/documents-uploaded/form', ['as' => 'employer.documents.uploaded.form', 'uses' => 'Employer\EmployerController@doDocumentUploadForm']);
        Route::get('/documents-uploaded/view/{id}', ['as' => 'employer.documents.uploaded.view', 'uses' => 'Employer\EmployerController@viewDocument']);
        Route::delete('/documents-uploaded/delete/{id}', ['as' => 'employer.documents.uploaded.delete', 'uses' => 'Employer\EmployerController@deleteDocument']);

    });

});