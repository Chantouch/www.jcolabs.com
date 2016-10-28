@extends('backend.layouts.admin_app')

@section('content')
    <section class="content-header">
        <h1>
            Language
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($language, ['route' => ['admin.languages.update', $language->id], 'method' => 'patch']) !!}

                        @include('backend.languages.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection