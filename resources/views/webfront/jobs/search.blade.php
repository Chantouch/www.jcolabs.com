@extends('webfront.layouts.default')
@section('title', 'Search all jobs')
@section('page_specific_styles')
    <link href="{{ asset('plugins/animate/animate.css') }}" rel="stylesheet" type="text/css"/>
    <style>

    </style>
@stop


@section('full_content')

    <!-- start job finder -->
    @include('components.search')
    <!-- end job finder -->

    <div class="recent-job"><!-- Start Job -->
        <div class="container">
            <h4><i class="glyphicon glyphicon-briefcase"></i> JOBS</h4>
            <div id="tab-container" class='tab-container'><!-- Start Tabs -->
                <ul class='etabs clearfix'>
                    <li class='tab'><a href="#all">All</a></li>
                    <li class='tab'><a href="#contract">Contract</a></li>
                    <li class='tab'><a href="#full">Full Time</a></li>
                    <li class='tab'><a href="#free">Freelence</a></li>
                </ul>

                <div class='panel-container'>
                    <div id="all"><!-- Tabs section 1 -->
                        @if (count($jobs) >= 1)
                            @foreach($jobs as $job)
                                <div class="recent-job-list"><!-- Tabs content -->
                                    <div class="col-md-1 job-list-logo">
                                        @if($job->employer->photo == 'default.jpg')
                                            <img src="{!!asset('uploads/employers/'.$job->employer->photo)!!}"
                                                 class="img-responsive"
                                                 alt="{!! $job->post_name !!}"/>
                                        @else
                                            <img src="{!!asset($job->employer->path.$job->employer->photo)!!}"
                                                 class="img-responsive"
                                                 alt="{!! $job->post_name !!}"/>
                                        @endif
                                    </div>

                                    <div class="col-md-5 job-list-desc">
                                        <h6>{!! \Illuminate\Support\Str::limit($job->post_name, 35) !!}</h6>
                                        <p>{!! \Illuminate\Support\Str::limit($job->description, 50) !!}</p>
                                    </div>
                                    <div class="col-md-3 job-list-location">
                                        <h6><i class="fa fa-map-marker"></i>{!! $job->city->name !!}</h6>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-7 job-list-type">
                                                <h6><i class="fa fa-user"></i>{!! $job->job_type !!}</h6>
                                            </div>
                                            <div class="col-md-5 job-list-button">
                                                <h6 class="pull-right">
                                                    <a href="{!! route('jobs.view.name', [$job->employer->slug, $job->industry->slug , $job->id,$job->slug]) !!}"
                                                       class="btn-view-job">View</a>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- Tabs content -->
                            @endforeach
                        @else
                            <span>There is no job match</span>
                        @endif

                        {!! $jobs->render() !!}

                    </div><!-- Tabs section 1 -->
                    <div id="contract"><!-- Tabs section 2 -->
                    </div><!-- Tabs section 2 -->
                    <div id="full"><!-- Tabs section 3 -->
                    </div><!-- Tabs section 3 -->
                    <div id="free"><!-- Tabs section 4 -->
                    </div><!-- Tabs section 4 -->
                </div>
            </div><!-- end Tabs -->

            <div id="job-opening">
                <div class="job-opening-top"><!-- job opening carousel nav -->
                    <div class="job-oppening-title">TOP JOB OPENING</div>
                    <div class="job-opening-nav">
                        <a class="btn prev"></a>
                        <a class="btn next"></a>
                        <div class="clearfix"></div>
                    </div>
                </div><!-- job opening carousel nav -->
                <div class="clearfix"></div>
                <br/>
                <div id="job-listing-carousel" class="owl-carousel"><!-- job opening carousel item -->
                    @foreach($top_jobs as $job)
                        <div class="item-listing">
                            <div class="job-opening">
                                @if($job->employer->photo == 'default.jpg')
                                    <img src="{!!asset('uploads/employers/'.$job->employer->photo)!!}"
                                         class="img-responsive"
                                         alt="{!! $job->post_name !!}"/>
                                @else
                                    <img src="{!!asset($job->employer->path.$job->employer->photo)!!}"
                                         class="img-responsive"
                                         alt="{!! $job->post_name !!}"/>
                                @endif
                                <div class="job-opening-content">
                                    {!! $job->post_name!!}
                                    <p>
                                        {!! \Illuminate\Support\Str::limit($job->description, 100) !!}
                                    </p>
                                </div>
                                <div class="job-opening-meta clearfix">
                                    <div class="meta-job-location meta-block"><i
                                                class="fa fa-map-marker"></i>{!!$job->city->name !!}
                                    </div>
                                    <div class="meta-job-type meta-block"><i
                                                class="fa fa-user"></i> {!!$job->job_type!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="item-listing">
                        <div class="job-opening">
                            <img src="{!! asset('images/upload/dummy-job-open-1.png') !!}" class="img-responsive"
                                 alt="job-opening"/>
                            <div class="job-opening-content">
                                HR Manager
                                <p>
                                    Place for worlds best shipping company and work with great level efficiency to break
                                    trough in new career.
                                </p>
                            </div>
                            <div class="job-opening-meta clearfix">
                                <div class="meta-job-location meta-block"><i class="fa fa-map-marker"></i>San Fransisco
                                </div>
                                <div class="meta-job-type meta-block"><i class="fa fa-user"></i>Full Time</div>
                            </div>
                        </div>
                    </div>

                    <div class="item-listing">
                        <div class="job-opening">
                            <img src="{!! asset('images/upload/dummy-job-open-2.png') !!}" class="img-responsive"
                                 alt="job-opening"/>
                            <div class="job-opening-content">
                                HR Manager
                                <p>
                                    Place for worlds best shipping company and work with great level efficiency to break
                                    trough in new career.
                                </p>
                            </div>
                            <div class="job-opening-meta clearfix">
                                <div class="meta-job-location meta-block"><i class="fa fa-map-marker"></i>San Fransisco
                                </div>
                                <div class="meta-job-type meta-block"><i class="fa fa-user"></i>Full Time</div>
                            </div>
                        </div>
                    </div>

                    <div class="item-listing">
                        <div class="job-opening">
                            <img src="{!! asset('images/upload/dummy-job-open-1.png') !!}" class="img-responsive"
                                 alt="job-opening"/>
                            <div class="job-opening-content">
                                HR Manager
                                <p>
                                    Place for worlds best shipping company and work with great level efficiency to break
                                    trough in new career.
                                </p>
                            </div>
                            <div class="job-opening-meta clearfix">
                                <div class="meta-job-location meta-block"><i class="fa fa-map-marker"></i>San Fransisco
                                </div>
                                <div class="meta-job-type meta-block"><i class="fa fa-user"></i>Full Time</div>
                            </div>
                        </div>
                    </div>

                </div><!-- job opening carousel item -->
            </div>
        </div>
    </div><!-- end Job -->

    <!-- Start page content -->
    @include('webfront.jobs.page-content')
    <!--End page content -->

    <!-- ###################### Feature Search ##################### -->
    @include('webfront.jobs.feature-search')
    <!--End Feature search -->

@stop



@section('page_specific_js')

    <script src="{{ asset('plugins/typeahead/bootstrap3-typeahead.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('plugins/wow/wow.min.js')}}" type="text/javascript"></script>

    <script type="text/javascript">

    </script>
@stop

@section('page_specific_scripts')

    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    var path = "{!! route('job.search.name') !!}";
    var city_path = "{!! route('job.search.city') !!}";
    $('#searchjob').typeahead({
    source: function (query, process) {
    return $.get(path, {query: query}, function (data) {
    return process(data);
    })
    }
    });

    $('#searchplace').typeahead({
    source: function (query, process) {
    return $.get(city_path, {city: query}, function (data) {
    return process(data);
    })
    }
    });

    new WOW().init();

@stop
