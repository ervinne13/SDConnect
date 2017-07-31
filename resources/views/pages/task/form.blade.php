<?php $uses = ["form", "colorpicker"]; ?>

@extends('layouts.skarla')

@section('js')
<script>

    let task = {!! $task !!}
    ;

</script>

<script src="{{url("js/pages/task/form.js")}}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default b-a-0 shadow-box">
                <div class="panel-heading">
                    Task Items (Write questions or activities that the student must accoplish)
                </div>
                <div class="panel-body">
                    @include('pages.task.partials.task-item-editor')                   
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default b-a-0 shadow-box">
                <div class="panel-heading">
                    Task (<span>{{$routeAction == "create" ? "Create New" : "Edit {$task->getDisplayName()}" }}</span>)
                </div>
                <div class="panel-body">
                    @include('pages.task.partials.task-form')

                    @include('module.form-actions')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
