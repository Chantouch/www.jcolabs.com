@extends('webfront.layouts.default')

@section('page_specific_styles')

@stop

@section('full_content')

    <div class="job-finder"><!-- start job finder -->
        <div class="container">
            <h3>Job Listing</h3>
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
                        @foreach($cat as $job)
                            <div class="recent-job-list"><!-- Tabs content -->
                                <div class="col-md-1 job-list-logo">
                                    <img src="{!! asset('images/upload/company-1.png') !!}" class="img-responsive"
                                         alt="company-logo"/>
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
                            </div><!-- Tabs content -->
                        @endforeach
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
                            <img src="images/upload/dummy-job-open-2.png" class="img-responsive" alt="job-opening"/>
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
                            <img src="images/upload/dummy-job-open-1.png" class="img-responsive" alt="job-opening"/>
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
                            <img src="images/upload/dummy-job-open-2.png" class="img-responsive" alt="job-opening"/>
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
                            <img src="images/upload/dummy-job-open-1.png" class="img-responsive" alt="job-opening"/>
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
