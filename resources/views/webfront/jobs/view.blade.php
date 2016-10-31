@extends('webfront.layouts.default')

@section('page_specific_styles')

@stop

@section('full_content')
    <p>{!! $job_id->post_name !!}</p>
@stop