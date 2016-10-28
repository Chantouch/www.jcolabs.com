<table class="table table-responsive" id="departmentTypes-table">
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
    @foreach($departmentTypes as $index => $departmentType)
        <tr>
            <td>Dep-{!! $index + 1 !!}</td>
            <td>{!! $departmentType->name !!}</td>
            <td>{!! $departmentType->description !!}</td>
            <td>
                @if($departmentType->status == 1)
                    <span class="label label-success">Active</span>
                @else
                    <span class="label label-warning">Disabled</span>
                @endif
            </td>
            <td>
                {!! Form::open(['route' => ['admin.departmentTypes.destroy', $departmentType->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.departmentTypes.show', [$departmentType->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.departmentTypes.edit', [$departmentType->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>