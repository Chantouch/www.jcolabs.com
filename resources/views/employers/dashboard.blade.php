@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Hello {{Auth::guard('employer')->user()->name}}
                    You are logged in!
                    {{ Auth()->guard('employer')->user()->email  }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
