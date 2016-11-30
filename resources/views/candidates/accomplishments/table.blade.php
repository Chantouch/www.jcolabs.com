<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Company name</th>
        <th>Position</th>
        <th>Phone number</th>
        <th>Email</th>
        <th width="87px">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($accomplishments as $index => $accomplishment)
        <tr>
            <td>{!! $index + 1 !!}</td>
            <td>{!! $accomplishment->last_name !!}</td>
            <td>{!! $accomplishment->first_name !!}</td>
            <td>{!! $accomplishment->company_name !!}</td>
            <td>
               {!! $accomplishment->position !!}
            </td>
            <td>{!! $accomplishment->phone_number !!}</td>
            <td>{!! $accomplishment->email !!}</td>
            <td>
                {!! Form::open(['route' => ['candidate.references.destroy', $accomplishment->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('candidate.educations.show', [$accomplishment->id]) !!}"--}}
                    {{--class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('candidate.references.edit', [$accomplishment->id]) !!}"
                       class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>