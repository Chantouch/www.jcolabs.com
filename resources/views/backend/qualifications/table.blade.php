<table class="table table-responsive" id="qualifications-table">
    <thead>
        <th>Name</th>
        <th>Description</th>
        <th>Status</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($qualifications as $qualification)
        <tr>
            <td>{!! $qualification->name !!}</td>
            <td>{!! $qualification->description !!}</td>
            <td>{!! $qualification->status !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.qualifications.destroy', $qualification->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.qualifications.show', [$qualification->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.qualifications.edit', [$qualification->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>