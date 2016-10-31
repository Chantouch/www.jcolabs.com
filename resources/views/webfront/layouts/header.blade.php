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
                <li><a href="" class="btn btn-default btn-blue btn-sm">REGISTER</a></li>
                <li><a href="" class="btn btn-default btn-green btn-sm">LOG IN</a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
</div><!-- top -->
<div class="container"><!-- container -->
    <div class="row">
        <div class="col-md-4"><!-- logo -->
            <a href="index.html" title="Job Board" rel="home">
                <img class="main-logo" src="{!! asset('images/logo.png') !!}" alt="job board">
            </a>
        </div><!-- logo -->
        <div class="col-md-8 main-nav"><!-- Main Navigation -->
            <a id="touch-menu" class="mobile-menu" href="#"><i class="fa fa-bars fa-2x"></i></a>
            <nav>
                <ul class="menu">
                    <li><a href="index.html">HOME</a>
                        <ul class="sub-menu">
                            <li><a href="about.html">About Page</a></li>
                            <li><a href="blog.html">Blog Page</a></li>
                            <li><a href="detail-blog.html">Single Blog Page</a></li>
                            <li><a href="job-detail.html">Single Job Page</a></li>
                            <li><a href="homepage-joblisting.html">Job Listing</a></li>
                            <li><a href="contact.html">Contact</a></li>
                            <li><a href="register.html">Register Page</a></li>
                            <li><a href="signin.html">Login Page</a></li>
                            <li><a href="short-codes.html">Short Code</a></li>
                            <li><a href="post-job.html">Post a Job</a></li>
                            <li><a href="post-resume.html">Post a Resume</a></li>
                        </ul>
                    </li>
                    <li><a href="#">JOB SEARCH</a></li>
                    <li><a href="post-job.html">POST A JOB</a></li>
                    <li><a href="post-resume.html">POST A RESUME</a></li>
                    <li><a href="#">PRICING</a></li>
                    <li><a href="short-codes.html">SHORTCODE</a></li>
                </ul>
            </nav>
        </div><!-- Main Navigation -->
        <div class="clearfix"></div>
    </div>
</div><!-- container -->

