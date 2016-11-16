@extends('backend.layouts.admin_app')

@section('content')
    <section class="content-header">
        <h1>
            Qualification
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($qualification, ['route' => ['admin.qualifications.update', $qualification->id], 'method' => 'patch']) !!}

                        @include('backend.qualifications.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection