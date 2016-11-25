@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Post Job
        </h1>
    </section>
    <div class="content">

        @include('adminlte-templates::common.errors')

        {!! Form::model($postJob, ['route' => ['employer.postJobs.update', $postJob->id], 'method' => 'patch']) !!}

        @include('employers.post_jobs.fields')

        {!! Form::close() !!}

    </div>
@endsection


@section('page_specific_js')

    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".place_of_employment_city_id, .place_of_employment_district_id").select2();
        $('#place_of_employment_city_id').change(function (e) {
            getDistrictList(this, $('#place_of_employment_district_id'));
        });

        $('#place_of_employment_city_id, #is_negotiable').trigger('change');

        $(function () {
            $(".textarea").wysihtml5();
        });


        function getDistrictList(cityElement, districtElement) {
            var url = '{{ route('district.by.city') }}';
            var city = $(cityElement).val();
            $district = $(districtElement);
            districtElement = typeof districtElement !== 'undefined' ? districtElement : '';

            if (city != '') {
                $.ajax({url: url, type: 'POST', data: {city_id: city}}).done(function (msg) {
                    $district.empty();
                    $("<option>").val('').text('--Choose District--').appendTo($district);
                    $.each(msg, function (key, value) {
                        $("<option>").val(value.id).text(value.name).appendTo($district);
                    });
                    @if(Session::has('message'))
                        $district.val('{{ old('place_of_employment_district_id') }}');
                    @endif
                            return true;
                });
            } else
                $district.empty();
        }

        $("#language_id").select2({
            placeholder: "Select Languages",
            allowClear: true
        }).val({!! $postJob->languages()->getRelatedIds() !!}).trigger('change');

    </script>
@stop

@section('page_specific_scripts')

    $(function () {
    $("#is_studying").click(function () {
    if ($(this).is(":checked")) {
    $("#end_date").attr("disabled", "disabled");
    } else {
    $("#end_date").removeAttr("disabled");
    $("#end_date").focus();
    }
    });
    });

@stop