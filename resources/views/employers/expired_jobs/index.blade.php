@extends('layouts.app')
@section('title', 'Jobs expired')
@section('content')
    <section class="content-header">
        <h1 class="pull-left">Job expired list</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('employer.jobs.create') !!}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('employers.expired_jobs.table')
            </div>
        </div>
    </div>
@endsection

