@extends('layouts.app')
@section('title', "$postJob->post_name")
@section('page_specific_css')
    <style>
        .view-job .spacer-1 {
            height: 15px;
        }
        .job-field {
            padding: 6px 0;
            background: #f6f6f6;
            margin-bottom: 4px;
            font-weight: bold;
        }

        h4 {
            padding: 15px 0;
            text-decoration: underline;
        }

        .project-add-info {
            font-family: Century Gothic, CenturyGothic, AppleGothic, sans-serif;
            font-size: 14px;
        }

        .project-add-info .label {
            font-size: 14px;
        }
    </style>
@stop
@section('content')
    <section class="content-header">
        <h1>
            {!! $postJob->post_name !!}
        </h1>
    </section>
    <div class="content">
        <div class="post">
            <div class="box box-primary">
                <div class="box-body">
                    @include('employers.post_jobs.show_fields')
                    {{--<div class="col-lg-12">--}}
                        {{--<a href="{!! route('employer.postJobs.index') !!}" class="btn btn-default">Back</a>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
