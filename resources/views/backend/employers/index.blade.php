@extends('backend.layouts.admin_app')
@section('title', 'Employer list')
@section('content')
    <section class="content-header">
        <h1 class="pull-left">Employers</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="#">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('backend.employers.table')
            </div>
        </div>
    </div>
@endsection

