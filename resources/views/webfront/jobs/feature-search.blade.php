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
                        <span><i class="fa fa-cloud-download"></i></span>
                        <p class="stats-count" data-from="0" data-to="890" data-speed="1500">34353</p>
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
                        <span><i class="fa fa-user"></i></span>
                        <p class="stats-count" data-from="0" data-to="900" data-speed="2000">95600</p>
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
                        <span><i class="fa fa-bookmark-o"></i></span>
                        <p class="stats-count" data-from="0" data-to="560" data-speed="1500">5600</p>
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
                        <span><i class="fa fa-star-half-o"></i></span>
                        <p class="stats-count" data-from="0" data-to="4.5" data-speed="4000">4.5</p>
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
            <div class="text-center wow zoomInUp"data-wow-delay="1.3s">
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