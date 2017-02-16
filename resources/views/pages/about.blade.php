<?php
/**
 * Author: Chantouch
 * Date: 07-Dec-16
 * Time: 9:36 PM
 */
?>
@extends('webfront.layouts.default')
@section('title', 'Jobs list')
@section('full_content')
    <div class="main-page-title"><!-- start main page title -->
        <div class="container">
            <div class="page-title text-center"><h2>About Us</h2></div>
        </div>
    </div><!-- end main page title -->

    <div id="page-content"><!-- start content -->
        <div class="content-about">
            <div class="container"><!-- container -->
                <div class="spacer-1">&nbsp;</div>
                <div class="row clearfix">
                    <div class="col-md-7">
                        <h6>Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta
                            nobis est eligendi optio cumque nihil impedit quo minus. </h6>
                        <p>
                            Quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.
                            Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut
                            et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a
                            sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis
                            doloribus asperiores repellat.
                        </p>
                    </div>

                    <div class="col-md-5 page-slider-container">
                        <div class="page-slider">
                            <div id="page-slider" class="owl-carousel">
                                <div>
                                    <img src="{!! asset('images/upload/dummy-job-open-1.png') !!}" class="img-responsive"
                                         alt="page-slider"/>
                                </div>

                                <div>
                                    <img src="{!! asset('images/upload/dummy-job-open-2.png') !!}" class="img-responsive"
                                         alt="page-slider"/>
                                </div>

                                <div>
                                    <img src="{!! asset('images/upload/dummy-job-open-1.png') !!}" class="img-responsive"
                                         alt="page-slider"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="spacer-1">&nbsp;</div>
                <div class="row clearfix">
                    <div class="col-md-4">
                        <h5>Who we are</h5>
                        <p>
                            Quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.
                            Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut
                            et voluptates repudiandae sint et molestiae non recusandae.
                        </p>
                    </div>

                    <div class="col-md-4">
                        <h5>What We Do</h5>
                        <p>
                            Quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.
                        </p>

                        <ul class="style-list-1">
                            <li>Quod maxime placeat facere possimus.</li>
                            <li>Omnis voluptas assumenda est.</li>
                            <li>Perferendis doloribus asperiores repellat.</li>
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <h5>&nbsp;</h5>
                        <ul class="style-list-1">
                            <li>Quod maxime placeat facere possimus.</li>
                            <li>Omnis voluptas assumenda est.</li>
                            <li>Perferendis doloribus asperiores repellat.</li>
                            <li>Quod maxime placeat facere possimus.</li>
                            <li>Omnis voluptas assumenda est.</li>
                            <li>Perferendis doloribus asperiores repellat.</li>
                        </ul>
                    </div>
                </div>
                <div class="spacer-2">&nbsp;</div>
            </div><!-- container -->

            <div class="content-about-center"><!-- content -->
                <div class="container">
                    <h2 class="big-title">Smart & easy place for job seeker poster & recruters</h2>
                    <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled</p>
                    <hr/>
                    <div class="spacer-2">&nbsp;</div>
                    <div class="row clearfix">
                        <div class="col-md-4">
                            <p class="centering"><img src="{!! asset('images/icon-about-page-1.png') !!}" class="center-img"
                                                      alt="icon-post-job"/></p>
                            <h6>Post Jobs & Resumes</h6>
                            <p>
                                Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe
                                eveniet ut et voluptates repudiandae sint et molestiae non recusandae.
                            </p>
                        </div>

                        <div class="col-md-4">
                            <p class="centering"><img src="{!! asset('images/icon-about-page-2.png') !!}" class="center-img"
                                                      alt="icon-post-job"/></p>
                            <h6>Search Jobs and Employee</h6>
                            <p>
                                Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe
                                eveniet ut et voluptates repudiandae sint et molestiae non recusandae.
                            </p>
                        </div>

                        <div class="col-md-4">
                            <p class="centering"><img src="{!! asset('images/icon-about-page-3.png') !!}" alt="icon-post-job"/></p>
                            <h6>Better Tie-up</h6>
                            <p>
                                Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe
                                eveniet ut et voluptates repudiandae sint et molestiae non recusandae.
                            </p>
                        </div>
                    </div>
                </div>
            </div><!-- content -->

            <div class="container">
                <div class="spacer-2">&nbsp;</div>
                <div class="row clearfix">
                    <div class="col-md-4">
                        <img src="{!! asset('images/upload/dummy-about.png') !!}" class="img-responsive" alt="image-post"/>
                    </div>
                    <div class="col-md-8">
                        <h4>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                            voluptatum deleniti atque corrupti</h4>
                        <p>
                            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                            voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati
                            cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id
                            est laborum et dolorum fuga.
                        </p>
                        <button class="btn btn-default btn-green">BUTTON</button>
                    </div>
                </div>
                <div class="spacer-2">&nbsp;</div>

                <div class="row clearfix">
                    <div class="col-md-6 about-post-resume">
                        <h4>Post Your Resume</h4>
                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                            voluptatum deleniti atque corrupti quos dolores et quas molestias</p>
                        <p>
                            <button class="btn btn-default btn-black">UPLOAD YOUR RESUME <i
                                        class="icon-upload white"></i></button>
                        </p>
                    </div>
                    <div class="col-md-6 about-post-job">
                        <h4>Post Job Now</h4>
                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                            voluptatum deleniti atque corrupti quos dolores et quas molestias</p>
                        <p>
                            <button class="btn btn-default btn-green">POST A JOB NOW</button>
                        </p>
                    </div>
                </div>
                <div class="spacer-2">&nbsp;</div>
            </div>

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
