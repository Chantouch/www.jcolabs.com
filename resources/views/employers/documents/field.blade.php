<div class="form-group col-sm-6">
    {!! Form::label('doc_type', 'Doc Type:') !!}
    {!! Form::select('doc_type', $doc_types, null, array('class' => 'form-control')) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('doc_url', 'File:') !!}
    {!! Form::file('doc_url', array('class' => 'form-control')) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, array('class' => 'form-control')) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('employer.documents.uploaded.index') !!}" class="btn btn-default">Cancel</a>
</div>