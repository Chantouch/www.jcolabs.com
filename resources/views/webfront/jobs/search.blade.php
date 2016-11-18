@extends('webfront.layouts.default')
@section('title', 'Search all jobs')
@section('page_specific_styles')
    <link href="{{ asset('plugins/animate/animate.css') }}" rel="stylesheet" type="text/css"/>

@stop


@section('full_content')

    <div class="job-finder"><!-- start job finder -->
        <div class="container">
            <h3 class="text-center">Job Search</h3>
            <form>
                <div class="col-md-7 form-group group-1">
                    <label for="searchjob" class="label">Search</label>
                    <input id="searchjob" class="input-job"
                           placeholder="Keywords (IT Engineer, Shop Manager, Hr Manager...)">
                </div>

                <div class="col-md-5 form-group group-2">
                    <label for="searchplace" class="label">Location</label>
                    <input id="searchplace" class="input-location"
                           placeholder="New York, Hong Kong, New Delhi, Berlin etc.">
                </div>

                <div class="form-group">
                    <label for="experiences" class="label clearfix">Experiences(-/+)</label>
                    <input id="experiences" class="value-slider" type="text" name="area" value="1;1"/>
                </div>
                <div class="clearfix"></div>
                <br/>
                <div class="form-group">
                    <label for="salary" class="label clearfix">Salary ($)/per year</label>
                    <input id="salary" class="value-slider" type="text" name="area" value="0;0"/>
                </div>
                <button type="button" class="btn btn-default btn-green">search</button>
            </form>
        </div>
    </div><!-- end job finder -->

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
                        @if (count($jobs) === 0)
                            <div class="recent-job-list"><!-- Tabs content -->
                                <span>There is no job match with your search!</span>
                            </div>
                        @elseif (count($jobs) >= 1)
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
                                                <a href="{!! route('jobs.view.name', [preg_replace('/\s+/', '', $job->employer->organization_name), preg_replace('/\s+/', '', $job->industry->name ), $job->id,$job->slug]) !!}"
                                                   class="btn-view-job">View</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- Tabs content -->
                            @endforeach
                        @endif

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
                    {{--<div class="item-listing">--}}
                        {{--<div class="job-opening">--}}
                            {{--@if($job->employer->photo == 'default.jpg')--}}
                                {{--<img src="{!!asset('uploads/employers/'.$job->employer->photo)!!}"--}}
                                     {{--class="img-responsive"--}}
                                     {{--alt="{!! $job->post_name !!}"/>--}}
                            {{--@else--}}
                                {{--<img src="{!!asset($job->employer->path.$job->employer->photo)!!}"--}}
                                     {{--class="img-responsive"--}}
                                     {{--alt="{!! $job->post_name !!}"/>--}}
                            {{--@endif--}}
                            {{--<div class="job-opening-content">--}}
                                {{--{!! $job->post_name!!}--}}
                                {{--<p>--}}
                                    {{--{!! \Illuminate\Support\Str::limit($job->description, 100) !!}--}}
                                {{--</p>--}}
                            {{--</div>--}}
                            {{--<div class="job-opening-meta clearfix">--}}
                                {{--<div class="meta-job-location meta-block"><i class="fa fa-map-marker"></i>{!!$job->city->name !!}--}}
                                {{--</div>--}}
                                {{--<div class="meta-job-type meta-block"><i class="fa fa-user"></i> {!!$job->job_type!!}</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="item-listing">
                        <div class="job-opening">
                            <img src="{!! asset('images/upload/dummy-job-open-1.png') !!}" class="img-responsive" alt="job-opening"/>
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
                            <img src="{!! asset('images/upload/dummy-job-open-2.png') !!}" class="img-responsive" alt="job-opening"/>
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
                            <img src="{!! asset('images/upload/dummy-job-open-1.png') !!}" class="img-responsive" alt="job-opening"/>
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

    <div id="page-content"><!-- start content -->
        <div class="content-about">
            <div class="spacer-2">&nbsp;</div>

            <div class="row clearfix">
                <div class="col-md-6 about-post-resume">
                    <h4>Post Your Resume</h4>
                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                        deleniti atque corrupti quos dolores et quas molestias</p>
                    <p>
                        <button class="btn btn-default btn-black">UPLOAD YOUR RESUME <i class="icon-upload white"></i>
                        </button>
                    </p>
                </div>
                <div class="col-md-6 about-post-job">
                    <h4>Post Job Now</h4>
                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                        deleniti atque corrupti quos dolores et quas molestias</p>
                    <p>
                        <button class="btn btn-default btn-green">POST A JOB NOW</button>
                    </p>
                </div>
            </div>
            <div class="spacer-2">&nbsp;</div>

            <div id="cs"><!-- CS -->
                <div class="container">
                    <div class="spacer-1">&nbsp;</div>
                    <h1>Hey Friends Any Quries?</h1>
                    <p>
                        At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                        deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                        provident, similique sunt.
                    </p>
                    <h1 class="phone-cs">Call: 1 800 000 500</h1>
                </div>
            </div><!-- CS -->
        </div><!-- end content -->
    </div><!-- end page content -->


    <!-- ###################### Feature Search ##################### -->
    <section id="stat">
        <div class="overlay">
            <div class="row">
                <div class="section-heading">
                    <h2 class="wow fadeInDown">Search for your <span class="theme-color">Jobs</span></h2>
                </div>
            </div>
            <div class="section-content">
                <div class="container">
                    <ul>
                        <!--======= Search By Category =========-->
                        <li class="col-sm-3 wow fadeInUp" data-wow-delay="0.3s">
                            <h3>Search By Category</h3>
                            <span><i class="fa fa-cloud-download"></i></span>
                            <p class="stats-count" data-from="0" data-to="890" data-speed="1500">34353</p>
                            <ul>
                                @foreach($category as $cat)
                                    <li><a href="{!! route('jobs.view.by.category',[$cat->id]) !!}">{!! $cat->name !!}
                                            ( {!! count($cat->jobs) !!} )</a></li>
                                @endforeach
                            </ul>
                            <a href="#" class="btn btn-blue m-t-25">View All</a>
                        </li>
                        <!--======= Search By Industry =========-->
                        <li class="col-sm-3 wow fadeInUp" data-wow-delay="0.6s">
                            <h3>Search By Industry</h3>
                            <span><i class="fa fa-user"></i></span>
                            <p class="stats-count" data-from="0" data-to="900" data-speed="2000">95600</p>
                            <ul>
                                @foreach($industry as $ind)
                                    <li><a href="#">{!! $ind->name !!} ( {!! count($ind->jobs) !!} )</a></li>
                                @endforeach
                            </ul>
                            <a href="#" class="btn btn-blue m-t-25">View All</a>
                        </li>
                        <!--======= Search by Company =========-->
                        <li class="col-sm-3 wow fadeInUp" data-wow-delay="0.9s">
                            <h3>Search by Company</h3>
                            <span><i class="fa fa-bookmark-o"></i></span>
                            <p class="stats-count" data-from="0" data-to="560" data-speed="1500">5600</p>
                            <ul>
                                @foreach($company as $com)
                                    <li><a href="#">{!! $com->organization_name !!} ( {!! count($com->jobs) !!} )</a>
                                    </li>
                                @endforeach
                            </ul>

                            <a href="#" class="btn btn-blue m-t-25">View All</a>
                        </li>
                        <!--======= Search by City =========-->
                        <li class="col-sm-3 wow fadeInUp" data-wow-delay="1.2s">
                            <h3>Search by City</h3>
                            <span><i class="fa fa-star-half-o"></i></span>
                            <p class="stats-count" data-from="0" data-to="4.5" data-speed="4000">4.5</p>
                            <ul>
                                @foreach($city as $ci)
                                    <li><a href="#">{!! $ci->name !!} ( {!! count($ci->jobs) !!} )</a></li>
                                @endforeach
                            </ul>

                            <a href="#" class="btn btn-blue m-t-25">View All</a>
                        </li>
                    </ul>
                    <div class="text-center">
                        <a href="#" class="btn btn-blue m-t-25">View All</a>
                    </div>
                </div>
                <!-- container -->
            </div>
            <!-- section-content -->
        </div>
        <!-- overlay black -->
    </section>
    <!-- #stat -->
@stop



@section('page_specific_js')

    <script src="{{ asset('plugins/wow/wow.min.js')}}" type="text/javascript"></script>

    <script type="text/javascript">


    </script>
@stop
@section('page_specific_scripts')
    new WOW().init();
@stop
