@if(Request::segment(2) == "search")
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
            @foreach($top_jobs as $job)
                <div class="item-listing">
                    <div class="job-opening">
                        <a href="{!! route('jobs.view.by.company', [$job->employer->slug]) !!}"
                           title="{!! $job->employer->organization_name !!}" target="_blank">
                            @if($job->employer->photo == 'default.jpg')
                                <img src="{!!asset('uploads/employers/'.$job->employer->photo)!!}"
                                     class="img-responsive"
                                     alt="{!! $job->employer->organization_name !!}"/>
                            @else
                                <img src="{!!asset($job->employer->path.$job->employer->photo)!!}"
                                     class="img-responsive"
                                     alt="{!! $job->employer->organization_name !!}"/>
                            @endif
                        </a>
                        <div class="job-opening-content">
                            <a href="{!! route('jobs.view.name', [$job->employer->slug, $job->industry->slug , $job->id,$job->slug]) !!}"
                               target="_blank"
                               title="{!! $job->post_name!!} at {!! $job->employer->organization_name !!}">{!! $job->post_name!!}</a>
                            <p>
                                {!! \Illuminate\Support\Str::limit($job->description, 100) !!}
                            </p>
                        </div>
                        <div class="job-opening-meta clearfix">
                            <div class="meta-job-location meta-block">
                                <i class="fa fa-map-marker"></i>
                                <a href="{!! route('jobs.view.by.city', [$job->city->slug]) !!}"
                                   title="{!!$job->city->name !!}" target="_blank">{!!$job->city->name !!}</a>
                            </div>
                            <div class="meta-job-type meta-block">
                                <i class="fa fa-user"></i> {!!$job->job_type!!}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div><!-- job opening carousel item -->
    </div>
@else
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
                        <a href="{!! route('jobs.view.by.company', [$job->employer->slug]) !!}"
                           title="{!! $job->employer->organization_name !!}" target="_blank">
                            @if($job->employer->photo == 'default.jpg')
                                <img src="{!!asset('uploads/employers/'.$job->employer->photo)!!}"
                                     class="img-responsive"
                                     alt="{!! $job->employer->organization_name !!}"/>
                            @else
                                <img src="{!!asset($job->employer->path.$job->employer->photo)!!}"
                                     class="img-responsive"
                                     alt="{!! $job->employer->organization_name !!}"/>
                            @endif
                        </a>
                        <div class="job-opening-content">
                            <a href="{!! route('jobs.view.name', [$job->employer->slug, $job->industry->slug , $job->id,$job->slug]) !!}"
                               target="_blank"
                               title="{!! $job->post_name!!} at {!! $job->employer->organization_name !!}">{!! $job->post_name!!}</a>
                            <p>
                                {!! \Illuminate\Support\Str::limit($job->description, 100) !!}
                            </p>
                        </div>
                        <div class="job-opening-meta clearfix">
                            <div class="meta-job-location meta-block">
                                <i class="fa fa-map-marker"></i>
                                <a href="{!! route('jobs.view.by.city', [$job->city->slug]) !!}"
                                   title="{!!$job->city->name !!}" target="_blank">{!!$job->city->name !!}</a>
                            </div>
                            <div class="meta-job-type meta-block">
                                <i class="fa fa-user"></i>
                                {!!$job->job_type!!} </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endif