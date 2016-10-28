@extends('backend.layouts.admin_app')

@section('content')
    <section class="content-header">
        <h1>
            Subject
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($subject, ['route' => ['admin.subjects.update', $subject->id], 'method' => 'patch']) !!}

                        @include('backend.subjects.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection