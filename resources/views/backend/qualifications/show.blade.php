@extends('backend.layouts.admin_app')

@section('content')
    <section class="content-header">
        <h1>
            Qualification
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('backend.qualifications.show_fields')
                    <a href="{!! route('admin.qualifications.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
