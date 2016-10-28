<table class="table table-responsive" id="subjects-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Description</th>
        <th>Status</th>
        <th colspan="3">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($subjects as $index => $subject)
        <tr>
            <td>{!! $index + 1 !!}</td>
            <td>{!! $subject->name !!}</td>
            <td>{!! $subject->description !!}</td>
            <td>
                @if($subject->status == 1)
                    <span class="label label-success">Active</span>
                @else
                    <span class="label label-warning">Disabled</span>
                @endif
            </td>
            <td>
                {!! Form::open(['route' => ['admin.subjects.destroy', $subject->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.subjects.show', [$subject->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.subjects.edit', [$subject->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>