@extends('webfront.layouts.default')
@section('title', $job->post_name)
@section('page_specific_styles')

    <style>
        .box {
            position: relative;
            border-radius: 3px;
            background: #ffffff;
            border-top: 1px solid #d2d6de;
            margin-bottom: 20px;
            width: 100%;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }

        .table-bordered tbody tr td {
            text-align: left;
            background: #ffffff none repeat;
            width: 80px;
        }

        .job-detail h6 {
            background: #fff none repeat scroll 0 0;
            padding: 10px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }

        .job-detail p {
            padding-left: 10px;
            line-height: 2;
        }

        .main-page-title {
            background: #f6f6f6 none repeat scroll 0 0;
        }

        .bg-color-table {
            background: #f3f3f3 none repeat !important;
            width: 15% !important;
        }

    </style>
@stop

@section('main_page_container')

    <div class="spacer-1">&nbsp;</div>

    <img src="{!! asset('images/upload/company-3-post.png') !!}" class="img-responsive job-detail-logo"
         alt="company-logo">

    <ul class="meta-job-detail">
        <li><i class="fa fa-link"></i><a href="">Website</a></li>
        <li><i class="fa fa-twitter"></i><a href="">Twitter</a></li>
        <li><i class="fa fa-facebook"></i><a href="">Facebook</a></li>
        <li><i class="fa fa-google-plus"></i><a href="">Google+</a></li>
        <li class="sline">|</li>
        <li><i class="fa fa-list"></i><a href="">More Job</a></li>
        <li><i class="fa fa-tag"></i><a href="">Store</a></li>
        <li class="sline">|</li>
        <li><i class="fa fa-share-square-o"></i><a href="">Share</a></li>
    </ul>

    <div class="recent-job-detail">
        <div class="col-md-5 job-detail-desc">
            <h5>{!! $job->post_name !!}</h5>
            <p>{!! \Illuminate\Support\Str::limit($job->description, 75) !!}</p>
        </div>
        <div class="col-md-2 job-detail-name">
            <h6>{!! $job->employer->organization_name !!}</h6>
        </div>
        <div class="col-md-2 job-detail-location">
            <h6><i class="fa fa-map-marker"></i>{!! $job->city->name !!}</h6>
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-7 job-detail-type">
                    <h6><i class="fa fa-user"></i>{!! $job->job_type !!}</h6>
                </div>
                <div class="col-md-5 job-detail-button">
                    <button class="btn-apply-job">APPLY</button>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="row">
        <div class="col-sm-12">

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
                            <td>USD($) {!! $job->salary_offered_min !!} ~ USD($) {!! $job->salary_offered_max !!}</td>
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
                            <td>{!! $job->q !!}</td>
                        </tr>
                        <tr>
                            <td class="bg-color-table">Age</td>
                            <td>{!! $job->preferred_age_min !!} Years ~ {!! $job->preferred_age_max !!} Years</td>
                            <td class="bg-color-table">
                                Language
                            </td>
                            <td>
                                @foreach($job->languages as $language)
                                    {!! $language->name !!},
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td class="bg-color-table">Published Date</td>
                            <td>{!! $job->created_at !!}</td>
                            <td class="bg-color-table">
                                Closing Date
                            </td>
                            <td>{!! $job->closed_at !!}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div class="row  job-detail">
        <div class="col-md-8">
            <h6>Job Description</h6>
            <p>
                {!! $job->description !!}
            </p>
            <h6>Position Requirements </h6>
            <p>
                {!! $job->requirement_description !!}
            </p>
        </div>

        <div class="col-md-4">
            <h6 style="margin-bottom: 0">Related Jobs</h6>
            <div class="related-job">
                <div class="similar-jobs__content">
                    <div class="js-similar-jobs">
                        @if(count($related_jobs) != 0)
                            @foreach($related_jobs as $related)
                                <div class="similar-job js-similar-job">
                                    <div class="l-similar-job">
                                        <div class="l-similar-job__left">
                                            <a href="#" title="">
                                                <img src="{!!asset(($related->employer->path.$related->employer->photo))!!}"
                                                     class="similar-job__company-img img-responsive">
                                            </a>
                                        </div>
                                        <div class="l-similar-job__right ">
                                    <span class="js-similar-job-title">
                                        <a href="#" class="similar-job__title"
                                           title="{!! $related->post_name !!}">{!! $related->post_name !!}</a>
                                    </span>
                                            <span href="#" class="similar-job__location js-similar-job-location">{!! $related->city->name !!}
                                                , Cambodia</span>
                                            <span href="#"
                                                  class="similar-job__date js-similar-job-expiration-date">2016-11-23</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p> No job</p>
                        @endif
                    </div>
                    <div class="similar-jobs__btn-wrapper">
                        <a href="/en/jobs/similar/46215/" class="btn -btn -btn--grey-border">See more jobs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="spacer-1">&nbsp;</div>

    {{--<div class="container job-detail">--}}
    {{--<div class="spacer-1">&nbsp;</div>--}}
    {{--<h6>BENEFITS</h6>--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-4">--}}
    {{--<ul class="style-list-2">--}}
    {{--<li>On the other hand, we denounce with righteous</li>--}}
    {{--<li>Dislike men who are so beguiled and demoralized</li>--}}
    {{--<li>Charms of pleasure of the moment</li>--}}
    {{--<li>Duty through weakness of will, which is</li>--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--<div class="col-md-4">--}}
    {{--<ul class="style-list-2">--}}
    {{--<li>On the other hand, we denounce with righteous</li>--}}
    {{--<li>Dislike men who are so beguiled and demoralized</li>--}}
    {{--<li>Charms of pleasure of the moment</li>--}}
    {{--<li>Duty through weakness of will, which is</li>--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--<div class="col-md-4">--}}
    {{--<ul class="style-list-2">--}}
    {{--<li>On the other hand, we denounce with righteous</li>--}}
    {{--<li>Dislike men who are so beguiled and demoralized</li>--}}
    {{--<li>Charms of pleasure of the moment</li>--}}
    {{--<li>Duty through weakness of will, which is</li>--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--</div>--}}

@stop

@section('page_content')
    <div class="spacer-1">&nbsp;</div>
    <div class="tab-container" id="tab-container"><!-- Start Recent Job -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4><i class="glyphicon glyphicon-briefcase"></i> RELATED JOBS</h4>
                    <div id="tab-container" class='tab-container'><!-- Start Tabs -->
                        <ul class='etabs clearfix'>
                            <li class='tab'><a href="#all">All</a></li>
                            <li class='tab'><a href="#contract">Contract</a></li>
                            <li class='tab'><a href="#full">Full Time</a></li>
                            <li class='tab'><a href="#free">Free lence</a></li>
                        </ul>
                        <div class='panel-container'>
                            <div id="all"><!-- Tabs section 1 -->
                                @foreach($emp_jobs as $jobs)
                                    <div class="recent-job-list-home"><!-- Tabs content -->
                                        <div class="job-list-logo col-md-1 ">
                                            <img src="{!!asset(($jobs->employer->path.$jobs->employer->photo))!!}"
                                                 class="img-responsive"
                                                 alt="dummy-joblist"/>
                                        </div>
                                        <div class="col-md-5 job-list-desc">
                                            <h6>{!! \Illuminate\Support\Str::limit($jobs->post_name, 35) !!}</h6>
                                            <p>{!! \Illuminate\Support\Str::limit($jobs->description, 50) !!}</p>
                                        </div>
                                        <div class="col-md-6 full">

                                            <div class="job-list-location col-md-5 ">
                                                <h6>
                                                    <i class="fa fa-map-marker"></i>{!! $jobs->city->name !!}
                                                </h6>
                                            </div>
                                            <div class="job-list-type col-md-5 ">
                                                <h6><i class="fa fa-user"></i>{!! $jobs->job_type !!}</h6>
                                            </div>
                                            <div class="col-md-2 job-list-button">
                                                <a href="{!! route('jobs.view.name', [$jobs->employer->organization_name, $jobs->industry->name, $jobs->id,$jobs->slug]) !!}"
                                                   class="btn-view-job">View</a>
                                            </div>

                                        </div>
                                        <div class="clearfix"></div>
                                    </div><!-- Tabs content -->
                                @endforeach

                            </div><!-- Tabs section 1 -->
                            <div id="contract"><!-- Tabs section 2 -->
                                Contract
                            </div><!-- Tabs section 2 -->
                            <div id="full"><!-- Tabs section 3 -->
                                Full time
                            </div><!-- Tabs section 3 -->
                            <div id="free"><!-- Tabs section 4 -->
                                Freelancer
                            </div><!-- Tabs section 4 -->
                        </div>
                    </div><!-- end Tabs -->
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div><!-- end Recent Job -->

    <div id="page-content"><!-- start content -->
        <div class="content-about">

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
                    <h1 class="phone-cs">Call: +855 70 375 783</h1>
                </div>
            </div><!-- CS -->

            <div class="row">
                <div class="container">
                    <div class="spacer-1">&nbsp;</div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Company Profile</div>
                        <div class="panel-body">
                            {!! $job->employer->details !!}
                        </div>
                    </div>
                    <div class="spacer-1">&nbsp;</div>
                </div>
            </div>

        </div><!-- end content -->
    </div>
@stop

@section('page_specific_js')
    <script type="text/javascript">


    </script>
@stop
@section('page_specific_scripts')

@stop
