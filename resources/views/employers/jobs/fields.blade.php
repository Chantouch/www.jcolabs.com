<!-- Contact Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('post_name', 'Post Name:') !!}
    {!! Form::text('post_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('no_of_post', 'No Of Post:') !!}
    {!! Form::text('no_of_post', null, ['class' => 'form-control']) !!}
</div>

<!-- Department Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('industry_id', 'Industry:') !!}
    {!! Form::select('industry_id', $industries, null, array('class' => 'form-control')) !!}
</div>

<!-- Position Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('place_of_employment_city_id', 'Place Of Employment City:') !!}
    {!! Form::select('place_of_employment_city_id', $cities, null, array('class' => 'form-control')) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('place_of_employment_district_id', 'Place Of Employment District:') !!}
    {!! Form::select('place_of_employment_district_id', $districts, null, array('class' => 'form-control')) !!}
</div>

<!-- Phone Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('preferred_age_min', 'Preferred Age Min:') !!}
    {!! Form::text('preferred_age_min', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('preferred_age_max', 'Preferred Age Max:') !!}
    {!! Form::text('preferred_age_max', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('job_sub_category', 'Job Sub Category:') !!}
    {!! Form::select('job_sub_category', $subjects, null, array('class' => 'form-control')) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('preferred_caste', 'Preferred Caste:') !!}
    {!! Form::select('preferred_caste', $subjects, null, array('class' => 'form-control')) !!}
</div>

{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('preferred_sex', 'Preferred Sex:') !!}--}}
    {{--{!! Form::select('preferred_sex', \Illuminate\Support\Facades\Config::get('enum.sex'), null, array('class' => 'form-control')) !!}--}}
{{--</div>--}}

{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('job_type', 'Job Type:') !!}--}}
    {{--{!! Form::select('job_type', \Illuminate\Support\Facades\Config::get('enum.job_types'), null, array('class' => 'form-control')) !!}--}}
{{--</div>--}}

<div class="form-group col-sm-6">
    {!! Form::label('exam_passed_id', 'Exam Passed:') !!}
    {!! Form::select('exam_passed_id', $exams, null, array('class' => 'form-control')) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('subject_id', 'Subject:') !!}
    {!! Form::select('subject_id', $subjects, null, array('class' => 'form-control')) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('specialization', 'Specialization:') !!}
    {!! Form::text('specialization', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('preferred_experience', 'Preferred Experience:') !!}
    {!! Form::text('preferred_experience', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('ex_service', 'Ex Service:') !!}
    {!! Form::select('ex_service', $subjects, null, array('class' => 'form-control')) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('physical_challenge', 'Physical Challenge:') !!}
    {!! Form::select('physical_challenge', $subjects, null, array('class' => 'form-control')) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('physical_height', 'Physical Height:') !!}
    {!! Form::text('physical_height', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('physical_weight', 'Physical Weight:') !!}
    {!! Form::text('physical_weight', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('physical_chest', 'Physical Chest:') !!}
    {!! Form::text('physical_chest', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('physical_weight', 'Physical Weight:') !!}
    {!! Form::text('physical_weight', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('employer.jobs.index') !!}" class="btn btn-default">Cancel</a>
</div>
