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
                                {{$company->web_address}}
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
                    <img src="{!! asset('images/upload/company-3.png') !!}" alt="Company profile"
                         class="img-responsive">
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <h4>Company Description</h4>
                <p class="col-md-11">
                    CamUP Agency is a recruitment agency in Cambodia, established in 2013 which
                    cooperate with
                    Japanese
                    experts.
                </p>
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

        $(".place_of_employment_city_id, .place_of_employment_district_id").select2();
        $('#place_of_employment_city_id').change(function (e) {
            getDistrictList(this, $('#place_of_employment_district_id'));
        });

        $('#contact_person_id').change(function (e) {
            getContactPerson(this, $('#phone_number'));
        });

        $('#place_of_employment_state_id').trigger('change');

        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor1');
            //bootstrap WYSIHTML5 - text editor
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
                        $district.val('{{ old('place_of_employment_district_id') }}')
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

    </script>
@stop
