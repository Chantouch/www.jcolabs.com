@section('page_specific_styles')
    <style>
        .main-logo {
            margin-top: -0.09%;
        }
    </style>
@stop

<div class="top-line">&nbsp;</div>
<div class="top"><!-- top -->
    <div class="container">
        <div class="media-top-right">
            <ul class="media-top clearfix">
                <li class="item"><a href="" target="blank"><i class="fa fa-twitter"></i></a></li>
                <li class="item"><a href="" target="blank"><i class="fa fa-facebook"></i></a></li>
                <li class="item"><a href="" target="blank"><i class="fa fa-linkedin"></i></a></li>
                <li class="item"><a href="" target="blank"><i class="fa fa-rss"></i></a></li>
                <li class="item"><a href="" target="blank"><i class="fa fa-google-plus"></i></a></li>
            </ul>
            <ul class="media-top-2 clearfix">
                @if (!Auth::guard('candidate')->user())
                    <li>
                        <a href="{!! route('candidate.process.register') !!}" class="btn btn-default btn-blue btn-sm">REGISTER</a>
                    </li>
                    <li>
                        <a href="{!! route('candidate.process.login') !!}" class="btn btn-default btn-green btn-sm">LOG
                            IN</a>
                    </li>
                @else
                    <li>
                        <a href="{!! route('candidate.dashboard') !!}" class="btn btn-default btn-blue btn-sm">
                            <span>Hi&nbsp;</span>{{ Auth::guard('candidate')->user()->name }}</a>
                    </li>
                    <li>
                        <a href="{!! route('candidate.process.logout') !!}" class="btn btn-default btn-blue btn-sm"
                           onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                            Log Out
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('candidate.process.logout') }}" method="POST"
                          style="display: none;">
                        {{ csrf_field() }}
                    </form>

                @endif
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
</div><!-- top -->
<div class="container"><!-- container -->
    <div class="row">
        <div class="col-md-4 col-xs-12"><!-- logo -->
            <a href="{!! route('home') !!}" title="Job Board" rel="home">
                <img class="main-logo img-responsive text-center" src="{!! asset('images/logo.png') !!}" alt="job board">
            </a>
        </div><!-- logo -->
        <div class="col-md-8 col-xs-12 main-nav"><!-- Main Navigation -->
            <a id="touch-menu" class="mobile-menu" href="#"><i class="fa fa-bars fa-2x"></i></a>
            <nav>
                <ul class="menu">
                    <li><a href="{!! route('home') !!}">HOME</a>
                        {{--<ul class="sub-menu">--}}
                        {{--<li><a href="about.html">About Page</a></li>--}}
                        {{--</ul>--}}
                    </li>
                    <li><a href="{!! route('job.search') !!}">JOB SEARCH</a></li>
                    <li><a href="{!! route('employer.postJobs.create') !!}">POST A JOB</a></li>
                    <li><a href="{!! route('candidate.attachments.create') !!}">POST A RESUME</a></li>
                    <li><a href="{!! route('pages.about') !!}">About Us</a></li>
                    <li><a href="{!! route('candidate.attachments.create') !!}">Feedback</a></li>
                </ul>
            </nav>
        </div><!-- Main Navigation -->
        <div class="clearfix"></div>
    </div>
</div><!-- container -->

