@extends('backend.layouts.admin_app')

@section('content')
    <section class="content-header">
        <h1>
            Department Type
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($departmentType, ['route' => ['admin.departmentTypes.update', $departmentType->id], 'method' => 'patch']) !!}

                        @include('backend.department_types.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection