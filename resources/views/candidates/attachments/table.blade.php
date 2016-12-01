<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Date</th>
        <th>Description</th>
        <th width="87px">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($accomplishments as $index => $accomplishment)
        <tr>
            <td>{!! $index + 1 !!}</td>
            <td>{!! $accomplishment->title !!}</td>
            <td>{!! $accomplishment->date !!}</td>
            <td>{!! $accomplishment->description !!}</td>
            <td>
                {!! Form::open(['route' => ['candidate.accomplishments.destroy', $accomplishment->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('candidate.educations.show', [$accomplishment->id]) !!}"--}}
                    {{--class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('candidate.accomplishments.edit', [$accomplishment->id]) !!}"
                       class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>