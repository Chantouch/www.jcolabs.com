<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $contactPerson->id !!}</p>
</div>

<!-- Contact Name Field -->
<div class="form-group">
    {!! Form::label('contact_name', 'Contact Name:') !!}
    <p>{!! $contactPerson->contact_name !!}</p>
</div>

<!-- Department Id Field -->
<div class="form-group">
    {!! Form::label('department_id', 'Department Id:') !!}
    <p>{!! $contactPerson->department_id !!}</p>
</div>

<!-- Position Id Field -->
<div class="form-group">
    {!! Form::label('position_id', 'Position Id:') !!}
    <p>{!! $contactPerson->position_id !!}</p>
</div>

<!-- Phone Number Field -->
<div class="form-group">
    {!! Form::label('phone_number', 'Phone Number:') !!}
    <p>{!! $contactPerson->phone_number !!}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{!! $contactPerson->email !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $contactPerson->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $contactPerson->updated_at !!}</p>
</div>

