@extends('webfront.layouts.default')

@section('page_specific_styles')

    <link href="{{ asset('plugins/jQueryUI/jquery-ui-1.10.3.custom.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('plugins/datepicker/datepicker3.css')}}" rel="stylesheet" type="text/css"/>

    <style>
        .form-horizontal .form-group {
            margin-right: 0 !important;
        }

        .aug_group {
            /*background-color: #ECF0F1;*/
        }

        .aug_legend {
            /*width: 100%;*/
            font-family: Verdana, Geneva, Tahoma, Arial, Helvetica, sans-serif;
            display: inline-block;
            color: #FFFFFF;
            /*background-color: #8AC007;*/
            background-color: #1abc9c;
            font-size: 15px;
            text-align: center;
            padding: 5px 16px;
            text-decoration: none;
            /*margin-left: -15px;
            margin-right: 15px;*/
            margin-top: 0px;
            margin-bottom: 10px;
            /*border: 1px solid #8AC007;*/
            white-space: nowrap;
        }

        .p-l-0 {
            padding-left: 0;
        }

        .caption div {
            box-shadow: 0 0 5px #C8C8C8;
            transition: all 0.3s ease 0s;
        }

        .img-circle {
            border-radius: 50%;
        }

        .img-circle {
            border-radius: 0;
        }

        .ratio {
            background: no-repeat center center;
            background-size: cover;
            height: 0;
            padding-bottom: 100%;
            position: relative;
            width: 100%;
        }

        .img-circle {
            border-radius: 50%;
        }

        .img-responsive {
            display: block;
            height: auto;
            max-width: 100%;
        }

        .btn-wrapper-cover {
            margin: -18px auto 0;
            text-align: center;
        }

        .edit-btn {
            background-color: transparent;
            border: 0;
            color: #227dbc;
            font-weight: bold;
            padding: 0;
            text-transform: uppercase;
            font-size: 18px;
            line-height: 24px;
        }

        .edit_img_btn {
            background-color: #227dbc;
            color: #fff;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            -moz-background-clip: padding;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            display: inline-block;
            font: normal normal normal 14px/1 FontAwesome;
            font-size: 22px;
            line-height: 35px;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            width: 35px;
            height: 35px;
        }

    </style>
@stop

@section('content-header')

@stop

@section('main_page_container')
    <div class="col-md-6">
        <div class="post-resume-page-title">
            <h3>Edit your CV</h3>
        </div>
    </div>
    <div class="col-md-6">
        <div class="post-resume-phone">
            <h3>SHOW PUBLIC CV</h3>
        </div>
    </div>

@stop

@section('content')
    <div class="container">
        <div class="spacer-1">&nbsp;</div>
        <div class="row">
            <div class="col-md-2">
                <div class="job-side-wrap">
                    <h4>ALREADY HAVE AN ACCOUNT?</h4>
                    <p>
                        Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model
                        text, and a search.
                    </p>
                </div>
            </div>
            <div class="col-md-8">
                {!! Form::model($c_id, ['route' => ['candidate.personal.info.update', $c_id], 'method' => 'patch', 'files' => 'true', 'role'=>'form','class'=>'post-resume-form']) !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            {!! Form::text('first_name', null, ['class'=>'form-control input']) !!}
                        </div>

                        <div class="form-group">
                            <label for="sex">Gender</label>
                            {!! Form::select('gender', $gender, null, ['class'=>'form-control', 'id'=>'gender']) !!}
                        </div>

                        <div class="form-group">
                            <label for="mobile_num">Phone</label>
                            {!! Form::text('mobile_num', null, ['class'=>'form-control input']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            {!! Form::text('last_name', null, ['class'=>'form-control input']) !!}
                        </div>

                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            {!! Form::date('dob', null, ['class'=>'form-control input', 'id'=>'dob']) !!}
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            {!! Form::text('email', null, ['class'=>'form-control input']) !!}
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nationality">Nationality:</label>
                            {!! Form::text('nationality', null, ['class'=>'form-control input']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn-green my_button"><i class="fa fa-save"></i> Save</button>
                    <a href="{!! route('candidate.dashboard') !!}" class="my_button"><i class="fa fa-step-backward"></i> Cancel</a>
                </div>
                {!! Form::close() !!}

                <div class="spacer-2">&nbsp;</div>
            </div>

            <div class="col-md-2">

                <div class="job-side-wrap">

                    {{--<h4>Post Your Resume</h4>--}}
                    {{--<p>--}}
                    {{--At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum--}}
                    {{--deleniti molestias--}}
                    {{--</p>--}}
                    {{--<p class="centering">--}}
                    {{--<button class="btn btn-default btn-black">--}}
                    {{--UPLOAD YOUR RESUME <i class="icon-upload white"></i>--}}
                    {{--</button>--}}
                    {{--</p>--}}


                    <div class="ratio img-responsive img-circle"
                         style="background-image: url({!! $c_id->avatar !!});"></div>
                    <div class="btn-wrapper-cover">
                        <button type="button" class="edit-btn" id="avatar">
                            <i class="edit_img_btn fa fa-pencil"></i>
                        </button>
                    </div>
                    <p class="text-center">This picture will be shown on your public CV. Be sure to use a professional
                        photo.</p>
                    <input type="file" id="my_cover" class="hidden hide" name="photo_url"/>

                    {{--<p> Image in to circle with link</p>--}}
                    {{--<a href="http://trovacamporall.com" class="ratio img-responsive img-circle"--}}
                    {{--style="background-image: url(http://trovacamporella.com/img/trovacamporella-fiat500.png);"></a>--}}

                </div>
            </div>
        </div>

    </div>
@stop

@section('page_content')
    <div class="content-about">
        <div id="cs">
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
        </div>
    </div>
@stop

@section('page_specific_js')
    <script src="{{ URL::asset('plugins/jQueryUI/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('plugins/datepicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>
@stop

@section('page_specific_scripts')
    $( "#dob" ).datepicker({
    changeMonth: true,
    format: 'd-M-yyyy',
    changeYear: true,
    defaultDate: "-22Y",
    yearRange: "-60:+0",
    autoSize: true,
    autoClose: true,
    dateFormat: "dd-mm-yy",
    minDate: '-60Y',
    maxDate: "-16Y"
    });

    $("#avatar").click(function() {
    $("input[id='my_cover']").click();
    });

@stop
