<div class="row" style="background-color: #ECF0F1;">
    <div id="edu_details" class="col-md-12 aug_group">
        <div class="form-group aug_legend"> Experience Details :</div>
        <div class="_details">
            <div class="form-group col-md-6">
                <label for="job_title" class="control-label"> Job Title: </label>
                {!! Form::text('job_title[]', null, ['class'=>'job_title form-control input']) !!}
            </div>
            <div class="form-group col-md-6">
                <label for="job_title" class="control-label"> Company name: </label>
                {!! Form::text('company_name[]', null, ['class'=>'job_title form-control input']) !!}
            </div>

            <div class="form-group col-md-6">
                <label for="can_read" class="control-label">Start Date :</label>
                {!! Form::text('start_date[]', null, ['class'=>'form-control input','id' => 'start_date']) !!}
            </div>
            <div class="form-group col-md-6">
                <label for="end_date" class="control-label">End date:</label>
                <label for="end_date" class="control-label" style="float: right">
                    I'm currently working here {!! Form::hidden('is_working[]', '0', false) !!}
                    {!! Form::checkbox('is_working[]', '1', null, ['id'=>'is_working', 'checked']) !!}</label>
                {!! Form::text('end_date[]', null, ['class'=>'end_date form-control input', 'id' => 'end_date', 'disabled']) !!}
            </div>
            <div class="form-group col-md-4">
                <label for="can_speak" class="control-label">Country :</label>
                {!! Form::text('country[]', null, ['class'=>'form-control input']) !!}
            </div>
            <div class="form-group col-md-4">
                <label for="can_speak_fluently" class="control-label">City :</label>
                {!! Form::select('city_id[]', $cities, null, ['class'=>'form-control input']) !!}
            </div>
            <div class="form-group col-md-4">
                <label for="can_speak_fluently" class="control-label">Contract :</label>
                {!! Form::select('contract_type[]', $contract_type, null, ['class'=>'form-control input']) !!}
            </div>
            <div class="form-group col-md-4">
                <label for="can_speak" class="control-label">Industry :</label>
                {!! Form::select('industry_id[]', $sectors, null, ['class'=>'form-control input']) !!}
            </div>
            <div class="form-group col-md-4">
                <label for="can_speak_fluently" class="control-label">Job Role :</label>
                {!! Form::select('department_id[]', $departments, null, ['class'=>'form-control input']) !!}
            </div>
            <div class="form-group col-md-4">
                <label for="can_speak_fluently" class="control-label">Career Level :</label>
                {!! Form::select('career_level[]', $career_level, null, ['class'=>'form-control input']) !!}
            </div>
            <div class="form-group col-md-12">
                <label for="can_speak_fluently" class="control-label">Description :</label>
                {!! Form::textarea('description[]', null, ['class'=>'form-control', 'cols'=>'15', 'rows'=>'7']) !!}
            </div>

        </div>
    </div>

    <div class="col-md-12">
        <div class="col-md-12">
            <div class="form-group">
                <button id="add" class="btn btn-sm" type="button"><i class="fa fa-plus"></i> Add New
                </button>
                <button id="minus" class="btn btn-sm" type="button"><i class="fa fa-minus"></i> Remove
                </button>
            </div>
        </div>
    </div>
    <div class="form-group col-sm-12">
        {{--<div class="spacer-1"></div>--}}
        <div class="col-md-12">
            <button type="submit" class="btn btn-lg my_button btn-green">Save</button>
        </div>
    </div>
</div>