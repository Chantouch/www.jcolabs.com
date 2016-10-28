@extends('layouts.app')
@section('title', 'Upload new document')
@section('content')
    <section class="content-header">
        <h1>
            Upload Document
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'employer.documents.uploaded.form','files'=>true]) !!}

                    @include('employers.documents.field')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
