@extends('backend.layouts.admin_app')

@section('content')
    <section class="content-header">
        <h1>
            Industry Type
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('backend.industry_types.show_fields')
                    <a href="{!! route('admin.industryTypes.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
