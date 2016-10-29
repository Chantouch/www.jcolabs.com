@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>Document Uploaded</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('employers.documents.table')
            </div>
        </div>
    </div>
@endsection

