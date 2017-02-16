@extends('webfront.layouts.default')
@section('title', 'Jobs Result of Searching')
@section('page_specific_styles')
    <link href="{{ asset('plugins/animate/animate.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{!! asset('plugins/ion-range-slider/css/ion.rangeSlider.css') !!}">
    <link rel="stylesheet" href="{!! asset('plugins/ion-range-slider/css/ion.rangeSlider.skinFlat.css') !!}">

    <style>

    </style>
@stop


@section('full_content')

    <!-- start job finder -->
    @include('components.search')
    <!-- end job finder -->

    <div class="recent-job"><!-- Start Job -->
        <div class="container">
            <h4>
                <i class="glyphicon glyphicon-briefcase"></i>
                We found {!! count($jobs) !!} Job(s)
            </h4>

            <div id="tab-container" class='tab-container'><!-- Start Tabs -->
                <ul class='etabs clearfix'>
                    <li class='tab'><a href="#all">All Jobs Matches</a></li>
                    {{--<li class='tab'><a href="#full">Full Time</a></li>--}}
                    {{--<li class='tab'><a href="#part_time">Part Time</a></li>--}}
                    {{--<li class='tab'><a href="#contract">Contract</a></li>--}}
                    {{--<li class='tab'><a href="#internship">Internship</a></li>--}}
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

                    {{--<div id="contract"><!-- Tabs section 2 -->--}}
                    {{----}}
                    {{--</div><!-- Tabs section 2 -->--}}

                    {{--<div id="full"><!-- Tabs section 3 -->--}}
                    {{----}}
                    {{--</div><!-- Tabs section 3 -->--}}

                    {{--<div id="part_time"><!-- Tabs section 4 -->--}}
                    {{----}}
                    {{--</div><!-- Tabs section 4 -->--}}

                    {{--<div id="internship">
                    <!-- Tabs section 5 -->--}}
                    {{----}}
                    {{--</div><!-- Tabs section 5 -->--}}

                </div>
            </div><!-- end Tabs -->

            {{--Top job opening--}}
            @include('components.opening_jobs')
            {{--Top job opening--}}

        </div>
    </div><!-- end Job -->

    <!-- Start page content -->
    @include('webfront.jobs.page-content')
    <!--End page content -->

    <!-- Feature Search -->
    @include('webfront.jobs.feature-search')
    <!--End Feature search -->

@stop



@section('page_specific_js')

    <script src="{{ asset('plugins/typeahead/bootstrap3-typeahead.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('plugins/wow/wow.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('plugins/ion-range-slider/js/ion.rangeSlider.min.js')}}" type="text/javascript"></script>
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

    $("#salary_search").ionRangeSlider({
    type: "single",
    grid: true,
    min: 0,
    max: 5000,
    prefix: "$",
    values: [0, 50, 100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, 1500, 2000, 3000]
    });

    $("#experiences_search").ionRangeSlider({
    type: "single",
    grid: true,
    min: 0,
    max: 10,
    prefix: "Y",
    values: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
    });

    new WOW().init();

@stop
