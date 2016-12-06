<section id="stat">
    <div class="overlay">
        <div class="row">
            <div class="section-heading">
                <h2 class="wow fadeInDown">Search for your <span class="theme-color">Jobs</span></h2>
            </div>
        </div>
        <div class="section-content">
            <div class="container">
                <ul class="list-header">
                    <!--======= Search By Category =========-->
                    <li class="col-md-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                        <h3>Search By Function</h3>
                        <span><i class="fa fa-coffee"></i></span>
                        <ul>
                            @foreach($category as $cat)
                                <li><a href="{!! route('jobs.view.by.function',[$cat->slug]) !!}">{!! $cat->name !!}
                                        ( {!! count($cat->jobs) !!} )</a></li>
                            @endforeach
                        </ul>
                        <a href="{!! route('jobs.search.by.function.all') !!}" class="btn btn-blue m-t-25">View All</a>
                    </li>
                    <!--======= Search By Industry =========-->
                    <li class="col-md-3 col-sm-6 wow fadeInUp" data-wow-delay="0.6s">
                        <h3>Search By Industry</h3>
                        <span><i class="fa fa-industry"></i></span>
                        <ul>
                            @foreach($industry as $ind)
                                <li><a href="{!! route('jobs.view.by.industry', [$ind->slug]) !!}">{!! $ind->name !!}
                                        ( {!! count($ind->jobs) !!} )</a></li>
                            @endforeach
                        </ul>
                        <a href="{!! route('jobs.search.by.industry.all') !!}" class="btn btn-blue m-t-25">View All</a>
                    </li>
                    <!--======= Search by Company =========-->
                    <li class="col-md-3 col-sm-6 wow fadeInUp" data-wow-delay="0.9s">
                        <h3>Search by Company</h3>
                        <span><i class="fa fa-briefcase" aria-hidden="true"></i></span>
                        <ul>
                            @foreach($company as $com)
                                <li>
                                    <a href="{!! route('jobs.view.by.company', [$com->slug]) !!}">{!! $com->organization_name !!}
                                        ( {!! count($com->jobs) !!} )</a>
                                </li>
                            @endforeach
                        </ul>

                        <a href="{!! route('jobs.search.by.company.all') !!}" class="btn btn-blue m-t-25">View All</a>
                    </li>
                    <!--======= Search by City =========-->
                    <li class="col-md-3 col-sm-6 wow fadeInUp" data-wow-delay="1.2s">
                        <h3>Search by City</h3>
                        <span><i class="fa fa-building-o"></i></span>
                        <ul>
                            @foreach($city as $ci)
                                <li><a href="{!! route('jobs.view.by.city', [$ci->slug]) !!}">{!! $ci->name !!}
                                        ( {!! count($ci->jobs) !!} )</a></li>
                            @endforeach
                        </ul>

                        <a href="{!! route('jobs.search.by.city.all') !!}" class="btn btn-blue m-t-25">View All</a>
                    </li>
                </ul>
            </div>
            <div class="text-center wow zoomInUp" data-wow-delay="1.3s">
                <div class="spacer-1"></div>
                <a href="{!! route('job.search') !!}" class="btn btn-default btn-green btn-lg">View All</a>
            </div>
            <!-- container -->
        </div>
        <!-- section-content -->
    </div>
    <!-- overlay black -->
</section>
<!-- #stat -->