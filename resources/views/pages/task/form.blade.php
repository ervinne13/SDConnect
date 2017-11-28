<?php $uses = ["form", "colorpicker"]; ?>

@extends('layouts.skarla')

@section('js')
<script>

    let task = {!! $task !!};

</script>

@include('pages.task.templates.task-view');

<script src="{{url("js/views/task/TaskView.js")}}"></script>
<script src="{{url("js/views/task/TaskListView.js")}}"></script>

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
                    
                    <div id="task-item-editor-container">

                        <div class="v-a-m">        

                            <div class="media media-auto">
                                <div class="media-left">
                                    <i class="fa fa-question-circle-o fa-5x"></i>
                                </div>
                                <div class="media-body p-l-2">
                                    <span class="media-heading text-gray-darker">About Tasks & Tasks Items</span>                
                                    <span class="media-heading">
                                        <p>
                                            <strong>Tasks</strong> can refer to assignments, quizzes, exams, or anything that you want your students to fulfill.
                                        </p>
                                        <p>
                                            Each task contains one or more <strong>Task Items</strong> which refer to the things that should be answered or accomplished in a task.
                                        </p>

                                        <p>
                                            To add a new task item in this task, click the button below.
                                        </p>

                                        <br>
                                        <div class="text-center">
                                            <button id="action-add-task-item" class="btn btn-success">
                                                <i class="fa fa-plus"></i>
                                                Add a new Task Item Now
                                            </button>
                                        </div>

                                    </span>
                                </div>
                            </div>
                            <!-- End Media -->

                        </div>
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
