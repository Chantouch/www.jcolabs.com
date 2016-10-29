@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Update profile
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Company</a></li>
            <li class="active">Profile</li>
        </ol>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')

        {!! Form::model($profile, ['route' => ['employer.company.show.update', $profile_id], 'method' => 'patch']) !!}

        @include('employers.company.fields')

        {!! Form::close() !!}

    </div>
@endsection