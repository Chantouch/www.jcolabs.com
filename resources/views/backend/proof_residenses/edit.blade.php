@extends('backend.layouts.admin_app')

@section('content')
    <section class="content-header">
        <h1>
            Proof Residense
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($proofResidense, ['route' => ['admin.proofResidenses.update', $proofResidense->id], 'method' => 'patch']) !!}

                        @include('backend.proof_residenses.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection