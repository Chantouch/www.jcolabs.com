<div class="row" style="background-color: #ECF0F1;">
    <div id="edu_details" class="col-md-12 aug_group">
        <div class="form-group aug_legend"> Education Details :</div>
        <div class="_details">
            <div class="form-group col-md-6">
                <label for="first_name" class="control-label"> First Name: </label>
                {!! Form::text('first_name[]', null, ['class'=>'first_name form-control input']) !!}
            </div>

            <div class="form-group col-md-6">
                <label for="degree_level" class="control-label"> Last Name:</label>
                {!! Form::text('last_name[]', null, ['class'=>'last_name form-control input']) !!}
            </div>

            <div class="form-group col-md-6{!! $errors->has('start_date[]') ? ' has-error' : '' !!}">
                <label for="company_name" class="control-label">Company name:</label>
                {!! Form::text('company_name[]', null, ['class'=>'company_name form-control input', 'id'=>'first_name']) !!}
            </div>

            <div class="form-group col-md-6">
                <label for="position" class="control-label">Position:</label>
                {!! Form::text('position[]', null, ['class'=>'position form-control input', 'id' => 'position']) !!}
            </div>

            <div class="form-group col-md-6">
                <label for="phone_number" class="control-label">Phone number:</label>
                {!! Form::text('phone_number[]', null, ['class'=>'form-control input']) !!}
            </div>

            <div class="form-group col-md-6">
                <label for="email" class="control-label">Email:</label>
                {!! Form::text('email[]', null, ['class'=>'form-control input']) !!}
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