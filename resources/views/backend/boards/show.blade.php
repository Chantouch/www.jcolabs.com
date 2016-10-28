@extends('backend.layouts.admin_app')

@section('content')
    <section class="content-header">
        <h1>
            Board
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('backend.boards.show_fields')
                    <a href="{!! route('admin.boards.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
