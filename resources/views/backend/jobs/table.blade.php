<table class="table table-responsive" id="languages-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Organization name</th>
        <th>Employer</th>
        <th>Industry</th>
        <th>Contact person</th>
        <th>Status</th>
        {{--<th colspan="3">Action</th>--}}
    </tr>
    </thead>
    <tbody>
    @foreach($jobs as $index => $job)
        <tr>
            <td>{!! $index + 1 !!}</td>
            <td>{!! $job->post_name !!}</td>
            <td>{!! $job->employer->organization_name !!}</td>
            <td>{!! $job->employer->contact_name !!}</td>
            <td>{!! $job->industry->name !!}</td>
            <td>{!! $job->contact_person->contact_name !!}</td>
            <td>
                @if($job->status == 1)
                    <span class="label label-success">Active</span>
                @elseif($job->status == 0)
                    <span class="label label-danger">Disabled</span>
                @else
                    <span class="label label-warning">Filled up</span>
                @endif
            </td>
            {{--<td>--}}
            {{--{!! Form::open(['route' => ['admin.jobs.destroy', $job->id], 'method' => 'delete']) !!}--}}
            {{--<div class='btn-group'>--}}
            {{--<a href="{!! route('admin.jobs.show', [$job->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
            {{--<a href="{!! route('admin.jobs.edit', [$job->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>--}}
            {{--{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
            {{--</div>--}}
            {{--{!! Form::close() !!}--}}
            {{--</td>--}}
        </tr>
    @endforeach
    </tbody>
</table>