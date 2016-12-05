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

        .contact {
            margin: 15px 0 0 0;
        }

        .social-buttons a i.fa-facebook-official:hover {
            color: #3b5998;
            text-decoration: none;
        }

        .social-buttons a i.fa-twitter-square:hover {
            color: #4099ff;
            text-decoration: none;
        }

        .social-buttons a i.fa-google-plus-square:hover {
            color: #d34836;
            text-decoration: none;
        }

        .social-buttons a i.fa-pinterest-square:hover {
            color: #cb2027;
            text-decoration: none;
        }

    </style>
@stop

@section('main_page_container')

    <div class="spacer-1">&nbsp;</div>
    <div class="col-md-12 text-center">
        <h1>{!! $job->post_name !!}</h1>
        <div class="spacer-1">&nbsp;</div>
    </div>
    {{--<img src="{!! asset('images/upload/company-3-post.png') !!}" class="img-responsive job-detail-logo"--}}
    {{--alt="{!!  $job->employer->organization_name !!}">--}}
    @if($job->employer->photo == 'default.jpg')
        <img src="{!!asset('uploads/employers/'.$job->employer->photo)!!}"
             class="img-responsive job-detail-logo"
             alt="{!! $related->post_name !!}"/>
    @else
        <img src="{!!asset('uploads/employers/small/'.$job->employer->id.'/'.$job->employer->photo)!!}"
             class="img-responsive job-detail-logo"
             alt="{!! $job->post_name !!}"/>
    @endif

    <ul class="meta-job-detail">
        <li>
            <i class="fa fa-link"></i>
            <a href="{!! $job->employer->web_address !!}" target="_blank"
               title="{!!  $job->employer->organization_name !!}">Website</a></li>
        <li>
            <i class="fa fa-twitter"></i>
            <a href="{!! $job->employer->twitter_url !!}" target="_blank"
               title="{!!  $job->employer->organization_name !!}">Twitter</a></li>
        <li>
            <i class="fa fa-facebook"></i>
            <a href="{!! $job->employer->fb_url !!}" target="_blank" title="{!!  $job->employer->organization_name !!}">Facebook</a>
        </li>
        <li>
            <i class="fa fa-google-plus"></i>
            <a href="{!! $job->employer->g_plus_url !!}" target="_blank"
               title="{!!  $job->employer->organization_name !!}">Google+</a></li>
        <li class="sline">|</li>
        <li>
            <i class="fa fa-list"></i>
            <a href="{!! route('jobs.view.by.company', [$job->employer->slug]) !!}"
               title="View all job by {!! $job->employer->organization_name !!}">More Job</a></li>
        {{--<li><i class="fa fa-tag"></i><a href="">Store</a></li>--}}
        <li class="sline">|</li>
        <li>
            {{--<i class="fa fa-share-square-o"></i>--}}
            @include('components.share', ['url' =>  route('jobs.view.name', [$job->employer->slug, $job->industry->slug , $job->id,$job->slug])])
            {{--<a href="">Share</a>--}}
        </li>
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
                    <a href="#apply-job" class="btn-apply-job">APPLY</a>
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
                            <td>USD($) {!! \App\Helpers\BaseHelper::moneyFormatCambodia($job->salary_offered_min) !!} ~
                                USD($) {!! \App\Helpers\BaseHelper::moneyFormatCambodia($job->salary_offered_max) !!}</td>
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
                                            <a href="{!! route('jobs.view.by.company', [$related->employer->slug]) !!}"
                                               title="{!! $related->employer->organization_name !!}" target="_blank">
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
                                                <a href="{!! route('jobs.view.name', [$related->employer->slug, $related->industry->slug , $related->id,$related->slug]) !!}"
                                                   class="similar-job__title"
                                                   title="{!! $related->post_name !!}">{!! $related->post_name !!}</a>
                                            </span>
                                            <a href="{!! route('jobs.view.by.city', [$related->city->slug]) !!}"
                                               target="_blank"
                                               class="similar-job__location js-similar-job-location">{!! $related->city->name !!}
                                                , Cambodia</a>
                                            <span class="similar-job__date js-similar-job-expiration-date">{!! $related->closing_date !!}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p> No job</p>
                        @endif
                            {{--{!! Request::fullUrl() !!}--}}
                    </div>
                    <div class="similar-jobs__btn-wrapper">
                        <a href="#" class="btn btn-default">See more jobs</a>
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

    <div class="job-detail" id="apply-job">
        <div id="page-content"><!-- start content -->
            <h6>Apply this job</h6>
            <div class="content-about">
                <div class="container">
                    {!! Form::open(['route' => ['job.candidate.apply', $job->id], 'class'=>'contact', 'role'=>'form', 'id'=>'apply-job', 'files'=>'true']) !!}
                    <div class="form-group col-md-6{!! $errors->has('name') ? ' has-error' : '' !!}">
                        <label for="name">Name:</label>
                        {!! Form::text('name', null, ['class' => 'form-control name', 'id'=>'name']) !!}

                        @if($errors->has('name'))
                            <span class="help-block">
                                <strong>{!! $errors->first('name') !!}</strong>
                            </span>
                        @endif

                    </div>

                    <div class="form-group col-md-6{!! $errors->has('email') ? ' has-error' : '' !!}">
                        <label for="email">Email:</label>
                        {!! Form::text('email', null, ['class'=>'form-control email', 'id'=>'email']) !!}
                        @if($errors->has('email'))
                            <span class="help-block">
                                <strong>{!! $errors->first('email') !!}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6{!! $errors->has('phone') ? ' has-error' : '' !!}">
                        <label for="phone">Tel:</label>
                        {!! Form::text('phone', null, ['class' => 'form-control phone', 'id'=>'phone']) !!}
                        @if($errors->has('phone'))
                            <span class="help-block">
                                <strong>{!! $errors->first('phone') !!}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6{!! $errors->has('subject') ? ' has-error' : '' !!}">
                        <label for="subject">Subject:</label>
                        {!! Form::text('subject', null, ['class'=>'form-control subject', 'id'=>'subject']) !!}
                        @if($errors->has('subject'))
                            <span class="help-block">
                                <strong>{!! $errors->first('subject') !!}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-12{!! $errors->has('message') ? ' has-error' : '' !!}">
                        <label for="message">Message:</label>
                        {!! Form::textarea('message', null, ['class'=>'form-control message', 'id'=>'message', 'rows'=>'8'  ,'placeholder'=>'Describe about yourself that want to apply this position']) !!}
                        @if($errors->has('message'))
                            <span class="help-block">
                                <strong>{!! $errors->first('message') !!}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6{!! $errors->has('cv') ? ' has-error' : '' !!}">
                        <label for="cv">CV:</label>
                        {!! Form::file('cv', null, ['id'=>'cv']) !!}
                        @if($errors->has('cv'))
                            <span class="help-block">
                                <strong>{!! $errors->first('cv') !!}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-12">
                        <button class="btn btn-default btn-green" type="submit" name="submit" id="submit">APPLY
                        </button>
                    </div>

                    <div class="clearfix"></div>
                    {!! Form::close() !!}
                </div>
            </div><!-- end content -->
        </div><!-- end page content -->
        <div class="spacer-1"></div>
    </div>

@stop

@section('page_content')
    <div class="spacer-1">&nbsp;</div>
    <div class="tab-container" id="tab-container"><!-- Start Recent Job -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4><i class="glyphicon glyphicon-briefcase"></i> RELATED JOBS</h4>

                    {{--Tab jos--}}
                    @include('components.tab_jobs')
                    {{--Tab jos--}}

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
        var popupSize = {
            width: 780,
            height: 550
        };

        $(document).on('click', '.social-buttons > a', function (e) {

            var
                verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
                horisontalPos = Math.floor(($(window).height() - popupSize.height) / 2);

            var popup = window.open($(this).prop('href'), 'social',
                'width=' + popupSize.width + ',height=' + popupSize.height +
                ',left=' + verticalPos + ',top=' + horisontalPos +
                ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

            if (popup) {
                popup.focus();
                e.preventDefault();
            }

        });
    </script>
@stop
@section('page_specific_scripts')
    new WOW().init();
@stop
