<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Job, Career and Opportunity Lab {{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap 3.3.4 -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Main Style -->
    <link href="{{ asset('webfront/css/style.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Main Style -->
    <!-- noty cross briser animate css -->
    <link href="{{ asset('plugins/noty/animate.css') }}" rel="stylesheet" type="text/css"/>
    <!-- fonts -->
    <link href="{{ asset('font-awesome/4.4.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href='http://fonts.googleapis.com/css?family=Nunito:300,400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700' rel='stylesheet' type='text/css'>
    <!-- fonts -->
    <!-- Owl Carousel -->
    <link href="{{ asset('plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('plugins/owl-carousel/owl.theme.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('plugins/owl-carousel/owl.transitions.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Owl Carousel -->

    <!-- Form Slider -->
    <link href="{{ asset('plugins/form-slider/jslider.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('plugins/form-slider/jslider.round.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Form Slider -->

    <link href="{{ asset('css/jcolabs.css') }}" rel="stylesheet" type="text/css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('page_specific_styles')

</head>
<body>
<div id="wrapper"><!-- start main wrapper -->
    <div id="header"><!-- start main header -->

        @include('webfront.layouts.header')

    </div><!-- end main header -->

    @yield('full_content')
    <div class="main-page-title"><!-- start main page title -->
        <div class="container">

            @if (Session::has('alert'))
                <div class="alert alert-warning alert-dismissable job-alert alert-red">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i
                                class="fa fa-times-circle"></i></button>
                    {!!Session::get('alert')!!}
                </div>
            @endif

            @yield('main_page_container')
        </div>
    </div><!-- end main page title -->

    @yield('content')

    <div id="page-content">
        @yield('page_content')
    </div>

    <div id="footer"><!-- Footer -->
        @include('webfront.layouts.footer')
    </div><!-- Footer -->
</div><!-- end main wrapper -->

<!-- jQuery 2.1.4 -->
<script src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js')}}" type="text/javascript"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<!-- noty -->
<script type="text/javascript" src="{{ asset('plugins/noty/packaged/jquery.noty.packaged.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('plugins/noty/themes/bootstrap.js')}}"></script>
<!-- Tabs -->
<script src="{{ asset('plugins/easytabs/jquery.easytabs.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('plugins/easytabs/modernizr.custom.49511.js')}}" type="text/javascript"></script>
<!-- Tabs -->

<!-- Owl Carousel -->
<script src="{{ asset('plugins/owl-carousel/owl.carousel.js')}}" type="text/javascript"></script>
<!-- Owl Carousel -->

<!-- Form Slider -->
<script src="{{ asset('plugins/form-slider/jshashtable-2.1_src.js')}}" type="text/javascript"></script>
<script src="{{ asset('plugins/form-slider/jquery.numberformatter-1.2.3.js')}}" type="text/javascript"></script>
<script src="{{ asset('plugins/form-slider/tmpl.js')}}" type="text/javascript"></script>
<script src="{{ asset('plugins/form-slider/jquery.dependClass-0.1.js')}}" type="text/javascript"></script>
<script src="{{ asset('plugins/form-slider/draggable-0.1.js')}}" type="text/javascript"></script>
<script src="{{ asset('plugins/form-slider/jquery.slider.js')}}" type="text/javascript"></script>
<!-- Form Slider -->
<!-- Map -->
<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<!-- Map -->
<script src="{{ asset('webfront/js/job-board.js')}}" type="text/javascript"></script>

<script src="{{ asset('webfront/js/main.js')}}" type="text/javascript"></script>

<script src="{{ asset('js/jcolabs.js')}}" type="text/javascript"></script>

@yield('page_specific_js')

<script type="text/javascript">
    $(document).ready(function () {

        @yield('page_specific_scripts')

        @if (Session::has('error'))
            notify('{!! Session::get('error')!!}', 'error', 'topCenter');
        @endif
        @if (Session::has('message') && !$errors->any())
            notify('{!! Session::get('message')!!}', 'success', 'topCenter');
        @endif
        @if ($errors->any())
        {!! implode('', $errors->all('notify(\':message\', \'warning\'); ')) !!}
        @endif
    });
</script>

</body>
</html>
