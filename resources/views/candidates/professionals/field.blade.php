<div class="row" style="background-color: #ECF0F1;">
    <div id="edu_details" class="col-md-12 aug_group">
        <div class="form-group aug_legend"> Professional Details :</div>
        <div class="_details">
            <div class="form-group col-md-4">
                <label for="name" class="control-label"> Name: </label>
                {!! Form::text('name[]', null, ['class'=>'form-control input']) !!}
            </div>

            <div class="form-group col-md-4">
                <label for="level" class="control-label"> Level:</label>
                {!! Form::select('level[]', $level, null, ['class'=>'level form-control input']) !!}
            </div>

            <div class="form-group col-md-4{!! $errors->has('start_date[]') ? ' has-error' : '' !!}">
                <label for="year_experience" class="control-label">Years:</label>
                {!! Form::select('year_experience[]', $experience, null, ['class'=>'year_experience form-control input', 'data-date-format' => 'yyyy-m-d','id'=>'start_date']) !!}
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
            <button type="submit" class="my_button"><i class="fa fa-save"></i> Save</button>
            <a href="{!! route('candidate.dashboard') !!}" class="my_button"><i class="fa fa-backward"></i> <span> Back</span></a>
        </div>
    </div>
</div>