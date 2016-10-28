@if($contactPeople->count())
    <table class="table table-responsive" id="contactPeople-table">
        <thead>
        <tr>
            <th>#</th>
            <th>Contact Name</th>
            <th>Department</th>
            <th>Position</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contactPeople as $index => $contactPerson)
            <tr>
                <td>{!! $index + 1 !!}</td>
                <td>{!! $contactPerson->contact_name !!}</td>
                <td>{!! $contactPerson->department->name !!}</td>
                <td>{!! $contactPerson->position->name !!}</td>
                <td>{!! $contactPerson->phone_number !!}</td>
                <td>{!! $contactPerson->email !!}</td>
                <td>
                    {!! Form::open(['route' => ['employer.contactPeople.destroy', $contactPerson->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('employer.contactPeople.show', [$contactPerson->id]) !!}"
                           class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('employer.contactPeople.edit', [$contactPerson->id]) !!}"
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