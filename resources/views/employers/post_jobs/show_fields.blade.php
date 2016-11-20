{{--<div class="col-md-12 text-center view-job">--}}
    {{--<h3>{!! $postJob->post_name !!}</h3>--}}
    {{--<div class="spacer-1"></div>--}}
{{--</div>--}}

<table class="table table-bordered">
    <tbody>
    <tr>
        <td class="bg-color-table">Year Of Exp</td>
        <td>{!! $postJob->preferred_experience !!} Year (s)</td>
        <td class="bg-color-table">Term</td>
        <td>{!! $postJob->job_type !!}</td>
    </tr>
    <tr>
        <td class="bg-color-table">Hiring</td>
        <td>{!! $postJob->no_of_post !!} Post(s)</td>
        <td class="bg-color-table">
            Function
        </td>
        <td>{!! $postJob->category->name !!}</td>
    </tr>
    <tr>
        <td class="bg-color-table">Salary</td>
        <td>USD($) {!! $postJob->salary_offered_min !!} ~
            USD($) {!! $postJob->salary_offered_max !!}</td>
        <td class="bg-color-table">
            Industry
        </td>
        <td>{!! $postJob->industry->name !!}</td>
    </tr>
    <tr>
        <td class="bg-color-table">Gender</td>
        <td>{!! $postJob->preferred_sex !!}</td>
        <td class="bg-color-table">
            Qualification
        </td>
        <td>{!! $postJob->qualification->name !!}</td>
    </tr>
    <tr>
        <td class="bg-color-table">Age</td>
        <td>{!! $postJob->preferred_age_min !!} Years
            ~ {!! $postJob->preferred_age_max !!} Years
        </td>
        <td class="bg-color-table">
            Language
        </td>
        <td>
            @foreach($postJob->languages as $language)
                <span class="label label-success">
                                                                {!! $language->name !!}
                                                            </span>
            @endforeach
        </td>
    </tr>
    <tr>
        <td class="bg-color-table">Published Date</td>
        <td>{!! \Carbon\Carbon::parse($postJob->published_date)->format('D-d-M-Y H:i A') !!}</td>
        <td class="bg-color-table">
            Closing Date
        </td>
        <td>{!! Carbon\Carbon::parse($postJob->closing_date)->format('D-d-M-Y H:i A') !!}</td>

    </tr>

    </tbody>
</table>
<div class="col-md-12">
    <h4><i class="fa fa-file-text-o margin-r-5"></i>Responsibilities:</h4>
    <hr>
    <div class="minimize">
        <p>
            {!! $postJob->description !!}
        </p>
    </div>
    <h4><i class="fa fa-file-text-o margin-r-5"></i>Requirements:</h4>
    <hr>
    <div class="minimize">
        <p>{!! $postJob->requirement_description !!}</p>
    </div>
</div>

<div class="row" style="margin-top:10px;">
    <div class="col-md-12 project-add-info">
        <a href="{{ route('employer.postJobs.index')}}" class="btn btn-primary btn-sm"><span
                    class="glyphicon glyphicon-chevron-left"></span> BACK</a>
        <a href="{{route('employer.postJobs.edit', $postJob->id) }}" class="btn btn-success btn-sm"><span
                    class="glyphicon glyphicon-edit"></span> EDIT</a>
        @if($postJob->status==1)
            <a href="{{route('employer.update_job_status_filled_up', Hashids::encode($postJob->id)) }}"
               class="btn bg-orange btn-flat btn-sm">
                <i class="fa fa-archive"></i> &nbsp;Marked Status as Filled Up</a>
        @elseif($postJob->status==0 || $postJob->status==2)
            <a href="{{route('employer.update_job_status_active', Hashids::encode($postJob->id)) }}"
               class="btn bg-olive btn-flat btn-sm">
                <i class="fa fa-archive"></i> &nbsp;Marked Status as Active</a>
        @endif
        @if($postJob->status!=0)
            <a href="{{route('employer.update_job_status_disabled', Hashids::encode($postJob->id)) }}"
               class="btn btn-danger btn-flat btn-sm">
                <i class="fa fa-archive"></i> &nbsp;Marked Status as Disabled</a>
        @endif
    </div>
</div>

<div class="row" style="margin-top:20px">
    <div class="col-md-8 project-add-info col-md-offset-2">
        <i class="fa fa-bullseye"></i> Job Status {!! $postJob->job_status !!} | <i
                class="fa fa-calendar-check-o"></i> Job created at
        <strong>{{ date('d-m-Y h:i A', strtotime($postJob->created_at)) }}</strong> | <i
                class="fa fa-get-pocket"></i> Employer
        <strong>{{ $postJob->employer['organization_name'] }} </strong>
    </div>
</div>
