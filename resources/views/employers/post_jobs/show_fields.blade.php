<div class="col-sm-3">
    <!-- Post Name Field -->
    <div class="form-group">
        {!! Form::label('post_name', 'Post Name:') !!}
        <p>{!! $postJob->post_name !!}</p>
    </div>

    <!-- No Of Post Field -->
    <div class="form-group">
        {!! Form::label('no_of_post', 'No Of Post:') !!}
        <p>{!! $postJob->no_of_post !!}</p>
    </div>

    <!-- Industry  Field -->
    <div class="form-group">
        {!! Form::label('industry_id', 'Industry :') !!}
        <p>{!! $postJob->industry->name !!}</p>
    </div>

    <!-- Place Ofemployment City  Field -->
    <div class="form-group">
        {!! Form::label('place_of_employment_city_id', 'City :') !!}
        <p>{!! $postJob->city->name !!}</p>
    </div>

    <!-- Place Of Employment District  Field -->
    <div class="form-group">
        {!! Form::label('place_of_employment_district_id', 'District :') !!}
        <p>{!! $postJob->district->name !!}</p>
    </div>
</div>

<div class="col-sm-3">
    <!-- Preferred Age Min Field -->
    <div class="form-group">
        {!! Form::label('preferred_age_min', 'Age Min:') !!}
        <p>{!! $postJob->preferred_age_min !!}</p>
    </div>

    <!-- Preferred Age Max Field -->
    <div class="form-group">
        {!! Form::label('preferred_age_max', 'Age Max:') !!}
        <p>{!! $postJob->preferred_age_max !!}</p>
    </div>

    <!-- Job Sub Category Field -->
    <div class="form-group">
        {!! Form::label('category', 'Category:') !!}
        <p>{!! $postJob->category->name !!}</p>
    </div>

    <!-- Exam Passed  Field -->
    <div class="form-group">
        {!! Form::label('exam_passed_id', 'Exam Passed :') !!}
        <p>{!! $postJob->exam->name !!}</p>
    </div>

</div>

<div class="col-sm-3">
    <!-- Subject  Field -->
    <div class="form-group">
        {!! Form::label('subject_id', 'Subject :') !!}
        <p>{!! $postJob->subject->name !!}</p>
    </div>

    <!-- Specialization Field -->
    <div class="form-group">
        {!! Form::label('specialization', 'Specialization:') !!}
        <p>{!! $postJob->specialization !!}</p>
    </div>

    <!-- Preferred Experience Field -->
    <div class="form-group">
        {!! Form::label('preferred_experience', 'Preferred Experience:') !!}
        <p>{!! $postJob->preferred_experience !!}</p>
    </div>

    <!-- Physical Height Field -->
    <div class="form-group">
        {!! Form::label('physical_height', 'Physical Height:') !!}
        <p>{!! $postJob->physical_height !!}</p>
    </div>
</div>

<div class="col-sm-3">
    <!-- Physical Weight Field -->
    <div class="form-group">
        {!! Form::label('physical_weight', 'Physical Weight:') !!}
        <p>{!! $postJob->physical_weight !!}</p>
    </div>

    <!-- Physical Weight Field -->
    <div class="form-group">
        {!! Form::label('physical_weight', 'Physical Weight:') !!}
        <p>{!! $postJob->physical_weight !!}</p>
    </div>

    <!-- Description Field -->
    <div class="form-group">
        {!! Form::label('description', 'Description:') !!}
        <p>{!! $postJob->description !!}</p>
    </div>

    <!-- Created At Field -->
    <div class="form-group">
        {!! Form::label('created_at', 'Created At:') !!}
        <p>{{ date('d-m-Y h:i A', strtotime($postJob->created_at)) }}</p>
    </div>

    <!-- Updated At Field -->
    <div class="form-group">
        {!! Form::label('updated_at', 'Updated At:') !!}
        <p>{{ date('d-m-Y h:i A', strtotime($postJob->updated_at)) }}</p>
    </div>
</div>