@extends('webfront.layouts.default')
@section('title', $job->post_name)
@section('page_specific_styles')
    <link href="{{ asset('plugins/animate/animate.css') }}" rel="stylesheet" type="text/css"/>
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
            background: #8cddcd none repeat scroll 0 0;
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

        .table > thead > tr > th.no-border {
            border-bottom: none;
        }

        table.contact-information > tbody > tr > td, table.contact-information > tbody > tr > th,
        table.contact-information > tfoot > tr > td, table.contact-information > tfoot > tr > th,
        table.contact-information > thead > tr > td, table.contact-information > thead > tr > th {
            padding: 15px;
        }

        table.contact-information > tbody > tr:last-child, table.contact-information > tbody > tr:last-child,
        table.contact-information > tfoot > tr:last-child, table.contact-information > tfoot > tr:last-child,
        table.contact-information > thead > tr:last-child, table.contact-information > thead > tr:last-child {
            border-bottom: 1px solid #ddd;
        }

        td .label {
            font-size: 14px !important;
            padding: 0 3px 0 5px !important;
            margin: 0.15em !important;
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
                            <td>{!! $job->qualification->name !!}</td>
                        </tr>
                        <tr>
                            <td class="bg-color-table">Age</td>
                            <td>{!! $job->preferred_age_min !!} Years ~ {!! $job->preferred_age_max !!} Years</td>
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
                                                @if($related->employer->photo == 'default.jpg')
                                                    <img src="{!!asset('uploads/employers/'.$related->employer->photo)!!}"
                                                         class="similar-job__company-img img-responsive"
                                                         alt="{!! $related->post_name !!}"/>
                                                @else
                                                    <img src="{!!asset($related->employer->path.$related->employer->photo)!!}"
                                                         class="similar-job__company-img img-responsive"
                                                         alt="{!! $related->post_name !!}"/>
                                                @endif
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

    <div class="container job-detail">
        <h6>Contact Information</h6>
        <div class="row">
            <div class="col-md-12">
                <table class="table contact-information">
                    @if(!empty($job->employer->contact_id))
                        @foreach($job->employer->contacts as $contact)
                            <thead>
                            <tr>
                                <th class="col-md-2 col-xs-5 no-border">Contact Name:</th>
                                <td>{!! $contact->contact_name !!}</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>Department:</th>
                                <td>{!! $contact->department->name !!}</td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td>{!! $contact->phone_number !!}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td><a href="mailto:{!! $contact->email !!}" target="_top">{!! $contact->email !!}</a>
                                </td>
                            </tr>
                            <tr>
                                <th>Website:</th>
                                <td><a href="{!! $job->employer->web_address !!}"
                                       target="_blank">{!! $job->employer->web_address !!}</a></td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>{!! $job->employer->address !!}</td>
                            </tr>
                            </tbody>
                        @endforeach
                    @else
                        <thead>
                        <tr>
                            <th class="col-md-2 col-xs-5 no-border">Contact Name:</th>
                            <td>{!! $job->employer->contact_name !!}</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>Phone:</th>
                            <td>{!! $job->employer->contact_mobile_no !!}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td><a href="mailto:{!! $job->employer->email !!}"
                                   target="_top">{!! $job->employer->email !!}</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Website:</th>
                            <td>
                                @if(!empty($job->employer->web_address))
                                    <a href="{!! $job->employer->web_address !!}"
                                       target="_blank">{!! $job->employer->web_address !!}</a>
                                @else
                                    <a href="www.jcolabs.com"
                                       target="_blank">www.jcolabs.com</a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Address:</th>
                            <td>{!! $job->employer->address !!}</td>
                        </tr>
                        </tbody>
                    @endif
                </table>
            </div>
        </div>
        <div class="spacer-1">&nbsp;</div>
    </div>

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

    <!-- Start page content -->
    @include('webfront.jobs.page-content')
    <!--End page content -->

    <!-- ###################### Feature Search ##################### -->
    @include('webfront.jobs.feature-search')
    <!--End Feature search -->

@stop

@section('page_specific_js')

    <script src="{{ asset('plugins/wow/wow.min.js')}}" type="text/javascript"></script>

    <script type="text/javascript">


    </script>
@stop
@section('page_specific_scripts')
    new WOW().init();
@stop
