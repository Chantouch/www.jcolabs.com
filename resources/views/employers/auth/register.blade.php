@extends('layouts.login.employer_app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="form-group">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if (count($errors))

                    <div class="alert alert-success">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ url('employer/saveregister') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">
                                <label for="contact_name" class="col-md-4 control-label">Contact name</label>

                                <div class="col-md-6">
                                    <input id="contact_name" type="text" class="form-control" name="contact_name"
                                           value="{{ old('contact_name') }}" required autofocus>

                                    @if ($errors->has('contact_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('contact_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('contact_email') ? ' has-error' : '' }}">
                                <label for="contact_email" class="col-md-4 control-label">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input id="contact_email" type="email" class="form-control" name="contact_email"
                                           value="{{ old('contact_email') }}" required>
                                    @if ($errors->has('contact_email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('contact_email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('organization_name') ? ' has-error' : '' }}">
                                <label for="organization_name" class="col-md-4 control-label">Organization name</label>
                                <div class="col-md-6">
                                    <input id="organization_name" type="text" class="form-control" name="organization_name"
                                           value="{{ old('organization_name') }}" required>
                                    @if ($errors->has('organization_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('organization_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('contact_mobile_no') ? ' has-error' : '' }}">
                                <label for="contact_mobile_no" class="col-md-4 control-label">Mobile number</label>
                                <div class="col-md-6">
                                    <input id="contact_mobile_no" type="tel" class="form-control" name="contact_mobile_no"
                                           value="{{ old('contact_mobile_no') }}" required>
                                    @if ($errors->has('contact_mobile_no'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('contact_mobile_no') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
