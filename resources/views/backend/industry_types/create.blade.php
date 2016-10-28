@extends('backend.layouts.admin_app')

@section('content')
    <section class="content-header">
        <h1>
            Industry Type
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'admin.industryTypes.store']) !!}

                        @include('backend.industry_types.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
