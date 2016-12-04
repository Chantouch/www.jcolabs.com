@if($expired->count())
    <table class="table table-responsive" id="jobs-table">
        <thead>
        <tr>
            <th>#</th>
            <th>Job Name</th>
            <th>Department</th>
            <th>Position</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($expired as $index => $job)
            <tr>
                <td>{!! $index + 1 !!}</td>
                <td>{!! $job->post_name !!}</td>
                <td>{!! $job->created_by !!}</td>
                <td>{!! $job->salary_offered_max !!}</td>
                <td>{!! $job->job_sub_category !!}</td>
                <td>{!! $job->job_type !!}</td>
                <td>
                    {!! Form::open(['method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="#" class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="#" class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $expired->render() !!}
@else
    <p class="text-center">No records found</p>
@endif