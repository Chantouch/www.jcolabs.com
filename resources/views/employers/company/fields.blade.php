<div class="box box-primary">
    <div class="box-body">
        <div class="col-md-6">
            <div class="form-group">
                <label for="id" class="control-label">Company ID:</label>
                <input type="text" class="form-control" value="{!! $profile->id !!}" disabled>
            </div>
            <div class="form-group">
                <label for="organization_name" class="control-label">Company name:</label>
                {!! Form::text('organization_name', null, array('class'=>'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="organisation_email" class="control-label">Company email:</label>
                {!! Form::email('organisation_email', null, array('class'=>'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="photo" class="control-label">Logo:</label>
                {!! Form::file('photo', array('class'=>'form-control','id'=>'photo')) !!}
                <img src="{!! asset('uploads/employers/profile/'.Auth::guard('employer')->user()->id.'/'.$profile->photo) !!}"
                     alt="{!! $profile->organization_name !!}" id="c_profile_preview"
                     class="img-responsive">
            </div>
            <div class="form-group">
                <label for="sector" class="control-label">Organization Sector:</label>
                {!! Form::select('organization_sector',$organization_sector, null, array('class'=>'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="sector" class="control-label">Industry:</label>
                {!! Form::select('industry_id',$industries, null, array('class'=>'form-control')) !!}
            </div>

            <div class="form-group">
                <label for="employees" class="control-label">Employees:</label>
                {!! Form::text('employees', null, array('class'=>'form-control')) !!}
            </div>

        </div>
        <div class="col-md-6">
            <div class="col-md-3" style="padding-left: 0">
                <div class="form-group">
                    <label for="phone_no_ext" class="control-label">Prefix:</label>
                    {!! Form::text('phone_no_ext', null, array('class'=>'form-control')) !!}
                </div>
            </div>
            <div class="col-md-9" style="padding-left: 0; padding-right: 0">
                <div class="form-group">
                    <label for="phone_no_main" class="control-label">Mobile phone:</label>
                    {!! Form::text('phone_no_main', null, array('class'=>'form-control')) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="control-label">Description:</label>
                {!! Form::textarea('details', null, array('class'=>'form-control', 'rows'=>'5')) !!}
            </div>
            <div class="form-group">
                <label for="services" class="control-label">Services:</label>
                {!! Form::textarea('services', null, array('class'=>'form-control', 'rows'=>'4')) !!}
            </div>
            <div class="form-group">
                <label for="products" class="control-label">Products:</label>
                {!! Form::textarea('products', null, array('class'=>'form-control', 'rows'=>'4')) !!}
            </div>
            <div class="form-group">
                <label for="web_address" class="control-label">Website:</label>
                {!! Form::text('web_address', 'http://www.', array('class'=>'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="address" class="control-label">Address:</label>
                {!! Form::textarea('address', null, array('class'=>'form-control','rows'=>'3')) !!}
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
        <div class="col-md-6">
            <div class="col-md-3" style="padding-left: 0">
                <div class="form-group">
                    {!! Form::label('contact_designation', 'Prefix:') !!}
                    {!! Form::text('contact_designation', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-9" style="padding-left: 0; padding-right: 0">
                <div class="form-group">
                    {!! Form::label('contact_name', 'Contact Name:') !!}
                    {!! Form::text('contact_name', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('contact_mobile_no', 'Mobile Contact:') !!}
                {!! Form::text('contact_mobile_no', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('contact_email', 'Contact Email:') !!}
                {!! Form::text('contact_email', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Position', 'Position:') !!}
                {!! Form::select('position_id', $position, null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <!-- Submit Field -->
        <div class="form-group col-sm-12">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            <a href="{!! route('employer.company.profile') !!}" class="btn btn-default">Cancel</a>
        </div>
    </div>
</div>
