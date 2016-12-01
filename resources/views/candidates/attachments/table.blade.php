<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>File</th>
        <th>Created</th>
        <th width="87px">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($attachments as $index => $attachment)
        <tr>
            <td>{!! $index + 1 !!}</td>
            <td>{!! $attachment->name !!}</td>
            <td>{!! $attachment->file !!}</td>
            <td>{!! $attachment->created_date !!}</td>
            <td>
                {!! Form::open(['route' => ['candidate.attachments.destroy', $attachment->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('candidate.educations.show', [$attachment->id]) !!}"--}}
                    {{--class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('candidate.attachments.edit', [$attachment->id]) !!}"
                       class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>