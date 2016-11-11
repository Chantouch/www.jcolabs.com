@if($brands->count())
    <table class="table table-responsive" id="contactPeople-table">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Categories</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($brands as $index => $brand)
            <tr>
                <td>{!! $index + 1 !!}</td>
                <td>{!! $brand->name !!}</td>
                <td>{!! $brand->name !!}</td>
                <td>
                    {!! Form::open(['route' => ['employer.contactPeople.destroy', $brand->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('employer.contactPeople.show', [$brand->id]) !!}"
                           class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('employer.contactPeople.edit', [$brand->id]) !!}"
                           class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <p>No records found</p>
@endif