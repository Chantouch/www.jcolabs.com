<div class="row" style="background-color: #ECF0F1;">
    <div id="edu_details" class="col-md-12 aug_group">
        <div class="form-group aug_legend"> Education Details :</div>
        <div class="_details">
            <div class="form-group col-md-4">
                <label for="school_university_name" class="control-label"> University Name: </label>
                {!! Form::text('name[]', null, ['class'=>'university_name form-control input']) !!}
            </div>

            <div class="form-group col-md-2">
                <label for="can_read" class="control-label">Read :</label>
                {!! Form::select('read[]', $level, null, ['class'=>'form-control', 'required']) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="can_write" class="control-label">Write :</label>
                {!! Form::select('write[]', $level, null, ['class'=>'form-control', 'required']) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="can_speak" class="control-label">Speak :</label>
                {!! Form::select('speak[]', $level, null, ['class'=>'form-control', 'required']) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="can_speak_fluently" class="control-label">Listen :</label>
                {!! Form::select('listen[]', $level, null, ['class'=>'form-control', 'required']) !!}
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