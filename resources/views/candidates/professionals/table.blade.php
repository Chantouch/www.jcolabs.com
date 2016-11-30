<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>School name</th>
        <th>Degree</th>
        <th width="100px">Start date</th>
        <th width="100px">End date</th>
        <th>Country</th>
        <th width="150px">Field of Study</th>
        <th>Grade</th>
        <th class="hidden-md hidden-sm hidden-xs">Description</th>
        <th width="87px">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($professionals as $index => $professional)
        <tr>
            <td>{!! $index + 1 !!}</td>
            <td>{!! $professional->school_university_name !!}</td>
            <td>{!! $professional->degree_level !!}</td>
            <td>{!! $professional->start_date !!}</td>
            <td>
                @if($professional->is_studying == "1")
                    <span>Present</span>
                @else
                    <span>{!! $professional->end_date !!}</span>
                @endif
            </td>
            <td>{!! $professional->country_name !!}</td>
            <td>{!! $professional->field_of_study !!}</td>
            <td>{!! $professional->grade !!}</td>
            <td class="hidden-md hidden-sm hidden-xs">{!! $professional->description !!}</td>
            <td>
                {!! Form::open(['route' => ['candidate.edu.details.destroy', $professional->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('candidate.edu.details.show', [$professional->id]) !!}"--}}
                    {{--class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('candidate.edu.details.edit', [$professional->id]) !!}"
                       class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>