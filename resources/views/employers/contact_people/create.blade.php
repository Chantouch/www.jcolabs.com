@extends('layouts.app')

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
                    {!! Form::open(['route' => 'employer.contactPeople.store']) !!}

                        @include('employers.contact_people.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
