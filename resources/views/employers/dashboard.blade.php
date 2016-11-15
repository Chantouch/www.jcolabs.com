@extends('layouts.app')
@section('title', 'Dashboard')

@section('page_specific_css')
    <!-- Morris chart -->
    <link rel="stylesheet" href="{!! asset('plugins/morris/morris.css') !!}">
@stop

@section('content')

    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-heading">Dashboard</div>

            <div class="panel-body">
                Hello {{Auth::guard('employer')->user()->name}}
                You are logged in!
                {{ Auth()->guard('employer')->user()->email  }}
            </div>
        </div>
    </div>


    <div id="container-floating">

        <div class="nd5 nds" data-toggle="tooltip" data-placement="left" data-original-title="Simone"></div>
        <div class="nd4 nds" data-toggle="tooltip" data-placement="left" data-original-title="contract@gmail.com">
            <img class="reminder">
            <p class="letter">C</p>
        </div>
        <div class="nd3 nds" data-toggle="tooltip" data-placement="left" data-original-title="Reminder">
            <img class="reminder"
                 src="//ssl.gstatic.com/bt/C3341AA7A1A076756462EE2E5CD71C11/1x/ic_reminders_speeddial_white_24dp.png"/>
        </div>
        <div class="nd1 nds" data-toggle="tooltip" data-placement="left" data-original-title="Edoardo@live.it">
            <img class="reminder">
            <p class="letter">E</p>
        </div>

        <div id="floating-button" data-toggle="tooltip" data-placement="left" data-original-title="Create"
             onclick="newmail()">
            <p class="plus">+</p>
            <img class="edit" src="http://ssl.gstatic.com/bt/C3341AA7A1A076756462EE2E5CD71C11/1x/bt_compose2_1x.png">
        </div>
    </div>
@endsection

@section('page_specific_js')
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{!! asset('plugins/morris/morris.min.js') !!}"></script>

@stop