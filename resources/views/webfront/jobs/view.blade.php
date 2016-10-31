@extends('webfront.layouts.default')

@section('page_specific_styles')

@stop

@section('main_page_container')

    <div class="spacer-1">&nbsp;</div>

    <img src="{!! asset('images/upload/company-3-post.png') !!}" class="img-responsive job-detail-logo" alt="company-logo">

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
            <p>{!! \Illuminate\Support\Str::limit($job->description, 94) !!}</p>
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

    <div class="row  job-detail">
        <div class="col-md-6">
            <h6>OVERVIEW</h6>
            <p>
                At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.
                Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est
                eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas
                assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum
                necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum
                rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut
                perferendis doloribus asperiores repellat.
            </p>
        </div>
        <div class="col-md-6">
            <h6>ABOUT JOB</h6>
            <p>
                At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.
                Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est
                eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas
                assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum
                necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum
                rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut
                perferendis doloribus asperiores repellat.
            </p>
        </div>
    </div>

    <div class="spacer-1">&nbsp;</div>

    <div class="container job-detail">
        <div class="spacer-1">&nbsp;</div>
        <h6>BENEFITS</h6>
        <div class="row">
            <div class="col-md-4">
                <ul class="style-list-2">
                    <li>On the other hand, we denounce with righteous</li>
                    <li>Dislike men who are so beguiled and demoralized</li>
                    <li>Charms of pleasure of the moment</li>
                    <li>Duty through weakness of will, which is</li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="style-list-2">
                    <li>On the other hand, we denounce with righteous</li>
                    <li>Dislike men who are so beguiled and demoralized</li>
                    <li>Charms of pleasure of the moment</li>
                    <li>Duty through weakness of will, which is</li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="style-list-2">
                    <li>On the other hand, we denounce with righteous</li>
                    <li>Dislike men who are so beguiled and demoralized</li>
                    <li>Charms of pleasure of the moment</li>
                    <li>Duty through weakness of will, which is</li>
                </ul>
            </div>
        </div>
        <div class="spacer-1">&nbsp;</div>
        <h6>QUALIFICATION</h6>
        <div class="row">
            <div class="col-md-6">
                <ul class="style-list-2">
                    <li>I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was
                        born and I will give you a complete account of the system.
                    </li>
                    <li>Expound the actual teachings of the great explorer of the truth.</li>
                    <li>Nor again is there anyone who loves or pursues or desires to obtain pain of itself, be causeit
                        is pain.
                    </li>
                    <li>Circumstances occur in which toil and pain can procure him some great pleasure. To take a
                        trivial example, which of us ever undertakes laborious physical
                    </li>
                    <li>Right to find fault with a man who chooses to enjoy a pleasure that has no annoying
                        consequences.
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="style-list-2">
                    <li>I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was
                        born and I will give you a complete account of the system.
                    </li>
                    <li>Expound the actual teachings of the great explorer of the truth.</li>
                    <li>Nor again is there anyone who loves or pursues or desires to obtain pain of itself, be causeit
                        is pain.
                    </li>
                    <li>Circumstances occur in which toil and pain can procure him some great pleasure. To take a
                        trivial example, which of us ever undertakes laborious physical
                    </li>
                    <li>Right to find fault with a man who chooses to enjoy a pleasure that has no annoying
                        consequences.
                    </li>
                </ul>
            </div>
        </div>

    </div>
@stop

@section('page_content')


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

                                <div class="recent-job-list"><!-- Tabs content -->
                                    <div class="col-md-1 job-list-logo">
                                        <img src="{!! asset('images/upload/company-1-post.png') !!}" class="img-responsive" alt="company-logo">
                                    </div>
                                    <div class="col-md-5 job-list-desc">
                                        <h6>Store General Manager</h6>
                                        <p>Similique sunt in culpa qui officia deserunt mollitia animi</p>
                                    </div>
                                    <div class="col-md-3 job-list-location">
                                        <h6><i class="fa fa-map-marker"></i>San Fransisco</h6>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-7 job-list-type">
                                                <h6><i class="fa fa-user"></i>Full Time</h6>
                                            </div>
                                            <div class="col-md-5 job-list-button">
                                                <button class="btn-view-job">View Job</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

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
                    <h1 class="phone-cs">Call: 1 800 000 500</h1>
                </div>
            </div><!-- CS -->
        </div><!-- end content -->
    </div>
@stop

@section('page_specific_js')
    <script type="text/javascript">


    </script>
@stop
@section('page_specific_scripts')

@stop
