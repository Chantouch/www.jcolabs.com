@extends('backend.layouts.admin_app')

@section('content')
    <section class="content-header">
        <h1>
            Board
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($board, ['route' => ['admin.boards.update', $board->id], 'method' => 'patch']) !!}

                        @include('backend.boards.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection