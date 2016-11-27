<div class="row" style="background-color: #ECF0F1;">
    <div id="edu_details" class="col-md-12 aug_group">
        <div class="form-group aug_legend"> Education Details :</div>
        <div class="_details">
            <div class="form-group col-md-6">
                <label for="school_university_name" class="control-label"> University Name: </label>
                {!! Form::text('school_university_name[]', null, ['class'=>'university_name form-control input']) !!}
            </div>

            <div class="form-group col-md-6">
                <label for="degree_level" class="control-label"> Degree/Level:</label>
                {!! Form::select('degree_level[]', $degree_level, null, ['class'=>'degree_level form-control input']) !!}
            </div>

            <div class="form-group col-md-6{!! $errors->has('start_date[]') ? ' has-error' : '' !!}">
                <label for="start_date" class="control-label">Start date:</label>
                {!! Form::text('start_date[]', null, ['class'=>'start_date form-control input', 'data-date-format' => 'yyyy-m-d']) !!}
            </div>

            <div class="form-group col-md-6">
                <label for="end_date" class="control-label">End date:</label>
                <label for="end_date" class="control-label" style="float: right">
                    I'm currently learning here {!! Form::hidden('is_studying[]', '0', false) !!}
                    {!! Form::checkbox('is_studying[]', '1', null, ['id'=>'is_studying', 'checked']) !!}</label>
                {!! Form::date('end_date[]', null, ['class'=>'end_date form-control input', 'id' => 'end_date', 'disabled']) !!}
            </div>

            <div class="form-group col-md-6">
                <label for="field_of_study" class="control-label">Field of study:</label>
                {!! Form::text('field_of_study[]', null, ['class'=>'form-control input']) !!}
            </div>

            <div class="form-group col-md-6">
                <label for="country_name" class="control-label">Country:</label>
                {!! Form::text('country_name[]', null, ['class'=>'form-control input']) !!}
            </div>
            <div class="form-group col-md-6">
                <label for="city_id" class="control-label">City:</label>
                {!! Form::text('city_id[]', null, ['class'=>'form-control input']) !!}
            </div>

            <div class="form-group col-md-6">
                <label for="grade" class="control-label">Grade:</label>
                {!! Form::text('grade[]', null, ['id'=>'grade', 'class' => 'form-control input']) !!}
            </div>

            <div class="form-group col-md-12">
                <label for="description" class="control-label">Description:</label>
                {!! Form::textarea('description[]', null, ['id'=>'description', 'class' => 'form-control textarea']) !!}
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
            <button type="submit" class="btn btn-lg my_button">Save</button>
        </div>
    </div>
</div>