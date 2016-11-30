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
    </style>
@stop

@section('content-header')

@stop

@section('main_page_container')
    <div class="post-resume-page-title">Post a Resume</div>
    <div class="post-resume-phone">Call: 070375783</div>
@stop

@section('content')
    <div class="container">
        <div class="spacer-1">&nbsp;</div>

        {!! Form::model($accomplishment, ['route' => ['candidate.accomplishments.update', $accomplishment->id], 'role'=>'form', 'method' => 'patch', 'class'=>'post-education']) !!}

        <div class="row" style="background-color: #ECF0F1;">
            <div id="edu_details" class="col-md-12 aug_group">
                <div class="form-group aug_legend"> References Details :</div>
                <div class="_details">
                    <div class="form-group col-md-6">
                        <label for="first_name" class="control-label"> First Name: </label>
                        {!! Form::text('first_name', null, ['class'=>'first_name form-control input']) !!}
                    </div>

                    <div class="form-group col-md-6">
                        <label for="degree_level" class="control-label"> Last Name:</label>
                        {!! Form::text('last_name', null, ['class'=>'last_name form-control input']) !!}
                    </div>

                    <div class="form-group col-md-6{!! $errors->has('start_date') ? ' has-error' : '' !!}">
                        <label for="company_name" class="control-label">Company name:</label>
                        {!! Form::text('company_name', null, ['class'=>'company_name form-control input', 'id'=>'first_name']) !!}
                    </div>

                    <div class="form-group col-md-6">
                        <label for="position" class="control-label">Position:</label>
                        {!! Form::text('position', null, ['class'=>'position form-control input', 'id' => 'position']) !!}
                    </div>

                    <div class="form-group col-md-6">
                        <label for="phone_number" class="control-label">Phone number:</label>
                        {!! Form::text('phone_number', null, ['class'=>'form-control input']) !!}
                    </div>

                    <div class="form-group col-md-6">
                        <label for="email" class="control-label">Email:</label>
                        {!! Form::text('email', null, ['class'=>'form-control input']) !!}
                    </div>

                </div>
            </div>

            <div class="form-group col-sm-12">
                {{--<div class="spacer-1"></div>--}}
                <div class="col-md-12">
                    <button type="submit" class="my_button"><i class="fa fa-save"></i> Save</button>
                    <a href="{!! route('candidate.references.index') !!}" class="my_button"><i class="fa fa-backward"></i> Back</a>
                </div>
            </div>
        </div>

        {!! Form::close() !!}

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
    <script src="{!! asset('plugins/datepicker/bootstrap-datepicker.js') !!}"></script>

    <script type="text/javascript">

        function addRow() {
            $("._details:first").clone(true).appendTo('#edu_details').find('input, select').val('');
            //$("._details:first").clone(true).appendTo('#edu_details').find('.datepicker').val('');
        }

        function removeRow() {
            if ($("._details").length != 1)
                $("._details").last().remove()
        }


    </script>
@stop
@section('page_specific_scripts')
    $('#add').on('click', function(e){
    e.preventDefault();
    addRow();
    });
    $('#minus').on('click', function(e){
    e.preventDefault();
    removeRow();
    });

    $(function () {
    $("#is_studying").click(function () {
    if ($(this).is(":checked")) {
    $("#end_date").attr("disabled", "disabled");
    } else {
    $("#end_date").removeAttr("disabled");
    $("#end_date").focus();
    }
    });
    });

    $('.start_date, .end_date').datepicker({
    {{--startDate: '-3d'--}}
    });
@stop
