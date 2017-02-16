<table class="table table-responsive" id="companyTypes-table">
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
    @foreach($companyTypes as $index => $companyType)
        <tr>
            <td>{!! $index + 1 !!}</td>
            <td>{!! $companyType->name !!}</td>
            <td>{!! $companyType->description !!}</td>
            <td>
                @if($companyType->status != '1')
                    <span class="label label-danger">Disabled</span>
                @else
                    <span class="label label-success">Active</span>
                @endif
            </td>
            <td>
                {!! Form::open(['route' => ['admin.companyTypes.destroy', $companyType->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.companyTypes.show', [$companyType->id]) !!}"
                       class='btn btn-default btn-xs'>
                        <i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.companyTypes.edit', [$companyType->id]) !!}"
                       class='btn btn-default btn-xs'>
                        <i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>