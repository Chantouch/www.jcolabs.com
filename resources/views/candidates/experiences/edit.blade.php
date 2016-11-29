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

        {!! Form::model($experience, ['route' => ['candidate.experiences.details.update', $experience->id], 'role'=>'form', 'method' => 'patch', 'class'=>'post-education']) !!}

        <div class="row" style="background-color: #ECF0F1;">
            <div id="edu_details" class="col-md-12 aug_group">
                <div class="form-group aug_legend"> Experiences Details :</div>
                <div class="_details">
                    <div class="form-group col-md-6">
                        <label for="job_title" class="control-label"> Job Title: </label>
                        {!! Form::text('job_title', null, ['class'=>'job_title form-control input']) !!}
                    </div>
                    <div class="form-group col-md-6">
                        <label for="job_title" class="control-label"> Company name: </label>
                        {!! Form::text('company_name', null, ['class'=>'job_title form-control input']) !!}
                    </div>

                    <div class="form-group col-md-6">
                        <label for="can_read" class="control-label">Start Date :</label>
                        {!! Form::text('start_date', null, ['class'=>'form-control input','id' => 'start_date']) !!}
                    </div>
                    <div class="form-group col-md-6">
                        <label for="end_date" class="control-label">End date:</label>
                        <label for="end_date" class="control-label" style="float: right">
                            I'm currently working here {!! Form::hidden('is_working', '0', false) !!}
                            {!! Form::checkbox('is_working', '1', null, ['id'=>'is_working', 'checked']) !!}</label>
                        {!! Form::text('end_date', null, ['class'=>'end_date form-control input', 'id' => 'end_date', 'disabled']) !!}
                    </div>
                    <div class="form-group col-md-4">
                        <label for="can_speak" class="control-label">Country :</label>
                        {!! Form::text('country', null, ['class'=>'form-control input']) !!}
                    </div>
                    <div class="form-group col-md-4">
                        <label for="can_speak_fluently" class="control-label">City :</label>
                        {!! Form::select('city_id', $cities, null, ['class'=>'form-control input']) !!}
                    </div>
                    <div class="form-group col-md-4">
                        <label for="can_speak_fluently" class="control-label">Contract :</label>
                        {!! Form::select('contract_type', $contract_type, null, ['class'=>'form-control input']) !!}
                    </div>
                    <div class="form-group col-md-4">
                        <label for="can_speak" class="control-label">Industry :</label>
                        {!! Form::select('industry_id', $sectors, null, ['class'=>'form-control input']) !!}
                    </div>
                    <div class="form-group col-md-4">
                        <label for="can_speak_fluently" class="control-label">Job Role :</label>
                        {!! Form::select('department_id', $departments, null, ['class'=>'form-control input']) !!}
                    </div>
                    <div class="form-group col-md-4">
                        <label for="can_speak_fluently" class="control-label">Career Level :</label>
                        {!! Form::select('career_level', $career_level, null, ['class'=>'form-control input']) !!}
                    </div>
                    <div class="form-group col-md-12">
                        <label for="can_speak_fluently" class="control-label">Description :</label>
                        {!! Form::textarea('description', null, ['class'=>'form-control', 'cols'=>'15', 'rows'=>'7']) !!}
                    </div>

                </div>
            </div>

            <div class="form-group col-sm-12">
                {{--<div class="spacer-1"></div>--}}
                <div class="col-md-12">
                    <button type="submit" class="my_button"><i class="fa fa-save"></i> Save</button>
                    <a href="{!! route('candidate.experiences.details') !!}" class="my_button"><i
                                class="fa fa-backward"></i> Cancel</a>
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
