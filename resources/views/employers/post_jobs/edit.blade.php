@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Post Job
        </h1>
    </section>
    <div class="content">
    @include('adminlte-templates::common.errors')

        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::model($postJob, ['route' => ['employer.postJobs.update', $postJob->id], 'method' => 'patch']) !!}

                    @include('employers.post_jobs.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection