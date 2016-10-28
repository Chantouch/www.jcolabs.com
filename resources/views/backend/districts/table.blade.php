<table class="table table-responsive" id="districts-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Districts</th>
        <th>City</th>
        <th>Description</th>
        <th>Status</th>
        <th colspan="3">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($districts as $index => $district)
        <tr>
            <td>{!! $index + 1 !!}</td>
            <td>{!! $district->name !!}</td>
            <td>{!! $district->city->name !!}</td>
            <td>{!! $district->description !!}</td>
            <td>
                @if($district->status == 1)
                    <span class="label label-success">Active</span>
                @else
                    <span class="label label-warning">Disabled</span>
                @endif
            </td>
            <td>
                {!! Form::open(['route' => ['admin.districts.destroy', $district->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.districts.show', [$district->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.districts.edit', [$district->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $districts->render() !!}