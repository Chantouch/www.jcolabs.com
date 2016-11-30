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
    @foreach($references as $index => $reference)
        <tr>
            <td>{!! $index + 1 !!}</td>
            <td>{!! $reference->last_name !!}</td>
            <td>{!! $reference->first_name !!}</td>
            <td>{!! $reference->company_name !!}</td>
            <td>
               {!! $reference->position !!}
            </td>
            <td>{!! $reference->phone_number !!}</td>
            <td>{!! $reference->email !!}</td>
            <td>
                {!! Form::open(['route' => ['candidate.references.destroy', $reference->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('candidate.educations.show', [$reference->id]) !!}"--}}
                    {{--class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('candidate.references.edit', [$reference->id]) !!}"
                       class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>