@if($postJobs->count())
    <table class="table table-responsive" id="postJobs-table">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>No</th>
            <th>Industry</th>
            <th class="hidden-sm">City </th>
            <th>Function</th>
            <th>Experience</th>
            <th>Description</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($postJobs as $postJob)
            <tr>
                <td>
                    <a href="{!! route('employer.jobs.view', Hashids::encode($postJob->id))!!}"># {{ $postJob->emp_job_id }}</a>
                </td>
                <td>{!! \Illuminate\Support\Str::limit($postJob->post_name, 25) !!}</td>
                <td>{!! $postJob->no_of_post !!}</td>
                <td>{!! $postJob->industry->name !!}</td>
                <td class="hidden-sm">{!! $postJob->city->name !!}</td>
                <td>{!! $postJob->category->name !!}</td>
                <td>{!! $postJob->preferred_experience !!} year (s)</td>
                <td>{!! \Illuminate\Support\Str::limit($postJob->description, 30) !!}</td>
                <td>
                    {!! Form::open(['route' => ['employer.postJobs.destroy', $postJob->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('employer.postJobs.show', [$postJob->slug]) !!}"
                           class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('employer.postJobs.edit', [$postJob->id]) !!}"
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
    <p>There is no job, please post your job.</p>
@endif