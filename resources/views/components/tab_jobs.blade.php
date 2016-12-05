<div id="tab-container" class='tab-container'><!-- Start Tabs -->
    <ul class='etabs clearfix'>
        <li class='tab'><a href="#all">All</a></li>
        <li class='tab'><a href="#full">Full Time</a></li>
        <li class='tab'><a href="#part_time">Part Time</a></li>
        <li class='tab'><a href="#internship">Internship</a></li>
        <li class='tab'><a href="#contract">Contract</a></li>
    </ul>
    <div class='panel-container'>

        <div id="all"><!-- Tabs section 1 -->
            @if(!empty($posted_jobs))
                @foreach ($posted_jobs as $job)
                    <div class="recent-job-list-home"><!-- Tabs content -->
                        <div class="job-list-logo col-md-1 ">
                            @if($job->employer->photo == 'default.jpg')
                                <img src="{!!asset('uploads/employers/'.$job->employer->photo)!!}"
                                     class="img-responsive"
                                     alt="{!! $job->post_name !!}"/>
                            @else
                                @if(Request::segment(3) == "view")
                                    <img src="{!!asset('uploads/employers/profile/'.$job->employer->id.'/'.$job->employer->photo)!!}"
                                         class="img-responsive"
                                         alt="{!! $job->post_name !!}"/>
                                @else
                                    <img src="{!!asset('uploads/employers/avatar/'.$job->employer->id.'/'.$job->employer->photo)!!}"
                                         class="img-responsive"
                                         alt="{!! $job->post_name !!}"/>
                                @endif
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
                            <div class="job-list-type col-md-4 ">
                                <h6><i class="fa fa-user"></i>{!! $job->job_type !!}</h6>
                            </div>
                            <div class="col-md-3 job-list-button">
                                <h6 class="pull-right">
                                    <a href="{!! route('jobs.view.name', [$job->employer->slug, $job->industry->slug , $job->id,$job->slug]) !!}"
                                       class="btn-view-job">View</a>
                                </h6>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- Tabs content -->
                @endforeach
            @else
                <div class="recent-job-list-home"><!-- Tabs content -->
                    <span>There is no job available here!!</span>
                </div>
            @endif
        </div><!-- Tabs section 1 -->

        <div id="contract"><!-- Tabs section 2 -->
            @if(!empty($job_contracts))
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
                                <a href="{!! route('jobs.view.name', [$job->employer->slug, $job->industry->slug , $job->id,$job->slug]) !!}"
                                   class="btn-view-job">View</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- Tabs content -->
                @endforeach
            @else
                <div class="recent-job-list-home"><!-- Tabs content -->
                    <span>There is no job available here!!</span>
                </div>
            @endif
        </div><!-- Tabs section 2 -->

        <div id="full"><!-- Tabs section 3 -->
            @if(!empty($job_full_time))
                @foreach ($job_full_time as $job)
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
                                <a href="{!! route('jobs.view.name', [$job->employer->slug, $job->industry->slug , $job->id,$job->slug]) !!}"
                                   class="btn-view-job">View</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- Tabs content -->
                @endforeach
            @else
                <div class="recent-job-list-home"><!-- Tabs content -->
                    <span>There is no job available here!!</span>
                </div>
            @endif
        </div><!-- Tabs section 3 -->

        <div id="internship"><!-- Tabs section 4 -->
            @if(!empty($internship))
                @foreach ($internship as $job)
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
                                <a href="{!! route('jobs.view.name', [$job->employer->slug, $job->industry->slug , $job->id,$job->slug]) !!}"
                                   class="btn-view-job">View</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- Tabs content -->
                @endforeach
            @else
                <div class="recent-job-list-home"><!-- Tabs content -->
                    <span>There is no job available here!!</span>
                </div>
            @endif
        </div><!-- Tabs section 4 -->

        <div id="part_time">
            @if(!empty($part_time))
                @foreach ($part_time as $job)
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
                                <a href="{!! route('jobs.view.name', [$job->employer->slug, $job->industry->slug , $job->id,$job->slug]) !!}"
                                   class="btn-view-job">View</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- Tabs content -->
                @endforeach
            @else
                <div class="recent-job-list-home"><!-- Tabs content -->
                    <span>There is no job available here!!</span>
                </div>
            @endif
        </div>

    </div>
</div><!-- end Tabs -->