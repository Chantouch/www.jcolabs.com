@extends('layouts.app')
@section('title', 'Change current password')
@section('content')
    <section class="content-header">
        <h1>
            Change password
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Company</a></li>
            <li class="active">Profile</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Profile Image -->
                <div class="box box-primary">
                    {!! Form::open(['route' => 'employer.postJobs.store', 'class'=>'form-horizontal']) !!}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="current_password" class="col-sm-2 control-label">Current password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="current_password" placeholder="Old password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="new_password" class="col-sm-2 control-label">New Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="new_password" placeholder="New Password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="confirm_new_password" class="col-sm-2 control-label">Confirm New Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="confirm_new_password" placeholder="Confirm New Password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Remind me change in 72 days
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-default">Cancel</button>
                        <button type="submit" class="btn btn-info pull-right">Change now</button>
                    </div>
                    <!-- /.box-footer -->
                    {!! Form::close() !!}
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

