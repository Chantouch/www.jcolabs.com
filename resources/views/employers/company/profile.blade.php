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
                        <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
                        <p class="text-muted">
                            B.S. in Computer Science from the University of Tennessee at Knoxville
                        </p>
                        <hr>
                        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                        <p class="text-muted">{!! $profile->address !!}</p>
                        <hr>
                        <strong><i class="fa fa-pencil margin-r-5"></i> Services</strong>
                        <p>
                            <span class="label label-danger">UI Design</span>
                            <span class="label label-success">Coding</span>
                            <span class="label label-info">Javascript</span>
                            <span class="label label-warning">PHP</span>
                            <span class="label label-primary">Node.js</span>
                        </p>
                        <hr>
                        <strong><i class="fa fa-pencil margin-r-5"></i> Products</strong>
                        <p>
                            <span class="label label-danger">UI Design</span>
                            <span class="label label-success">Coding</span>
                            <span class="label label-info">Javascript</span>
                            <span class="label label-warning">PHP</span>
                            <span class="label label-primary">Node.js</span>
                        </p>
                        <hr>
                        <strong><i class="fa fa-file-text-o margin-r-5"></i> About</strong>
                        <p>{!! $profile->details !!}</p>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
                        <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
                        <li><a href="#settings" data-toggle="tab">Settings</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <!-- Post -->
                            <div class="post">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm"
                                         src="{!! asset('dist/img/user1-128x128.jpg') !!}" alt="user image">
                                    <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                                    <span class="description">Shared publicly - 7:30 PM today</span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                    Lorem ipsum represents a long-held tradition for designers,
                                    typographers and the like. Some people hate it and argue for
                                    its demise, but others ignore the hate as they create awesome
                                    tools to help create filler text for everyone from bacon lovers
                                    to Charlie Sheen fans.
                                </p>
                                <ul class="list-inline">
                                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i>
                                            Share</a></li>
                                    <li><a href="#" class="link-black text-sm"><i
                                                    class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                                    </li>
                                    <li class="pull-right">
                                        <a href="#" class="link-black text-sm"><i
                                                    class="fa fa-comments-o margin-r-5"></i> Comments
                                            (5)</a></li>
                                </ul>

                                <input class="form-control input-sm" type="text" placeholder="Type a comment">
                            </div>
                            <!-- /.post -->

                            <!-- Post -->
                            <div class="post clearfix">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm"
                                         src="{!! asset('dist/img/user7-128x128.jpg') !!}" alt="User Image">
                                    <span class="username">
                          <a href="#">Sarah Ross</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                                    <span class="description">Sent you a message - 3 days ago</span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                    Lorem ipsum represents a long-held tradition for designers,
                                    typographers and the like. Some people hate it and argue for
                                    its demise, but others ignore the hate as they create awesome
                                    tools to help create filler text for everyone from bacon lovers
                                    to Charlie Sheen fans.
                                </p>

                                <form class="form-horizontal">
                                    <div class="form-group margin-bottom-none">
                                        <div class="col-sm-9">
                                            <input class="form-control input-sm" placeholder="Response">
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">
                                                Send
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.post -->

                            <!-- Post -->
                            <div class="post">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm"
                                         src="{!! asset('dist/img/user6-128x128.jpg') !!}" alt="User Image">
                                    <span class="username">
                          <a href="#">Adam Jones</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                                    <span class="description">Posted 5 photos - 5 days ago</span>
                                </div>
                                <!-- /.user-block -->
                                <div class="row margin-bottom">
                                    <div class="col-sm-6">
                                        <img class="img-responsive" src="{!! asset('dist/img/photo1.png') !!}"
                                             alt="Photo">
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <img class="img-responsive" src="{!! asset('dist/img/photo2.png') !!}"
                                                     alt="Photo">
                                                <br>
                                                <img class="img-responsive" src="{!! asset('dist/img/photo3.jpg') !!}"
                                                     alt="Photo">
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-6">
                                                <img class="img-responsive" src="{!! asset('dist/img/photo4.jpg') !!}"
                                                     alt="Photo">
                                                <br>
                                                <img class="img-responsive" src="{!! asset('dist/img/photo1.png') !!}"
                                                     alt="Photo">
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <ul class="list-inline">
                                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i>
                                            Share</a></li>
                                    <li><a href="#" class="link-black text-sm"><i
                                                    class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                                    </li>
                                    <li class="pull-right">
                                        <a href="#" class="link-black text-sm"><i
                                                    class="fa fa-comments-o margin-r-5"></i> Comments
                                            (5)</a></li>
                                </ul>

                                <input class="form-control input-sm" type="text" placeholder="Type a comment">
                            </div>
                            <!-- /.post -->
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
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> I agree to the <a href="#">terms and
                                                conditions</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
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

