@extends('layouts.skarla')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            @include('views.loader.rainbow')

            <div class="panel panel-default b-a-0 shadow-box b-b-success">
                <div class="panel-heading">
                    {{$task->display_name}} on Group: {{$group->display_name}}                    
                </div>
                <div class="panel-body">
                    
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
