@if($results->count())
    <table class="table table-responsive" id="contactPeople-table">
        <thead>
        <tr>
            <th>#</th>
            <th>Document type</th>
            <th>Document url</th>
            <th>Description</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($results as $index => $result)
            <tr>
                <td>{!! $index + 1 !!}</td>
                <td>{!! $result->doc_type !!}</td>
                <td><img src="{!! $result->doc_url !!}" alt="{!! $result->doc_type !!}"></td>
                <td>{!! $result->description !!}</td>
                <td>
                    {!! Form::open(['route' => ['employer.contactPeople.destroy', $result->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('employer.contactPeople.show', [$result->id]) !!}"
                           class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('employer.contactPeople.edit', [$result->id]) !!}"
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