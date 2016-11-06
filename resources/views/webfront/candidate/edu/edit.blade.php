@extends('webfront.layouts.default')

@section('page_specific_styles')

    <link href="{{ asset('plugins/jQueryUI/jquery-ui-1.10.3.custom.min.css')}}" rel="stylesheet" type="text/css"/>

    <style>
        .form-horizontal .form-group {
            margin-right: 0px !important;
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
    <div class="post-resume-phone">Call: 97999 49999</div>
@stop

@section('content')
    <div class="container">
        <div class="spacer-1">&nbsp;</div>

        {!! Form::open(['route' => ['candidate.update.edu_details'], 'role'=>'form', 'method' => 'patch']) !!}

        <div class="bootstrap-frm">
            @foreach($res as $v)
                <div class="_details">
                    <div class="form-group col-md-4">
                        <label for="exam_id" class="control-label"> Exam Passed: </label>
                        {!! Form::select('exam_id_'.$v->exam_id, $exams,$v->exam_id, ['class'=>'exam_id form-control', 'required']) !!}
                    </div>

                    <div class="form-group col-md-4">
                        <label for="board_id" class="control-label"> Board/university :</label>
                        {!! Form::select('board_id_'.$v->board_id, $boards, $v->board_id, ['class'=>'board_id form-control', 'required']) !!}
                    </div>

                    <div class="form-group col-md-4">
                        <label for="subject_id" class="control-label">Subject/Trade :</label>
                        {!! Form::select('subject_id_'.$v->subject_id, $subjects, $v->subject_id, ['class'=>'subject_id form-control', 'required']) !!}
                    </div>
                    <div class="form-group col-md-4">
                        <label for="specialization" class="control-label">Specialization :</label>
                        {!! Form::text('specialization_'.$v->specialization, $v->specialization, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group col-md-4">
                        <label for="pass_year" class="control-label">Year of Passing :</label>
                        {!! Form::selectYear('pass_year_'.$v->pass_year, 2020,1950, $v->pass_year, ['id'=>'pass_year', 'class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="form-group col-md-4">
                        <label for="percentage" class="control-label">% of marks :</label>
                        {!! Form::text('percentage_'.$v->percentage, $v->percentage, ['class'=>'form-control', 'required']) !!}
                    </div>
                    <input type="hidden" name="eduIds[]" value="{{$v->id}}">
                </div>
            @endforeach

        </div>

        <div class="form-group col-sm-12 text-center" style="margin-top:40px;">
            <button class="my_button"> Save and Proceed to Next Step >></button>
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
@stop
