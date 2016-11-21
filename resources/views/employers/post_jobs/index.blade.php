@extends('layouts.app')
@section('title', 'Jobs list')
@section('content')
    <section class="content-header">
        <h1>Post Jobs</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Company</a></li>
            <li class="active">Profile</li>
        </ol>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('employers.post_jobs.table')
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

            <div id="floating-button" data-toggle="tooltip" data-placement="left" data-original-title="Create new job">
                <p class="plus">+</p>
                <a href="{!! route('employer.postJobs.create') !!}">
                    <img class="edit"
                         src="http://ssl.gstatic.com/bt/C3341AA7A1A076756462EE2E5CD71C11/1x/bt_compose2_1x.png">
                </a>
            </div>

        </div>
    </div>
@endsection

