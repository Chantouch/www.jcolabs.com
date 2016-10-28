@extends('layouts.app')
@section('title', 'Post new job')
@section('content')
    <section class="content-header">
        <h1>
            Post new job
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif
        @if (count($errors))
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'employer.jobs.store', 'files'=>'true']) !!}

                    @include('employers.jobs.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('page_specific_js')
    <script type="text/javascript">
        function getDistrictList(cityElement, districtElement) {
            var url = '{{ URL::route('district.by.city') }}';
            var city = $(cityElement).val();
            $district = $(districtElement);
            districtElement = typeof districtElement !== 'undefined' ? districtElement : '';

            if (city != '') {
                $.ajax({url: url, type: 'POST', data: {city_id: city}}).done(function (msg) {
                    $district.empty();
                    $("<option>").val('').text('--Choose--').appendTo($district);
                    $.each(msg, function (key, value) {
                        $("<option>").val(value.id).text(value.name).appendTo($district);
                    });
                    @if(Session::has('message'))
                        $district.val('{{ old('place_of_employment_district_id') }}')
                    @endif
                            return true;
                });
            } else
                $district.empty();
        }
    </script>
@stop

@section('page_specific_scripts')
    $('#place_of_employment_city_id').change(function(e){ alert('It working.') });

    @if(Session::has('message'))
        $('#place_of_employment_city_id').trigger('change');
    @endif
@stop
