<table class="table table-responsive" id="exams-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Category</th>
        <th>Description</th>
        <th>Status</th>
        <th colspan="3">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($exams as $index => $exam)
        <tr>
            <td>{!! $index + 1 !!}</td>
            <td>{!! $exam->name !!}</td>
            <td>{!! $exam->exam_category !!}</td>
            <td>{!! $exam->description !!}</td>
            <td>
                @if($exam->status == 1)
                    <span class="label label-success">Active</span>
                @else
                    <span class="label label-warning">Disabled</span>
                @endif
            </td>
            <td>
                {!! Form::open(['route' => ['admin.exams.destroy', $exam->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.exams.show', [$exam->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.exams.edit', [$exam->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>