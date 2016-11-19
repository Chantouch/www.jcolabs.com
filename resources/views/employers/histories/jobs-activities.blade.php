@extends('layouts.app')
@section('title','Jobs activities list')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            List all product available
            <small>Product control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Simple</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Product list</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right"
                                       placeholder="Search">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        @if($histories->revisionHistory->count() > 0)
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>User Responsible</th>
                                    <th>Changed</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>On</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tbody>

                                @foreach($histories->revisionHistory as $revision)
                                    <tr>
                                        <td>
                                            {!! $revision->userResponsible()->email !!}
                                        </td>
                                        <td>{!! $revision->key !!}</td>
                                        <td>
                                            @if(is_null($revision->oldValue()))
                                                <em>None</em>
                                            @else
                                                {!! $revision->oldValue() !!}
                                            @endif
                                        </td>
                                        <td>{!! $revision->newValue() !!}</td>
                                        <td>{!! $revision->created_at !!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <h5>There are no revisions to display.</h5>
                        @endif
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->

@endsection
