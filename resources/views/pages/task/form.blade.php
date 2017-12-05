<?php $uses = ["form", "colorpicker"]; ?>

@extends('layouts.skarla')

@section('js')
<script>

    let task = {!! $task !!}
    ;

</script>

@include('pages.task.templates.task-view')
@include('pages.task.templates.task-item-list-item')

<script src="{{url("js/views/task/TaskItemListView.js")}}"></script>
<script src="{{url("js/views/task/TaskItemEditorView.js")}}"></script>

<script src="{{url("js/pages/task/task-form.js")}}"></script>
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

                    <div class="col-sm-2 m-r-0">
                        <div id="task-item-list-container" class="list-group shadow-box">                            
                        </div>

                        <div id="add-task-item-container-2">

                        </div>
                    </div>

                    <div class="col-sm-10 m-l-0">
                        @include('pages.task.partials.task-item-editor-container')
                    </div>                    

                    <!-- End Container -->
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default b-a-0 shadow-box">
                <div class="panel-heading">
                    Task (<span>{{$routeAction == "create" ? "Create New" : "Edit {$task->getDisplayName()}" }}</span>)
                </div>
                <div class="panel-body">
                    @include('pages.task.partials.task-header-form')

                    @include('module.form-actions')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
