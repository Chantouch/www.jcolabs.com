@extends('layouts.app')
@section('title', "Edit Contact >> $contactPerson->contact_name")

@section('content')
    <section class="content-header">
        <h1>
            Contact Person
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::model($contactPerson, ['route' => ['employer.contactPeople.update', $contactPerson->id], 'method' => 'patch']) !!}

                    @include('employers.contact_people.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_specific_scripts')

    $(function () {
    $("#status").click(function () {
    if ($(this).is(":checked")) {
    alert('sfds');
    $("#salary_offered_max").attr("disabled", "disabled");
    } else {
    $("#salary_offered_max").removeAttr("disabled");
    $("#salary_offered_min").focus();
    }
    });
    });

@stop