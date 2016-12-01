<div class="row" style="background-color: #ECF0F1;">
    <div id="edu_details" class="col-md-12 aug_group">
        <div class="form-group aug_legend"> Education Details :</div>
        <div class="_details">
            <div class="form-group col-md-6">
                <label for="name" class="control-label"> Name: </label>
                {!! Form::text('name[]', null, ['class'=>'title form-control input']) !!}
            </div>

            <div class="form-group col-md-6">
                <label for="file" class="control-label"> Attachments:</label>
                {!! Form::file('file[]', ['class'=>'date form-control input']) !!}
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