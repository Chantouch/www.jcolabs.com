@extends('webfront.layouts.default')
@section('title', 'Search all jobs')
@section('page_specific_styles')


@stop


@section('main_page_container')

    @if (count($jobs) === 0)
        ... html showing no articles found
    @elseif (count($jobs) >= 1)
        @foreach($jobs as $job)
            <ul>
                <li>{!! $job->post_name !!}</li>
            </ul>
        @endforeach
    @endif

@stop

@section('page_specific_js')
    <script type="text/javascript">


    </script>
@stop
@section('page_specific_scripts')

@stop
