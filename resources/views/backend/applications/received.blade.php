@extends('backend.layouts.admin_app')
@section('title', 'Employer list')
@section('content')
    <section class="content-header">
        <h1 class="pull-left">Applications
            <small> Not Verified</small>
        </h1>
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
                @if($applications->count())
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th width="2%">#</th>
                            <th width="10%">FullName</th>
                            <th width="5%">Index Card No</th>
                            <th width="5%">Gender</th>
                            <th width="5%">Date of Birth</th>
                            <!-- <th width="10%">Address</th> -->
                            <th width="6%">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($applications as $index => $application)
                            <tr>
                                <td>{{ $index }}</td>
                                <td>{{ $application->fullname }}</td>
                                <td>{{ $application->index_card_no }}</td>
                                <td>{{ $application->sex }}</td>
                                <td>{{ $application->dob }}</td>
                            <!-- <td>{{ $application->address }}</td> -->
                                <td>
                                    <a href="{!!route('admin.view.i_card', [$application->id])!!}"
                                       class="btn btn-info btn-xs pull-left aug-margin">
                                        <i class="fa fa-search"></i>
                                    </a>
                                    <a href="{!!route('admin.view.profile', [Hashids::encode($application->id)])!!}"
                                       class="btn btn-info btn-xs pull-left aug-margin">
                                        <i class="fa fa-folder-open"></i> View Profile
                                    </a>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p style="text-align: center;"> No records found.</p>
                @endif
            </div>
        </div>
    </div>
@endsection

