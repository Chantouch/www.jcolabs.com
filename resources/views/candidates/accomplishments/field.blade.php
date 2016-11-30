<div class="row" style="background-color: #ECF0F1;">
    <div id="edu_details" class="col-md-12 aug_group">
        <div class="form-group aug_legend"> Education Details :</div>
        <div class="_details">
            <div class="form-group col-md-6">
                <label for="title" class="control-label"> Title: </label>
                {!! Form::text('title[]', null, ['class'=>'title form-control input']) !!}
            </div>

            <div class="form-group col-md-6">
                <label for="date" class="control-label"> Date:</label>
                {!! Form::text('date[]', null, ['class'=>'date form-control input']) !!}
            </div>

            <div class="form-group col-md-12{!! $errors->has('start_date[]') ? ' has-error' : '' !!}">
                <label for="company_name" class="control-label">Description:</label>
                {!! Form::textarea('description[]', null, ['class'=>'description form-control', 'id'=>'first_name', 'rows'=>'5']) !!}
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
            <a href="{!! route('candidate.dashboard') !!}" class="my_button"><i class="fa fa-backward"></i>
                <span> Back</span></a>
        </div>
    </div>
</div>