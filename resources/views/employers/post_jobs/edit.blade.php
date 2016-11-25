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


        $('#is_negotiable').click(function () {
            if ($(this).is(":checked")) {
                $("#salary_offered_max").attr("disabled", "disabled");
            } else {
                $("#salary_offered_max").removeAttr("disabled");
                $("#salary_offered_min").focus();
            }
        });


        $(".place_of_employment_city_id").select2();
        $('#place_of_employment_city_id').change(function (e) {
            getDistrictList(this, $('#place_of_employment_district_id'));
        });

        $('#contact_person_id').change(function (e) {
            getContactPerson(this, $('#phone_number'));
        });

        $('#place_of_employment_city_id, #is_negotiable').trigger('change');

        $(function () {
            $(".textarea").wysihtml5();
        });

        $(document).ready(function () {
            var date = new Date();
            var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
            var end = new Date(date.getFullYear(), date.getMonth(), date.getDate());
            console.log((30 * end).toString());

            $('#closing_date').datepicker({
                format: "yyyy-m-d",
                todayHighlight: true,
                startDate: today,
                endDate: "+32d",
                autoclose: true
            });
            $('#published_date').datepicker({
                format: "yyyy-m-d",
                todayHighlight: true,
                startDate: today,
                endDate: "+2d",
                autoclose: true
            }).change(calculate).on('changeDate', calculate);


            $('#closing_date, #published_date').datepicker('setDate', today);


            function calculate() {

                published_date = $('#published_date').val();
                closing_date = $('#closing_date').val();
                var myDate = new Date(published_date);
                newDate = myDate.getDate() + "-" + (myDate.getMonth() + 1) + "-" + myDate.getFullYear();
                console.log(newDate);
                closing_date = newDate;

            }
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

        function getContactPerson(contactId, phone_number) {
            var url = '{!! route('contact.by.id') !!}';
            var contact = $(contactId).val();
            console.log(contact);
            $phone = $(phone_number);

            phone_number = typeof phone_number !== 'undefined' ? phone_number : '';

            if (contact != '') {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        contact_id: contact
                    }
                }).done(function (msg) {
                    console.log(msg);
                    $phone.empty();
                }).fail(function (response) {
                    console.log("Error: " + response);
                });
            } else {
                $phone.empty();
            }
        }

        $("#language_id").select2({
            placeholder: "Select Languages",
            allowClear: true
        }).val({!! $postJob->languages()->getRelatedIds() !!}).trigger('change');

        function checkbox(chkPassport) {
            var salary_offered_min = document.getElementById("salary_offered_min");
            var salary_offered_max = document.getElementById("salary_offered_max");
            salary_offered_min.disabled = !!chkPassport.checked;
            salary_offered_max.disabled = chkPassport.checked ? true : false;
            if (!salary_offered_min.disabled) {
                salary_offered_min.focus();
            }
        }

    </script>
@stop
