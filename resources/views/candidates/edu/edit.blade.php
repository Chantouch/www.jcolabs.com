@extends('webfront.layouts.default')

@section('page_specific_styles')

    <link href="{{ asset('plugins/jQueryUI/jquery-ui-1.10.3.custom.min.css')}}" rel="stylesheet" type="text/css"/>

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

        {!! Form::open(['route' => ['candidate.update.edu_details'], 'role'=>'form', 'method' => 'patch', 'class'=>'post-education']) !!}

        <div class="bootstrap-frm">
            <div class="form-group aug_legend"> Education Details :</div>
            @foreach($c_edu as $c_educ)
                <div class="_details">
                    <div class="form-group col-md-6">
                        <label for="school_university_name" class="control-label"> University Name: </label>
                        {!! Form::text('school_university_name[]', $c_educ->school_university_name, ['class'=>'university_name form-control input']) !!}
                    </div>

                    <div class="form-group col-md-6">
                        <label for="degree_level" class="control-label"> Degree/Level:</label>
                        {!! Form::select('degree_level[]', $degree_level, $c_educ->degree_level, ['class'=>'degree_level form-control input']) !!}
                    </div>

                    <div class="form-group col-md-6{!! $errors->has('start_date[]') ? ' has-error' : '' !!}">
                        <label for="start_date" class="control-label">Start date:</label>
                        {!! Form::date('start_date[]', $c_educ->start_date, ['class'=>'start_date form-control input']) !!}
                    </div>

                    <div class="form-group col-md-6">
                        <label for="end_date" class="control-label">End date:</label>
                        <label for="end_date" class="control-label" style="float: right">
                            I'm currently learning here {!! Form::hidden('is_studying', '0', false) !!}
                            {!! Form::checkbox('is_studying', '1', null, ['id'=>'is_studying', 'checked']) !!}</label>
                        {!! Form::date('end_date[]', null, ['class'=>'end_date form-control input', 'id' => 'end_date', 'disabled']) !!}
                    </div>

                    <div class="form-group col-md-6">
                        <label for="field_of_study" class="control-label">Field of study:</label>
                        {!! Form::text('field_of_study[]', $c_educ->field_of_study, ['class'=>'form-control input']) !!}
                    </div>

                    <div class="form-group col-md-6">
                        <label for="country_name" class="control-label">Country:</label>
                        {!! Form::text('country_name[]', $c_educ->country_name, ['class'=>'form-control input']) !!}
                    </div>
                    <div class="form-group col-md-6">
                        <label for="city_id" class="control-label">City:</label>
                        {!! Form::text('city_id[]', $c_educ->city_id, ['class'=>'form-control input']) !!}
                    </div>

                    <div class="form-group col-md-6">
                        <label for="grade" class="control-label">Grade:</label>
                        {!! Form::text('grade[]', $c_educ->grade, ['id'=>'grade', 'class' => 'form-control input']) !!}
                    </div>

                    <div class="form-group col-md-12">
                        <label for="description" class="control-label">Description:</label>
                        {!! Form::textarea('description[]', $c_educ->description, ['id'=>'description', 'class' => 'form-control textarea']) !!}
                    </div>

                </div>
            @endforeach

        </div>

        <div class="form-group">
            <button id="add" class="btn btn-sm" type="button"><i class="fa fa-plus"></i> Add New
            </button>
            <button id="minus" class="btn btn-sm" type="button"><i class="fa fa-minus"></i> Remove
            </button>
        </div>

        <div class="form-group col-sm-12 text-center" style="margin-top:40px;">
            <button class="btn my_button"> Save and Proceed to Next Step >></button>
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
    <script type="text/javascript">

        function addRow() {
            $(".add_more:first").clone(true).appendTo('#edu_details').find('input, select').val('');
            //$("._details:first").clone(true).appendTo('#edu_details').find('.datepicker').val('');
        }
        function removeRow() {
            if ($(".add_more").length != 1)
                $(".add_more").last().remove()
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
@stop
