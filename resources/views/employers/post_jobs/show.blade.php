@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Post Job
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('employers.post_jobs.show_fields')
                    <div class="col-lg-12">
                        <a href="{!! route('employer.postJobs.index') !!}" class="btn btn-default">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
