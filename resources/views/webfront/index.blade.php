@extends('webfront.layouts.default')
@section('title', 'Jobs list')
@section('page_specific_styles')
    <link href="{{ asset('plugins/animate/animate.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Select2 -->
    <link rel="stylesheet" href="{!! asset('plugins/select2/select2.min.css') !!}">

@stop

@section('full_content')

    <div class="main-slider"><!-- start main-headline section -->
        <div class="slider-nav">
            <a class="slider-prev"><i class="fa fa-chevron-circle-left"></i></a>
            <a class="slider-next"><i class="fa fa-chevron-circle-right"></i></a>
        </div>
        <div id="home-slider" class="owl-carousel owl-theme" style="display: block; opacity: 1;">
            <div class="owl-wrapper-outer">
                <div class="owl-wrapper"
                     style="width: 5396px; left: 0px; display: block; transition: all 0ms ease; transform: translate3d(-1349px, 0px, 0px); transform-origin: 2023.5px 50% 0px; perspective-origin: 2023.5px 50%;">
                    <div class="owl-item">
                        <div class="item-slide">
                            <img src="{!! asset('webfront/images/upload/dummy-slide-1.jpg')!!}" class="img-responsive"
                                 alt="dummy-slide">
                        </div>
                    </div>
                    <div class="owl-item">
                        <div class="item-slide">
                            <img src="{!! asset('webfront/images/upload/dummy-slide-2.jpg')!!}" class="img-responsive"
                                 alt="dummy-slide">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="headline container"><!-- start headline section -->
        <div class="row">
            <div class="col-md-6 align-right">
                <h4>Easiest Way To Find Your Dream Job</h4>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when
                    looking at its layout. The point of using</p>
                <p><a href="#" class="btn btn-default btn-yellow">Find a Job</a></p>
            </div>
            <div class="col-md-6 align-left">
                <h4>Hire Skilled People, best of them</h4>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when
                    looking at its layout. The point of using</p>
                <p><a href="#" class="btn btn-default btn-light">Post a Job</a></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div><!-- end headline section -->

    <div class="job-finder"><!-- start job finder -->
        <div class="container">
            <h3>Find a Job</h3>
            {!! Form::open(array('route' => 'job.search', 'role'=>'search', 'method' => 'GET')) !!}
            <div class="col-md-7 form-group group-1">
                <label for="searchjob" class="label">Search</label>
                {!! Form::text('searchjob', null, ['class' => 'input-job', 'placeholder' => 'Keywords (IT Engineer, Shop Manager, Hr Manager...)', 'id' => 'searchjob']) !!}
            </div>
            <div class="col-md-5 form-group group-2">
                <label for="searchplace" class="label">Job Location</label>
                {!! Form::select('searchplace', $city_list, null, ['class' => 'input-location', 'placeholder' => 'Phnom Penh, Kandal, Kompong Chnang etc.', 'id' => 'searchplace']) !!}
{{--                {!! Form::select('searchplace', $city_list , null, ['class' => 'input-location']) !!}--}}
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
                <div class="clearfix"></div>
            </div>
            {{ Form::submit('Search', array('class' => 'btn btn-default btn-green')) }}
            {{ Form::close() }}
        </div>
    </div><!-- end job finder -->

    <div class="recent-job"><!-- Start Recent Job -->
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h4><i class="glyphicon glyphicon-briefcase"></i> Recent Job</h4>
                    <div id="tab-container" class='tab-container'><!-- Start Tabs -->
                        <ul class='etabs clearfix'>
                            <li class='tab'><a href="#all">All</a></li>
                            <li class='tab'><a href="#contract">Contract</a></li>
                            <li class='tab'><a href="#full">Full Time</a></li>
                            <li class='tab'><a href="#free">Free lence</a></li>
                        </ul>
                        <div class='panel-container'>
                            <div id="all"><!-- Tabs section 1 -->
                                @foreach ($posted_jobs as $job)
                                    <div class="recent-job-list-home"><!-- Tabs content -->
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
                                                <a href="{!! route('jobs.view.name', [preg_replace('/\s+/', '', $job->employer->organization_name), preg_replace('/\s+/', '', $job->industry->name ), $job->id,$job->slug]) !!}"
                                                   class="btn-view-job">View</a>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div><!-- Tabs content -->
                                @endforeach
                            </div><!-- Tabs section 1 -->
                            <div id="contract"><!-- Tabs section 2 -->
                                @foreach ($job_contracts as $job)
                                    <div class="recent-job-list-home"><!-- Tabs content -->
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
                                            <div class="job-list-location col-md-5 ">
                                                <h6>
                                                    <i class="fa fa-map-marker"></i>{!! $job->city->name !!}
                                                </h6>
                                            </div>
                                            <div class="job-list-type col-md-5 ">
                                                <h6><i class="fa fa-user"></i>{!! $job->job_type !!}</h6>
                                            </div>
                                            <div class="col-md-2 job-list-button">
                                                <a href="{!! route('jobs.view.name', [$job->employer->organization_name, $job->industry->name, $job->id,$job->slug]) !!}"
                                                   class="btn-view-job">View</a>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div><!-- Tabs content -->
                                @endforeach
                            </div><!-- Tabs section 2 -->
                            <div id="full"><!-- Tabs section 3 -->
                                Full time
                            </div><!-- Tabs section 3 -->
                            <div id="free"><!-- Tabs section 4 -->
                                Freelancer
                            </div><!-- Tabs section 4 -->
                        </div>
                    </div><!-- end Tabs -->
                    <div class="spacer-2"></div>
                </div>

                <div class="col-md-4">
                    <div id="job-opening">
                        <div class="job-opening-top">
                            <div class="job-oppening-title">Top Job Opening</div>
                            <div class="job-opening-nav">
                                <a class="btn prev"></a>
                                <a class="btn next"></a>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                        <div id="job-opening-carousel" class="owl-carousel">
                            @foreach ($top_jobs as $job)
                                <div class="item-home">
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
                                                        class="fa fa-map-marker"></i> {!!$job->city->name !!}
                                            </div>
                                            <div class="meta-job-type meta-block"><i
                                                        class="fa fa-user"></i> {!!$job->job_type!!} </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="item-home">
                                <div class="job-opening">
                                    <img src="images/upload/dummy-job-open-2.png" class="img-responsive"
                                         alt="dummy-job-opening"/>

                                    <div class="job-opening-content">
                                        Head Shop Manager
                                        <p>
                                            Place for worlds best shipping company and work with great level efficiency
                                            to break trough in new career.
                                        </p>
                                    </div>

                                    <div class="job-opening-meta clearfix">
                                        <div class="meta-job-location meta-block"><i class="fa fa-map-marker"></i>Denver
                                        </div>
                                        <div class="meta-job-type meta-block"><i class="fa fa-user"></i>Full Time</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-home">
                                <div class="job-opening">
                                    <img src="images/upload/dummy-job-open-1.png" class="img-responsive"
                                         alt="dummy-job-opening"/>

                                    <div class="job-opening-content">
                                        Head Shop Manager
                                        <p>
                                            Place for worlds best shipping company and work with great level efficiency
                                            to break trough in new career.
                                        </p>
                                    </div>

                                    <div class="job-opening-meta clearfix">
                                        <div class="meta-job-location meta-block"><i class="fa fa-map-marker"></i>San
                                            Fransisco
                                        </div>
                                        <div class="meta-job-type meta-block"><i class="fa fa-user"></i>Washington</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="post-resume-title">Post Your Resume</div>
                    <div class="post-resume-container">
                        <button type="button" class="post-resume-button">Upload Your Resume
                            <i class="icon-upload grey"></i></button>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div><!-- end Recent Job -->

    <div class="job-status">
        <div class="container">
            <h1>Jobs Stats Updates</h1>
            <p>
                At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                provident, similique sunt in culpa qui officia deserunt mollitia animi.
            </p>

            <div class="counter clearfix">
                <div class="counter-container col-md-3 col-xs-6">
                    <div class="counter-value">{!! $posted_job_count !!}</div>
                    <div class="line"></div>
                    <p>Job Posted</p>
                </div>


                <div class="counter-container col-md-3 col-xs-6">
                    <div class="counter-value">{!! count($jobs_filled_up) !!}</div>
                    <div class="line"></div>
                    <p>Position Filled</p>
                </div>

                <div class="counter-container col-md-3 col-xs-6">
                    <div class="counter-value">{!! $companies !!}</div>
                    <div class="line"></div>
                    <p>Companies</p>
                </div>

                <div class="counter-container col-md-3 col-xs-6">
                    <div class="counter-value">{!! count($applicant) !!}</div>
                    <div class="line"></div>
                    <p>Applicants</p>
                </div>
            </div>

        </div>
    </div>

    <div class="step-to">
        <div class="container">
            <h1>Easiest Way To Use</h1>
            <p>
                At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                deleniti atque corrupti quos dolores et quas mo
            </p>

            <div class="step-spacer"></div>
            <div id="step-image">
                <div class="step-by-container">
                    <div class="step-by">
                        First Step
                        <div class="step-by-inner">
                            <div class="step-by-inner-img">
                                <img src="{!! asset('images/step-icon-1.png') !!}" class="img-responsive" alt="step"/>
                            </div>
                        </div>
                        <h5>Register with us</h5>
                    </div>

                    <div class="step-by">
                        Second Step
                        <div class="step-by-inner">
                            <div class="step-by-inner-img">
                                <img src="{!! asset('images/step-icon-2.png') !!}" class="img-responsive" alt="step"/>
                            </div>
                        </div>
                        <h5>Create your profile</h5>
                    </div>

                    <div class="step-by">
                        Third Step
                        <div class="step-by-inner">
                            <div class="step-by-inner-img">
                                <img src="{!! asset('images/step-icon-3.png') !!}" class="img-responsive" alt="step"/>
                            </div>
                        </div>
                        <h5>Upload your resume</h5>
                    </div>

                    <div class="step-by">
                        Now it's our turn
                        <div class="step-by-inner">
                            <div class="step-by-inner-img">
                                <img src="{!! asset('images/step-icon-4.png') !!}" class="img-responsive" alt="step"/>
                            </div>
                        </div>
                        <h5>Now take rest :)</h5>
                    </div>

                </div>
            </div>
            <div class="step-spacer"></div>
        </div>
    </div>

    <div class="testimony">
        <div class="container">
            <h1>What People Say About Us</h1>
            <p>
                At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                deleniti atque corrupti quos dolores et quas mo
            </p>

        </div>
        <div id="sync2" class="owl-carousel">
            <div class="testimony-image">
                <img src="images/upload/testimony-image-1.jpg" class="img-responsive" alt="testimony"/>
            </div>
            <div class="testimony-image">
                <img src="images/upload/testimony-image-2.jpg" class="img-responsive" alt="testimony"/>
            </div>
            <div class="testimony-image">
                <img src="images/upload/testimony-image-3.jpg" class="img-responsive" alt="testimony"/>
            </div>
            <div class="testimony-image">
                <img src="images/upload/testimony-image-4.jpg" class="img-responsive" alt="testimony"/>
            </div>
            <div class="testimony-image">
                <img src="images/upload/testimony-image-5.jpg" class="img-responsive" alt="testimony"/>
            </div>
            <div class="testimony-image">
                <img src="images/upload/testimony-image-6.jpg" class="img-responsive" alt="testimony"/>
            </div>
            <div class="testimony-image">
                <img src="images/upload/testimony-image-7.jpg" class="img-responsive" alt="testimony"/>
            </div>
            <div class="testimony-image">
                <img src="images/upload/testimony-image-8.jpg" class="img-responsive" alt="testimony"/>
            </div>
            <div class="testimony-image">
                <img src="images/upload/testimony-image-9.jpg" class="img-responsive" alt="testimony"/>
            </div>
            <div class="testimony-image">
                <img src="images/upload/testimony-image-10.jpg" class="img-responsive" alt="testimony"/>
            </div>

        </div>

        <div id="sync1" class="owl-carousel">
            <div class="testimony-content container">
                <p>
                    "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                    deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                    provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum .

                </p>
                <p>
                    John Grasin, CEO, IT-Planet
                </p>
                <div class="media-testimony">
                    <a href="" target="blank"><i class="fa fa-twitter twit"></i></a>
                    <a href="" target="blank"><i class="fa fa-linkedin linkedin"></i></a>
                    <a href="" target="blank"><i class="fa fa-facebook fb"></i></a>
                </div>
            </div>
            <div class="testimony-content container">
                <p>
                    "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                    deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                    provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum .

                </p>
                <p>
                    John Grasin, CEO, IT-Planet
                </p>
                <div class="media-testimony">
                    <a href="" target="blank"><i class="fa fa-twitter twit"></i></a>
                    <a href="" target="blank"><i class="fa fa-linkedin linkedin"></i></a>
                    <a href="" target="blank"><i class="fa fa-facebook fb"></i></a>
                </div>
            </div>
            <div class="testimony-content container">
                <p>
                    "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                    deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                    provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum .

                </p>
                <p>
                    John Grasin, CEO, IT-Planet
                </p>
                <div class="media-testimony">
                    <a href="" target="blank"><i class="fa fa-twitter twit"></i></a>
                    <a href="" target="blank"><i class="fa fa-linkedin linkedin"></i></a>
                    <a href="" target="blank"><i class="fa fa-facebook fb"></i></a>
                </div>
            </div>
            <div class="testimony-content container">
                <p>
                    "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                    deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                    provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum .

                </p>
                <p>
                    John Grasin, CEO, IT-Planet
                </p>
                <div class="media-testimony">
                    <a href="" target="blank"><i class="fa fa-twitter twit"></i></a>
                    <a href="" target="blank"><i class="fa fa-linkedin linkedin"></i></a>
                    <a href="" target="blank"><i class="fa fa-facebook fb"></i></a>
                </div>
            </div>
            <div class="testimony-content container">
                <p>
                    "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                    deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                    provident, similique sunt in culpa qui officia.

                </p>
                <p>
                    John Grasin, CEO, IT-Planet
                </p>
                <div class="media-testimony">
                    <a href="" target="blank"><i class="fa fa-twitter twit"></i></a>
                    <a href="" target="blank"><i class="fa fa-linkedin linkedin"></i></a>
                    <a href="" target="blank"><i class="fa fa-facebook fb"></i></a>
                </div>
            </div>
            <div class="testimony-content container">
                <p>
                    "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                    deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate.

                </p>
                <p>
                    John Grasin, CEO, IT-Planet
                </p>
                <div class="media-testimony">
                    <a href="" target="blank"><i class="fa fa-twitter twit"></i></a>
                    <a href="" target="blank"><i class="fa fa-linkedin linkedin"></i></a>
                    <a href="" target="blank"><i class="fa fa-facebook fb"></i></a>
                </div>
            </div>
            <div class="testimony-content container">
                <p>
                    "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                    deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                    provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum .

                </p>
                <p>
                    John Grasin, CEO, IT-Planet
                </p>
                <div class="media-testimony">
                    <a href="" target="blank"><i class="fa fa-twitter twit"></i></a>
                    <a href="" target="blank"><i class="fa fa-linkedin linkedin"></i></a>
                    <a href="" target="blank"><i class="fa fa-facebook fb"></i></a>
                </div>
            </div>
            <div class="testimony-content container">
                <p>
                    "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                    deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                    provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum .
                    At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                    deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                    provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum .

                </p>
                <p>
                    John Grasin, CEO, IT-Planet
                </p>
                <div class="media-testimony">
                    <a href="" target="blank"><i class="fa fa-twitter twit"></i></a>
                    <a href="" target="blank"><i class="fa fa-linkedin linkedin"></i></a>
                    <a href="" target="blank"><i class="fa fa-facebook fb"></i></a>
                </div>
            </div>
            <div class="testimony-content container">
                <p>
                    "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                    deleniti atque corrupti.
                </p>
                <p>
                    John Grasin, CEO, IT-Planet
                </p>
                <div class="media-testimony">
                    <a href="" target="blank"><i class="fa fa-twitter twit"></i></a>
                    <a href="" target="blank"><i class="fa fa-linkedin linkedin"></i></a>
                    <a href="" target="blank"><i class="fa fa-facebook fb"></i></a>
                </div>
            </div>
            <div class="testimony-content container">
                <p>
                    "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                    deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                    provident.

                </p>
                <p>
                    John Grasin, CEO, IT-Planet
                </p>
                <div class="media-testimony">
                    <a href="" target="blank"><i class="fa fa-twitter twit"></i></a>
                    <a href="" target="blank"><i class="fa fa-linkedin linkedin"></i></a>
                    <a href="" target="blank"><i class="fa fa-facebook fb"></i></a>
                </div>
            </div>
        </div>
    </div>


    <div id="company-post">
        <div class="container">

            <h1>Companies Who Have Posted Jobs</h1>
            <p>
                At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                provident, similique sunt in culpa qui officia deserunt mollitia animi.
            </p>

            <div id="company-post-list" class="owl-carousel company-post">
                <div class="company">
                    <img src="images/upload/company-1.png" class="img-responsive" alt="company-post"/>
                </div>
                <div class="company">
                    <img src="images/upload/company-2.png" class="img-responsive" alt="company-post"/>
                </div>
                <div class="company">
                    <img src="images/upload/company-3.png" class="img-responsive" alt="company-post"/>
                </div>
                <div class="company">
                    <img src="images/upload/company-4.png" class="img-responsive" alt="company-post"/>
                </div>
                <div class="company">
                    <img src="images/upload/company-5.png" class="img-responsive" alt="company-post"/>
                </div>

                <div class="company">
                    <img src="images/upload/company-1.png" class="img-responsive" alt="company-post"/>
                </div>
                <div class="company">
                    <img src="images/upload/company-2.png" class="img-responsive" alt="company-post"/>
                </div>
                <div class="company">
                    <img src="images/upload/company-3.png" class="img-responsive" alt="company-post"/>
                </div>
                <div class="company">
                    <img src="images/upload/company-4.png" class="img-responsive" alt="company-post"/>
                </div>
                <div class="company">
                    <img src="images/upload/company-5.png" class="img-responsive" alt="company-post"/>
                </div>

            </div>
        </div>
    </div>

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

@section('main_page_container')

@stop

@section('page_content')

@stop

@section('page_specific_js')
    <script src="{{ asset('plugins/typeahead/bootstrap3-typeahead.min.js')}}" type="text/javascript"></script>
    <!-- Select2 -->
    <script src="{!! asset('plugins/select2/select2.full.min.js') !!}"></script>

    <script !src="">

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
    console.log(city_path);
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

@stop
