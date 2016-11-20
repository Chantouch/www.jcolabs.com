@extends('layouts.app')

@section('content')
    <section class="content-header" xmlns="http://www.w3.org/1999/html">
        <h1>
            Post Job
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">General Elements</li>
        </ol>
    </section>
    <div class="content">

        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Company Profile</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-8">
                    <div class="box-body no-padding" style="padding-top:5px !important;">
                        <strong><i class="fa fa-user margin-r-5"></i> Name </strong>
                        &nbsp;&nbsp;&nbsp;
                        <span>
                                {{$company->organization_name}}
                            </span>
                        <hr>
                        <strong><i class="fa fa-industry margin-r-5"></i> Industry</strong>
                        &nbsp;&nbsp;&nbsp;
                        <span>
                                {{$company->industry->name}}
                            </span>
                        <hr>
                        <strong><i class="fa fa-buysellads margin-r-5"></i> Sector Type</strong>
                        &nbsp;&nbsp;&nbsp;
                        <span>
                                {{$company->organization_sector}}
                            </span>
                        <hr>
                        <strong><i class="fa fa-envelope margin-r-5"></i> E-mail</strong>
                        &nbsp;&nbsp;&nbsp;
                        <span>

                            @if($company->organization_email == null)
                                {!! $company->contact_email !!}
                            @else
                                {{$company->organization_email}}
                            @endif
                            </span>
                        <hr>
                        <strong><i class="fa fa-users margin-r-5"></i> Employees</strong>
                        &nbsp;&nbsp;&nbsp;
                        <span>
                                {{$company->contact_mobile_no}}
                            </span>
                        <hr>
                        <strong><i class="fa fa-map-o margin-r-5"></i> Website</strong>
                        &nbsp;&nbsp;&nbsp;
                        <span>
                                <a target="_blank" href="{{$company->web_address}}">{{$company->web_address}}</a>
                            </span>
                        <hr>
                        <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>
                        &nbsp;&nbsp;&nbsp;
                        <span>
                                {{$company->address}}
                            </span>
                        <hr>
                        {{--<strong><i class="fa fa-file-text-o margin-r-5"></i> Additional Note</strong>--}}
                        {{--<p>{{ $company->additional_info }}</p>--}}
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    @if($company->photo == 'default.jpg' || $company->photo == '')
                        <img src="{!! asset('uploads/employers/'. $company->photo) !!}" alt="Company profile"
                             class="img-responsive">
                    @else
                        <img src="{!! asset($company->path.$company->photo) !!}" alt="Company profile"
                             class="img-responsive">
                    @endif
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <h4 class="col-md-12">Company Description</h4>
                <div class="col-md-12">
                    <p>
                        {!! $company->details !!}
                    </p>
                </div>
                <p class="col-md-1 pull-right">
                    <a href="#">Edit</a>
                </p>
            </div>
        </div>
        <!-- /.box -->
        @include('adminlte-templates::common.errors')

        {!! Form::open(['route' => 'employer.postJobs.store']) !!}

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


        $('#is_negotiable').change(function (e) {
            if (!this.checked)
                $('#salary_max').fadeIn('slow');
            else
                $('#salary_max').fadeOut('slow');
        });

        $(".place_of_employment_city_id, .place_of_employment_district_id").select2();
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
                format: "dd-M-yyyy",
                todayHighlight: true,
                startDate: today,
                endDate: "+32d",
                autoclose: true
            });
            $('#published_date').datepicker({
                format: "dd-M-yyyy",
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
        });

    </script>
@stop
