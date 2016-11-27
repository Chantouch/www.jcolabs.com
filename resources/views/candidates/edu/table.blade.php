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
    @foreach($edu as $index => $education)
        <tr>
            <td>{!! $index + 1 !!}</td>
            <td>{!! $education->school_university_name !!}</td>
            <td>{!! $education->degree_level !!}</td>
            <td>{!! $education->start_date !!}</td>
            <td>
                @if($education->is_studying == "1")
                    <span>Present</span>
                @else
                    <span>{!! $education->end_date !!}</span>
                @endif
            </td>
            <td>{!! $education->country_name !!}</td>
            <td>{!! $education->field_of_study !!}</td>
            <td>{!! $education->grade !!}</td>
            <td class="hidden-md hidden-sm hidden-xs">{!! $education->description !!}</td>
            <td>
                {!! Form::open(['route' => ['candidate.edu.details.destroy', $education->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('candidate.edu.details.show', [$education->id]) !!}"--}}
                    {{--class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('candidate.edu.details.edit', [$education->id]) !!}"
                       class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>