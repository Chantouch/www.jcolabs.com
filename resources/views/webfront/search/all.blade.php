@extends('webfront.layouts.default')
@section('title', 'Functions all')
@section('page_specific_styles')
    <link href="{{ asset('plugins/animate/animate.css') }}" rel="stylesheet" type="text/css"/>
    <style>
        .show-grid [class^=col-] {
            padding-top: 10px;
            padding-bottom: 10px;
            margin-bottom: 5px;
            background-color: #eee;
            /*background-color: rgba(86, 61, 124, .15);*/
            border: 1px solid #ddd;
        }

        .panel-heading h2 {
            margin-top: 10px;
        }
    </style>
@stop

@section('full_content')

    <div class="col-lg-12">
        <div class="show-grid">
            <div class="spacer-1">&nbsp;</div>
            <div class="panel panel-default">
                <div class="panel-heading text-center"><h2>
                        Search By
                        @if(!empty($functions))
                            Functions
                        @endif
                        @if(!empty($industries))
                            Industries
                        @endif
                        @if(!empty($companies))
                            Companies
                        @endif
                        @if(!empty($cities))
                            Cities
                        @endif
                    </h2></div>
                <div class="panel-body">
                    @if(!empty($functions))
                        @foreach($functions as $function)
                            <div class="col-md-4 col-sm-6 col-lg-3">
                                <span><a href="{!! route('jobs.view.by.function',[$function->slug]) !!}">{!! $function->name !!}
                                        ({!! count($function->jobs) !!})</a></span>
                            </div>
                        @endforeach
                    @endif
                    @if(!empty($industries))
                        @foreach($industries as $industry)
                            <div class="col-md-4 col-sm-6 col-lg-3">
                                <span><a href="{!! route('jobs.view.by.industry',[$industry->slug]) !!}">{!! $industry->name !!}
                                        ({!! count($industry->jobs) !!})</a></span>
                            </div>
                        @endforeach
                    @endif
                    @if(!empty($companies))
                        @foreach($companies as $company)
                            <div class="col-md-4 col-sm-6 col-lg-3">
                                <span><a href="{!! route('jobs.view.by.company',[$company->slug]) !!}">{!! $company->organization_name !!}
                                        ({!! count($company->jobs) !!})</a></span>
                            </div>
                        @endforeach
                    @endif
                    @if(!empty($cities))
                        @foreach($cities as $city)
                            <div class="col-md-4 col-sm-6 col-lg-3">
                                <span><a href="{!! route('jobs.view.by.city',[$city->slug]) !!}">{!! $city->name !!}
                                        ({!! count($city->jobs) !!})</a></span>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="spacer-1">&nbsp;</div>
        </div>
    </div>

@stop

@section('page_specific_js')

    <script src="{{ asset('plugins/wow/wow.min.js')}}" type="text/javascript"></script>

    <script type="text/javascript">


    </script>
@stop
@section('page_specific_scripts')
    new WOW().init();
@stop
