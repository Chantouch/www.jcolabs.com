<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Level</th>
        <th>Year Experience</th>
        <th width="87px">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($professionals as $index => $professional)
        <tr>
            <td>{!! $index + 1 !!}</td>
            <td>{!! $professional->name !!}</td>
            <td>{!! $professional->level !!}</td>
            <td>{!! $professional->year_experience !!}</td>
            <td>
                {!! Form::open(['route' => ['candidate.professionals.destroy', $professional->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('candidate.edu.details.show', [$professional->id]) !!}"--}}
                    {{--class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('candidate.professionals.edit', [$professional->id]) !!}"
                       class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>