@extends('webfront.layouts.default')

@section('page_specific_styles')

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
                        @if(!empty($categories))
                            @foreach($categories as $job)
                                <div class="recent-job-list"><!-- Tabs content -->
                                    <div class="job-list-logo col-md-1 ">
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
                                    <div class="col-md-6 full">
                                        <div class="job-list-location col-md-5">
                                            <h6>
                                                <i class="fa fa-map-marker"></i>{!! $job->city->name !!}
                                            </h6>
                                        </div>
                                        <div class="job-list-type col-md-5 ">
                                            <h6><i class="fa fa-user"></i>{!! $job->job_type !!}</h6>
                                        </div>
                                        <div class="col-md-2 job-list-button">
                                            <a href="{!! route('jobs.view.name', [$job->employer->slug, $job->industry->slug , $job->id,$job->slug]) !!}"
                                               class="btn-view-job">View</a>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- Tabs content -->
                            @endforeach
                        @endif
                        @if(!empty($industries))
                            @foreach($industries as $job)
                                <div class="recent-job-list"><!-- Tabs content -->
                                    <div class="job-list-logo col-md-1 ">
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
                                    <div class="col-md-6 full">
                                        <div class="job-list-location col-md-5">
                                            <h6>
                                                <i class="fa fa-map-marker"></i>{!! $job->city->name !!}
                                            </h6>
                                        </div>
                                        <div class="job-list-type col-md-5 ">
                                            <h6><i class="fa fa-user"></i>{!! $job->job_type !!}</h6>
                                        </div>
                                        <div class="col-md-2 job-list-button">
                                            <a href="{!! route('jobs.view.name', [$job->employer->slug, $job->industry->slug , $job->id,$job->slug]) !!}"
                                               class="btn-view-job">View</a>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- Tabs content -->
                            @endforeach
                        @endif
                        @if(!empty($companies))
                            @foreach($companies as $job)
                                <div class="recent-job-list"><!-- Tabs content -->
                                    <div class="job-list-logo col-md-1 ">
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
                                    <div class="col-md-6 full">
                                        <div class="job-list-location col-md-5">
                                            <h6>
                                                <i class="fa fa-map-marker"></i>{!! $job->city->name !!}
                                            </h6>
                                        </div>
                                        <div class="job-list-type col-md-5 ">
                                            <h6><i class="fa fa-user"></i>{!! $job->job_type !!}</h6>
                                        </div>
                                        <div class="col-md-2 job-list-button">
                                            <a href="{!! route('jobs.view.name', [$job->employer->slug, $job->industry->slug , $job->id,$job->slug]) !!}"
                                               class="btn-view-job">View</a>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- Tabs content -->
                            @endforeach
                        @endif
                        @if(!empty($cities))
                            @foreach($cities as $job)
                                <div class="recent-job-list"><!-- Tabs content -->
                                    <div class="job-list-logo col-md-1 ">
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
                                    <div class="col-md-6 full">
                                        <div class="job-list-location col-md-5">
                                            <h6>
                                                <i class="fa fa-map-marker"></i>{!! $job->city->name !!}
                                            </h6>
                                        </div>
                                        <div class="job-list-type col-md-5 ">
                                            <h6><i class="fa fa-user"></i>{!! $job->job_type !!}</h6>
                                        </div>
                                        <div class="col-md-2 job-list-button">
                                            <a href="{!! route('jobs.view.name', [$job->employer->slug, $job->industry->slug , $job->id,$job->slug]) !!}"
                                               class="btn-view-job">View</a>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- Tabs content -->
                            @endforeach
                            {{--@if(empty($cities) || empty($categories) || empty($industries)|| empty($companies) )--}}
                            {{--<span>There is no job here</span>--}}
                            {{--@endif--}}
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

@stop

@section('main_page_container')



@stop

@section('page_content')

@stop

@section('page_specific_js')
    <script type="text/javascript">


    </script>
@stop

@section('page_specific_scripts')

@stop
