@extends('layouts.app')
@section('title','Category list')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            View jobs deleted
            <small>Jobs control panel</small>
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
                        <h3 class="box-title">Jobs deleted list</h3>
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
                        @if($histories->count() > 0)
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Function</th>
                                    <th>Industry</th>
                                    <th>Salary</th>
                                    <th>Description</th>
                                    <th>Created date</th>
                                    <th>Deleted date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tbody>

                                @foreach($histories as $index => $h)
                                    <tr>
                                        <td>{!!$index + 1!!}</td>
                                        <td>
                                            {!! $h->post_name !!}
                                        </td>
                                        <td>
                                            {!! $h->category->name !!}
                                        </td>

                                        <td>
                                            {!! $h->industry->name !!}
                                        </td>
                                        <td>{!! $h->salary_offered_min !!}$ ~ {!! $h->salary_offered_max !!}$</td>
                                        <td>
                                            @if(empty($h->description))
                                                <span>No description</span>
                                            @else
                                                <span>{!! \Illuminate\Support\Str::limit($h->description, 35) !!}</span>
                                            @endif
                                        </td>
                                        <td>{!! \Carbon\Carbon::parse($h->created_at)->diffForHumans() !!}</td>
                                        <td>{!! \Carbon\Carbon::parse($h->deleted_at)->diffForHumans() !!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <span>There are no revisions to display.</span>
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
