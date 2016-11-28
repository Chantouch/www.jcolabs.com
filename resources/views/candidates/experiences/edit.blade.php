@extends('webfront.layouts.default')

@section('page_specific_styles')

    <link href="{{ asset('plugins/jQueryUI/jquery-ui-1.10.3.custom.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('plugins/datepicker/datepicker3.css')}}" rel="stylesheet" type="text/css"/>

    <style>
        .form-horizontal .form-group {
            margin-right: 0 !important;
        }

        .aug_group {
            background-color: #ECF0F1;
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

        {!! Form::model($language, ['route' => ['candidate.update.language.details', $language->id], 'role'=>'form', 'method' => 'patch', 'class'=>'post-education']) !!}

        <div class="row" style="background-color: #ECF0F1;">
            <div id="edu_details" class="col-md-12 aug_group">
                <div class="form-group aug_legend"> Education Details :</div>
                <div class="_details">
                    <div class="form-group col-md-4">
                        <label for="school_university_name" class="control-label"> University Name: </label>
                        {!! Form::text('name', null, ['class'=>'university_name form-control input']) !!}
                    </div>

                    <div class="form-group col-md-2">
                        <label for="can_read" class="control-label">Read :</label>
                        {!! Form::select('read', $level, null, ['class'=>'form-control', 'required']) !!}
                    </div>
                    <div class="form-group col-md-2">
                        <label for="can_write" class="control-label">Write :</label>
                        {!! Form::select('write', $level, null, ['class'=>'form-control', 'required']) !!}
                    </div>
                    <div class="form-group col-md-2">
                        <label for="can_speak" class="control-label">Speak :</label>
                        {!! Form::select('speak', $level, null, ['class'=>'form-control', 'required']) !!}
                    </div>
                    <div class="form-group col-md-2">
                        <label for="can_speak_fluently" class="control-label">Listen :</label>
                        {!! Form::select('listen', $level, null, ['class'=>'form-control', 'required']) !!}
                    </div>

                </div>
            </div>

            <div class="form-group col-sm-12">
                {{--<div class="spacer-1"></div>--}}
                <div class="col-md-12">
                    <button type="submit" class="my_button">Save</button>
                    <a href="{!! route('candidate.lang.details') !!}" class="btn btn-default">Cancel</a>
                </div>
            </div>
        </div>

        {!! Form::close() !!}
        <div class="spacer-1">&nbsp;</div>

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
