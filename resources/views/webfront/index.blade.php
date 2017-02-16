@extends('webfront.layouts.default')
@section('title', 'Jobs list')
@section('page_specific_styles')
    <link href="{{ asset('plugins/animate/animate.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Select2 -->
    <link rel="stylesheet" href="{!! asset('plugins/select2/select2.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('plugins/ion-range-slider/css/ion.rangeSlider.css') !!}">
    <link rel="stylesheet" href="{!! asset('plugins/ion-range-slider/css/ion.rangeSlider.skinFlat.css') !!}">

@stop

@section('full_content')

    <div class="main-slider"><!-- start main-headline section -->
        <div class="slider-nav">
            <a class="slider-prev"><i class="fa fa-chevron-circle-left"></i></a>
            <a class="slider-next"><i class="fa fa-chevron-circle-right"></i></a>
        </div>
        <div id="home-slider" class="owl-carousel owl-theme">
            <div class="owl-wrapper-outer">
                <div class="owl-wrapper">
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
                    <div class="owl-item">
                        <div class="item-slide">
                            <img src="{!! asset('webfront/images/upload/dummy-slide-2.jpg')!!}" class="img-responsive"
                                 alt="dummy-slide">
                        </div>
                    </div>
                    <div class="owl-item">
                        <div class="item-slide">
                            <img src="{!! asset('webfront/images/upload/dummy-slide-1.jpg')!!}" class="img-responsive"
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
                <p>
                    The price of success is hard work, dedication to the job at hand, and the determination that whether
                    we win or lose, we have applied the best of ourselves to the task at hand.
                </p>
                <p><a href="{!! route('job.search') !!}" class="btn btn-default btn-yellow">Find a Job</a></p>
            </div>
            <div class="col-md-6 align-left">
                <h4>Hire Skilled People, best of them</h4>
                <p>
                    Understand, our police officers put their lives on the line for us every single day. They've got a
                    tough job to do to maintain public safety and hold accountable those who break the law.
                </p>
                <p><a href="{!! route('employer.postJobs.create') !!}" class="btn btn-default btn-light">Post a Job</a>
                </p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div><!-- end headline section -->

    <!-- start job finder -->
    @include('components.search')
    <!-- end job finder -->

    <div class="recent-job"><!-- Start Recent Job -->
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h4><i class="glyphicon glyphicon-briefcase"></i> Recent Job</h4>

                    {{--Tab jos--}}
                    @include('components.tab_jobs')
                    {{--Tab jos--}}

                    <div class="spacer-2"></div>
                </div>

                <div class="col-md-4">

                    {{--Opening jobs--}}
                    @include('components.opening_jobs')
                    {{--Opening jobs--}}

                    <div class="post-resume-title">Post Your Resume</div>
                    <div class="post-resume-container">
                        {{--<button type="button" class="post-resume-button">Upload Your Resume--}}
                        {{--<i class="icon-upload grey"></i></button>--}}
                        <a href="{!! route('candidate.attachments.create') !!}" class="post-resume-button text-center">Upload
                            Your Resume
                            <i class="icon-upload grey"></i></a>
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
                A leader's job is not to do the work for others, it's to help others figure out how to do it themselves,
                to get things done, and to succeed beyond what they thought possible.
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
                    <div class="counter-value">{!! count($companies) !!}</div>
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
            <h1 class="wow fadeInDown" data-wow-delay="0.3s">Easiest Way To Use</h1>
            <p class="wow bounceIn" data-wow-delay="0.6s">
                People don't want to go to the dump and have a picnic, they want to go out to a beautiful place and
                enjoy their day. And so I think our job is to try to take the environment, take what the good Lord has
                given us, and expand upon it or enhance it, without destroying it.
            </p>

            <div class="step-spacer"></div>
            <div id="step-image">
                <div class="step-by-container">
                    <div class="step-by wow fadeInUp" data-wow-delay="0.3s">
                        First Step
                        <div class="step-by-inner">
                            <div class="step-by-inner-img">
                                <img src="{!! asset('images/step-icon-1.png') !!}" class="img-responsive" alt="step"/>
                            </div>
                        </div>
                        <h5>Register with us</h5>
                    </div>

                    <div class="step-by wow fadeInUp" data-wow-delay="0.6s">
                        Second Step
                        <div class="step-by-inner">
                            <div class="step-by-inner-img">
                                <img src="{!! asset('images/step-icon-2.png') !!}" class="img-responsive" alt="step"/>
                            </div>
                        </div>
                        <h5>Create your profile</h5>
                    </div>

                    <div class="step-by wow fadeInUp" data-wow-delay="0.9s">
                        Third Step
                        <div class="step-by-inner">
                            <div class="step-by-inner-img">
                                <img src="{!! asset('images/step-icon-3.png') !!}" class="img-responsive" alt="step"/>
                            </div>
                        </div>
                        <h5>Upload your resume</h5>
                    </div>

                    <div class="step-by wow fadeInUp" data-wow-delay="1.2s">
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
                The job market of the future will consist of those jobs that robots cannot perform. Our blue-collar work
                is pattern recognition, making sense of what you see. Gardeners will still have jobs because every
                garden is different. The same goes for construction workers. The losers are white-collar workers,
                low-level accountants, brokers, and agents.
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
                A good job is more than just a paycheck. A good job fosters independence and discipline, and contributes
                to the health of the community. A good job is a means to provide for the health and welfare of your
                family, to own a home, and save for retirement.
            </p>

            <div id="company-post-list" class="owl-carousel company-post">
                @if(!empty($companies))
                    @foreach($companies as $com)
                        <div class="company">
                            @if($com->photo != 'default.jpg')
                                <img class="profile-user-img img-responsive"
                                     src="{!! asset($com->path.'/'.$com->photo) !!}"
                                     alt="{!! $com->contact_name !!}">
                            @else
                                <img src="{!! asset('uploads/employers/' .$com->photo) !!}"
                                     class="profile-user-img img-responsive"
                                     alt="{!! $com->contact_name !!}"/>
                            @endif
                        </div>
                    @endforeach
                @endif

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
    @include('webfront.jobs.feature-search')
    <!--End Feature search -->

@stop

@section('main_page_container')

@stop

@section('page_content')

@stop

@section('page_specific_js')
    <script src="{{ asset('plugins/typeahead/bootstrap3-typeahead.min.js')}}" type="text/javascript"></script>
    <!-- Select2 -->
    <script src="{!! asset('plugins/select2/select2.full.min.js') !!}"></script>
    <script src="{{ asset('plugins/wow/wow.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('plugins/ion-range-slider/js/ion.rangeSlider.min.js')}}" type="text/javascript"></script>

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
    $('#name').typeahead({
    source: function (query, process) {
    return $.get(path, {query: query}, function (data) {
    return process(data);
    })
    }
    });

    $('#city').typeahead({
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
    max: 3000,
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
