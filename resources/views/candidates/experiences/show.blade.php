@extends('webfront.layouts.default')

@section('page_specific_styles')
    <link href="{{ asset('plugins/jQueryUI/jquery-ui-1.10.3.custom.min.css')}}" rel="stylesheet" type="text/css"/>

    <style>
        .form-horizontal .form-group {
            margin-right: 0px !important;
        }
    </style>
@stop

@section('content-header')

@stop

@section('main_page_container')
    <div class="post-resume-page-title">Fill up Education Details</div>
    <div class="post-resume-phone">Call: 97999 49999</div>
@stop

@section('content')
    <div class="container">
        <div class="spacer-1">&nbsp;</div>

    </div>
@stop

@section('page_content')
    <!-- <div class="content-about">
  <div id="cs">
    <div class="container">
    <div class="spacer-1">&nbsp;</div>
      <h1>Hey Friends Any Quries?</h1>
      <p>
        At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt.
      </p>
      <h1 class="phone-cs">Call: 1 800 000 500</h1>
    </div>
  </div>
</div> -->
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
