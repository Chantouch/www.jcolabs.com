<div class="row" style="background-color: #ecf0f1; margin-bottom: 16px; padding-top: 16px;">

    <div class="col-md-6">
        <div class="form-group aug_legend">
            Personal Information:
        </div>
        <div class="form-group">
            <label for="full_name" class="control-label">Full Name :</label>
            {!! Form::text('full_name', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            <label for="spouse_name" class="control-label">Spouse Name :</label>
            {!! Form::text('spouse_name', null, ['class'=> 'form-control']) !!}
        </div>
        <div class="form-group">
            <label for="dob" class="control-label">Date of Birth :</label>
            {!! Form::text('dob', null, ['class'=> 'form-control _date']) !!}
        </div>
        <div class="form-group">
            <label for="sex" class="control-label">Gender :</label>
            {!! Form::select('sex',$gender, null, ['class'=> 'form-control']) !!}
        </div>

        <div class="form-group">
            <label for="religion" class="control-label">Religion :</label>
            {!! Form::select('religion',$religion, null, ['class'=> 'form-control']) !!}
        </div>
        <div class="form-group">
            <label for="marital_status" class="control-label">Marital Status :</label>
            {!! Form::select('marital_status',$marital_status, null, ['class'=> 'form-control']) !!}
        </div>

    </div>

    <div class="col-md-6">
        <div class="form-group aug_legend">
            Contact Information:
        </div>
        <div class="form-group">
            <label for="address" class="control-label">Address :</label>
            {!! Form::text('address', null, ['class'=> 'form-control']) !!}
        </div>
        <div class="form-group">
            <label for="city_id" class="control-label">City :</label>
            {!! Form::select('city_id',$city, null, ['class'=> 'form-control']) !!}
        </div>
        <div class="form-group">
            <label for="district_id" class="control-label">District :</label>
            {!! Form::select('district_id',$district, null, ['class'=> 'form-control']) !!}
        </div>
        <div class="form-group">
            <label for="pin_code" class="control-label">Pin code :</label>
            {!! Form::text('pin_code', null, ['class'=> 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <br/>
        <div class="col-md-12" style="padding-left: 0">
            <div class="form-group aug_legend pull-left">
                Physical Measurement:
            </div>
        </div>

        <div class="form-group">
            <label for="physical_height" class="control-label">Height :</label>
            {!! Form::text('physical_height', null, ['class'=> 'form-control']) !!}
        </div>
        <div class="form-group">
            <label for="physical_weight" class="control-label">Weight :</label>
            {!! Form::text('physical_weight', null, ['class'=> 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-12">
        <div class="col-md-12 p-l-0">
            <div class="form-group aug_legend">
                Additional Information :
            </div>
        </div>
        <div class="form-group col-md-4 p-l-0">
            <label for="proof_details_id"> Proof of Residence :</label>
            {!! Form::select('proof_details_id',$proof_residence, null, ['class'=> 'form-control']) !!}
        </div>
        <div class="form-group col-md-4 p-l-0">
            <label for="proof_no">Proof/Id No :</label>
            {!! Form::text('proof_no', null, ['class'=> 'form-control']) !!}
        </div>
        <div class="form-group col-md-4 p-l-0">
            <label for="relocated">Willing to Relocate :</label>
            {!! Form::select('relocated',$relocate, null, ['class'=> 'form-control']) !!}
        </div>

        <div class="form-group col-md-8 p-l-0">
            <label for="additional_info">Additional Info :</label>
            {!! Form::textarea('additional_info', null, ['class'=> 'form-control', 'rows'=>'4']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group aug_legend"> Photo / CV :</div>
        <div class="form-group">
            <label for="photo_url" class="control-label"> Photo :</label>
            {!! Form::file('photo_url', ['class'=> 'form-control']) !!}
        </div>
        <div class="form-group">
            <label for="cv_url" class="control-label">CV :</label>
            {!! Form::file('cv_url', ['class'=> 'form-control']) !!}
            <p class="help-block">CV format should be .doc, .docx or pdf only.</p>
        </div>
    </div>

    <div class="form-group col-sm-12 text-center">
        <button type="submit" class="my_button"> Save and Proceed to Next Step >></button>
    </div>

</div>