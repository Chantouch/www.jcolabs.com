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
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="box box-primary">
                    {!! Form::open(['route' => 'employer.company.show_form_change_password', 'class'=>'form-horizontal']) !!}
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                            <label for="current_password" class="col-md-2 control-label">Current password</label>
                            <div class="col-sm-10">
                                {{ Form::password('current_password', array('class' => 'form-control', 'placeholder'=>'Current password')) }}
                                @if ($errors->has('current_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {!! $errors->has('password') ? ' has-error' : '' !!}">
                            <label for="new_password" class="col-md-2 control-label">New Password</label>
                            <div class="col-sm-10">
                                {{ Form::password('password', array('class' => 'form-control', 'placeholder'=>'New password')) }}
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{!! $errors->has('confirm_new_password') ? ' has-error' : '' !!}">
                            <label for="confirm_new_password" class="col-md-2 control-label">Confirm New Password</label>
                            <div class="col-sm-10">
                                {{ Form::password('confirm_new_password', array('class' => 'form-control', 'placeholder'=>'Confirm New password')) }}
                                @if ($errors->has('confirm_new_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('confirm_new_password') }}</strong>
                                    </span>
                                @endif
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
                        <a href="{!! route('employer.company.profile') !!}" class="btn btn-default">Cancel</a>
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

