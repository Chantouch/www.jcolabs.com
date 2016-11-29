<table class="table table-bordered">
    <thead>
    <tr>
        <th width="50px">#</th>
        <th>Company Name</th>
        <th>Job Title</th>
        <th>Level</th>
        <th>Contract Type</th>
        <th>Country</th>
        <th width="87px">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($experiences as $index => $experience)
        <tr>
            <td>{!! $index + 1 !!}</td>
            <td>
                {!! $experience->company_name !!}
            </td>
            <td>
                <span>{!! $experience->job_title !!}</span>
            </td>
            <td>
                <span>{!! $experience->career_level !!}</span>
            </td>
            <td>
                <span>{!! $experience->contract_type !!}</span>
            </td>
            <td>
                <span>{!! $experience->country !!}</span>
            </td>
            <td>
                {!! Form::open(['route' => ['candidate.experiences.details.delete', $experience->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('candidate.edu.details.show', [$experience->id]) !!}"--}}
                    {{--class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('candidate.experiences.details.edit', [$experience->id]) !!}"
                       class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>