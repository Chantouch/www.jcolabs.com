@extends('layouts.app')
@section('title', 'Company profile')
@section('page_specific_css')
    <style>
        .spacer-1 {
            height: 15px;
        }
    </style>
@stop
@section('content')
    <section class="content-header">
        <h1>
            Company Profile
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Company</a></li>
            <li class="active">Profile</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        @if(Auth::guard('employer')->user()->photo != 'default.jpg')
                            <img class="profile-user-img img-responsive img-circle"
                                 src="{!! asset($profile->path.'/'.$profile->photo) !!}"
                                 alt="User profile picture">
                        @else
                            <img src="{!! asset('uploads/employers/' . Auth::guard('employer')->user()->photo) !!}"
                                 class="profile-user-img img-responsive img-circle"
                                 alt="{!! Auth::guard('employer')->user()->contact_name !!}"/>
                        @endif
                        <h3 class="profile-username text-center">{!! $profile->contact_name !!}</h3>
                        <p class="text-muted text-center">{!! $profile->organization_name !!}</p>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Total job posted</b>
                                <a class="pull-right badge bg-blue">{!! $total_jobs !!}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Jobs not verified yet</b>
                                <a class="pull-right badge bg-red">{!! count($jobs_not_verified) !!}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Jobs filled up</b>
                                <a class="pull-right badge bg-green">{!! count($jobs_filled_up) !!}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Jobs Available</b>
                                <a class="pull-right badge bg-aqua">{!! count($jobs_available) !!}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Jobs Expired</b>
                                <a class="pull-right badge bg-red-gradient">{!! count($jobs_available) !!}</a>
                            </li>
                        </ul>
                        <a href="#" class="btn btn-primary btn-block"><b>Verified</b></a>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">About Company</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-file-text-o margin-r-5"></i> About</strong>
                        <p>{!! $profile->details !!}</p>
                        @if(is_null($profile->address) || !empty($profile->address))
                            <hr>
                            <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                            <p class="text-muted">{!! $profile->address !!}</p>
                        @endif


                        @if(!empty($profile->services) || !is_null($profile->services))
                            <hr>
                            <strong><i class="fa fa-pencil margin-r-5"></i> Services</strong>
                            <p>
                                {!! $profile->services !!}
                            </p>
                        @endif

                        @if(!empty($profile->products) || !is_null($profile->products))
                            <hr>
                            <strong><i class="fa fa-pencil margin-r-5"></i> Products</strong>
                            <p>
                                {!! $profile->products !!}
                            </p>
                        @endif
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#joblist" data-toggle="tab">Jobs List</a></li>
                        <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
                        <li><a href="#settings" data-toggle="tab">Settings</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="joblist">
                            <!-- Post -->
                            @if(!empty($all_jobs))
                                @foreach($all_jobs as $job)
                                    <div class="post">
                                        <div class="user-block">
                                            @if(Auth::guard('employer')->user()->photo != 'default.jpg')
                                                <img class="img-circle img-bordered-sm"
                                                     src="{!! asset($profile->path.'/'.$profile->photo) !!}"
                                                     alt="User profile picture">
                                            @else
                                                <img src="{!! asset('uploads/employers/' . Auth::guard('employer')->user()->photo) !!}"
                                                     class="img-circle img-bordered-sm"
                                                     alt="{!! Auth::guard('employer')->user()->contact_name !!}"/>
                                            @endif
                                            <span class="username">
                                      <a href="#">{!! $job->post_name !!}</a>
                                      <a href="#" class="pull-right btn-box-tool" data-widget="collapse"><i
                                                  class="fa fa-times"></i></a>
                                    </span>
                                            <span class="description">Shared publicly - {!! \Carbon\Carbon::parse($job->created_at)->diffForHumans() !!}</span>
                                        </div>
                                        <div class="box">
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                    <tr>
                                                        <td class="bg-color-table">Year Of Exp</td>
                                                        <td>{!! $job->preferred_experience !!} Year (s)</td>
                                                        <td class="bg-color-table">Term</td>
                                                        <td>{!! $job->job_type !!}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-color-table">Hiring</td>
                                                        <td>{!! $job->no_of_post !!} Post(s)</td>
                                                        <td class="bg-color-table">
                                                            Function
                                                        </td>
                                                        <td>{!! $job->category->name !!}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-color-table">Salary</td>
                                                        <td>USD($) {!! $job->salary_offered_min !!} ~
                                                            USD($) {!! $job->salary_offered_max !!}</td>
                                                        <td class="bg-color-table">
                                                            Industry
                                                        </td>
                                                        <td>{!! $job->industry->name !!}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-color-table">Gender</td>
                                                        <td>{!! $job->preferred_sex !!}</td>
                                                        <td class="bg-color-table">
                                                            Qualification
                                                        </td>
                                                        <td>{!! $job->qualification->name !!}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-color-table">Age</td>
                                                        <td>{!! $job->preferred_age_min !!} Years
                                                            ~ {!! $job->preferred_age_max !!} Years
                                                        </td>
                                                        <td class="bg-color-table">
                                                            Language
                                                        </td>
                                                        <td>
                                                            @foreach($job->languages as $language)
                                                                <span class="label label-success">
                                                                {!! $language->name !!}
                                                            </span>
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-color-table">Published Date</td>
                                                        <td>{!! \Carbon\Carbon::parse($job->published_date)->format('D-d-M-Y H:i A') !!}</td>
                                                        <td class="bg-color-table">
                                                            Closing Date
                                                        </td>
                                                        <td>{!! Carbon\Carbon::parse($job->closing_date)->format('D-d-M-Y H:i A') !!}</td>

                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h4><i class="fa fa-file-text-o margin-r-5"></i>Responsibilities:</h4>
                                            <hr>
                                            <div class="minimize">
                                                <p>
                                                    {!! $job->description !!}
                                                </p>
                                            </div>
                                            <h4><i class="fa fa-file-text-o margin-r-5"></i>Requirements:</h4>
                                            <hr>
                                            <div class="minimize">
                                                <p>{!! $job->requirement_description !!}</p>
                                            </div>

                                        </div>
                                        <ul class="list-inline">
                                            <li><a href="#" class="link-black text-sm">
                                                    <i class="fa fa-share margin-r-5"></i>
                                                    Share</a>
                                            </li>
                                            {{--<li><a href="#" class="link-black text-sm"><i--}}
                                            {{--class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>--}}
                                            {{--</li>--}}
                                            {{--<li class="pull-right">--}}
                                            {{--<a href="#" class="link-black text-sm"><i--}}
                                            {{--class="fa fa-comments-o margin-r-5"></i> Comments--}}
                                            {{--(5)</a></li>--}}
                                        </ul>

                                        {{--<input class="form-control input-sm" type="text" placeholder="Type a comment">--}}

                                    </div>
                                @endforeach
                            @else
                                <div class="post">
                                    <p>There is no job post yet.</p>
                                </div>
                            @endif
                            {!! $all_jobs->render() !!}
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                            <!-- The timeline -->
                            <ul class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="bg-red">
                                      10 Feb. 2014
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-envelope bg-blue"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                        <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                        <div class="timeline-body">
                                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                            quora plaxo ideeli hulu weebly balihoo...
                                        </div>
                                        <div class="timeline-footer">
                                            <a class="btn btn-primary btn-xs">Read more</a>
                                            <a class="btn btn-danger btn-xs">Delete</a>
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-user bg-aqua"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                                        <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your
                                            friend request
                                        </h3>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-comments bg-yellow"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                                        <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post
                                        </h3>

                                        <div class="timeline-body">
                                            Take me to your leader!
                                            Switzerland is small and neutral!
                                            We are more like Germany, ambitious and misunderstood!
                                        </div>
                                        <div class="timeline-footer">
                                            <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="bg-green">
                                      3 Jan. 2014
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-camera bg-purple"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                                        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                        <div class="timeline-body">
                                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            </ul>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="settings">
                            <div class="col-md-12 text-center">
                                <h2>Add contact</h2>
                                <div class="spacer-1"></div>
                            </div>
                            {!! Form::open(['route' => 'employer.contactPeople.store','class'=>'form-horizontal']) !!}
                            <div class="form-group">
                                <label for="contact_name" class="col-sm-2 control-label">Name</label>

                                <div class="col-sm-10">
                                    {!! Form::text('contact_name', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="department_id" class="col-sm-2 control-label">Department</label>

                                <div class="col-sm-10">
                                    {!! Form::select('department_id', $departments, null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="position_id" class="col-sm-2 control-label">Position</label>

                                <div class="col-sm-10">
                                    {!! Form::select('position_id', $positions, null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone_number" class="col-sm-2 control-label">Phone number</label>

                                <div class="col-sm-10">
                                    {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            {{--<div class="form-group">--}}
                            {{--<div class="col-sm-offset-2 col-sm-10">--}}
                            {{--<div class="checkbox">--}}
                            {{--<label>--}}
                            {{--<input type="checkbox"> I agree to the <a href="#">terms and--}}
                            {{--conditions</a>--}}
                            {{--</label>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                                    <a href="{!! route('employer.contactPeople.index') !!}"
                                       class="btn btn-default">Cancel</a>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

    <div id="container-floating">

        <div class="nd4 nds" data-toggle="tooltip" data-placement="left"
             data-original-title="{!! $profile->contact_name !!}"><img class="reminder">
            <p class="letter">C</p>
        </div>
        <div class="nd3 nds" data-toggle="tooltip" data-placement="left"
             data-original-title="{!! $profile->organization_name !!}"><img class="reminder"
                                                                            src="{!! asset('images/ic_reminders_speeddial_white_24dp.png') !!}"/>
        </div>
        <div class="nd1 nds" data-toggle="tooltip" data-placement="left"
             data-original-title="{!! $profile->contact_email !!}"><img class="reminder">
            <p class="letter">E</p>
        </div>

        <div id="floating-button" data-toggle="tooltip" data-placement="left" data-original-title="Update">
            <p class="plus">+</p>
            <a href="{!! route('employer.company.show.update') !!}">
                <img class="edit" src="{!! asset('images/bt_compose2_1x.png') !!}"></a>
        </div>

    </div>
    <!-- /.content-wrapper -->
@endsection

@section('page_specific_js')

    <script>
        jQuery(function () {

            var minimized_elements = $('div.minimizes');

            minimized_elements.each(function () {
                var t = $(this).text();
                if (t.length < 500) return;

                $(this).html(
                        t.slice(0, 500) + '<span>... </span><a href="#" class="more label label-info">More</a>' +
                        '<span style="display:none;">' + t.slice(500, t.length) + ' <a href="#" class="less label label-info">Less</a></span>'
                );

            });

            $('a.more', minimized_elements).click(function (event) {
                event.preventDefault();
                $(this).hide().prev().hide();
                $(this).next().show();
            });

            $('a.less', minimized_elements).click(function (event) {
                event.preventDefault();
                $(this).parent().hide().prev().show().prev().show();
            });

        });
    </script>
@stop