<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Job Description</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <!-- Post Name Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('post_name', 'Post Name:') !!}
                {!! Form::text('post_name', null, ['class' => 'form-control', 'autofocus']) !!}
            </div>

            <!-- No Of Post Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('no_of_post', 'Number of Hiring:') !!}
                {!! Form::text('no_of_post', null, ['class' => 'form-control']) !!}
            </div>

            <!--Publish date Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('published_date', 'Published Date:') !!}
                {!! Form::text('published_date', $publish_date, ['class' => 'form-control', 'placeholder' => 'dd-M-yyyy']) !!}
            </div>

            <!--Closing date Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('closing_date', 'Closing Date:') !!}
                {!! Form::text('closing_date', null, ['class' => 'form-control', 'placeholder'=>'dd-M-yyyy']) !!}
            </div>

            <!-- Industry Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('industry_id', 'Industry:') !!}
                {!! Form::select('industry_id', $industries, null, array('class' => 'form-control','placeholder'=>'--Select Industry--')) !!}

            </div>

            <!-- Job Sub Category Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('category_id', 'Function:') !!}
                {!! Form::select('category_id',$job_categories, null, ['class' => 'form-control','placeholder'=>'--Select function--']) !!}
            </div>

            <!-- Place Of employment City Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('place_of_employment_city_id', 'City:') !!}
                {!! Form::select('place_of_employment_city_id',$cities , null, ['class' => 'form-control place_of_employment_city_id','placeholder'=>'--Choose City--']) !!}
            </div>

            <!-- Place Of Employment District Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('place_of_employment_district_id', 'District:') !!}
                {!! Form::select('place_of_employment_district_id',$districts , null, ['class' => 'form-control place_of_employment_district_id','placeholder' => '--Select City--']) !!}
            </div>

            <!-- Salary offer Min Field -->
            <div class="form-group col-sm-6" id="salary_min">
                {!! Form::label('salary_offered_min', 'Salary Offered Min:') !!}
                {!! Form::text('salary_offered_min', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Salary offer Max Field -->
            <div class="form-group col-sm-6" id="salary_max">
                {!! Form::label('salary_offered_max', 'Salary Offered Max:') !!}
                {!! Form::text('salary_offered_max', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Negotiable Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('is_negotiable', 'Negotiable:') !!}
                <label class="checkbox-inline">
                    {!! Form::hidden('is_negotiable', false) !!}
                    {!! Form::checkbox('is_negotiable', '1', null) !!} 1
                </label>
            </div>

            <!-- Description Field -->
            <div class="form-group col-sm-12 col-lg-12">
                {!! Form::label('description', 'Description:') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control textarea', 'rows'=>'5']) !!}
            </div>

        </div>
    </div>
</div>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Job Requirements</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <!-- Job types Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('level', 'Level:') !!}
                {!! Form::select('level',$job_levels , null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('job_type', 'Job type:') !!}
                {!! Form::select('job_type',$job_types , null, ['class' => 'form-control']) !!}
            </div>

            <!-- Preferred Experience Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('preferred_experience', 'Preferred Experience:') !!}
                {!! Form::text('preferred_experience', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Exam Passed Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('qualification_id', 'Qualification:') !!}
                {!! Form::select('qualification_id', $qualifications, null, ['class' => 'form-control','placeholder'=>'--Select Qualification--']) !!}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('field_of_study', 'Field of Study:') !!}
                {!! Form::select('field_of_study', $exams, null, ['class' => 'form-control']) !!}
            </div>

            <!-- Subject Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('subject_id', 'Subject:') !!}
                {!! Form::select('subject_id', $subjects, null, ['class' => 'form-control', 'placeholder'=>'--Select Subject--']) !!}
            </div>

            <!-- Specialization Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('specialization', 'Specialization:') !!}
                {!! Form::text('specialization', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Languages fields-->
            <div class="form-group col-sm-6">
                {!! Form::label('languages[]', 'Language:') !!}
                {!! Form::select('languages_id[]', $lang, null, ['class' => 'form-control', 'multiple'=>'multiple', 'id'=>'language_id']) !!}
            </div>

            <!-- Job types Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('preferred_sex', 'Preferred Sex:') !!}
                {!! Form::select('preferred_sex', $genders , null, ['class' => 'form-control']) !!}
            </div>

            <!-- Preferred Age Min Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('preferred_age_min', 'Preferred Age Min:') !!}
                {!! Form::text('preferred_age_min', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Preferred Age Max Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('preferred_age_max', 'Preferred Age Max:') !!}
                {!! Form::text('preferred_age_max', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Physical Height Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('physical_height', 'Physical Height:') !!}
                {!! Form::text('physical_height', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Physical Weight Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('physical_weight', 'Physical Weight:') !!}
                {!! Form::text('physical_weight', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Description Field -->
            <div class="form-group col-sm-12 col-lg-12">
                {!! Form::label('requirement_description', 'Description:') !!}
                {!! Form::textarea('requirement_description', null, ['class' => 'form-control textarea', 'rows'=>'5']) !!}
            </div>
        </div>
    </div>
</div>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Contact Information</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <!-- Contact Person Field -->
            <div class="form-group col-sm-12 col-lg-12">
                {!! Form::label('contact_person_id', 'Contact Person:') !!}
                {!! Form::select('contact_person_id',$contact_person, null, ['class' => 'form-control']) !!}
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('contact_name', 'Contact Name:') !!}
                    {!! Form::text('contact_name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('phone_number', 'Phone Number:') !!}
                    {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('web_address', 'Website:') !!}
                    {!! Form::text('web_address', $emp->web_address, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('department_id', 'Department Name:') !!}
                    {!! Form::text('department_id', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email:') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('address', 'Address:') !!}
                    {!! Form::text('address', $emp->address, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <div class="row">
            <!-- Submit Field -->
            <div class="form-group col-sm-12">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{!! route('employer.postJobs.index') !!}" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </div>
</div>
