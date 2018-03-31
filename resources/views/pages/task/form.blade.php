<?php $uses = ["form", "colorpicker"]; ?>

@extends('layouts.skarla')

@section('js')

<script src="{{url('skarla/assets/vendor/js/toastr.min.js')}}"></script>

<script>

    let group = {!! $group !!};
    let task = {!! $task !!};

</script>

@include('pages.task.modals.post-task')

@include('pages.task.templates.task-view')
@include('pages.task.templates.task-item-list-item')

<script src="{{url("js/views/task/TaskItemListView.js")}}"></script>
<script src="{{url("js/views/task/TaskItemEditorView.js")}}"></script>

<script src="{{url("js/pages/task/modal/post-task.js")}}"></script>
<script src="{{url("js/pages/task/task-form.js")}}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">            

            @include('views.loader.rainbow')
            
            <div class="panel panel-default b-a-0 shadow-box">
                <div class="panel-heading">
                    Task Items (Write questions or activities that the student must accomplish)
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

                    <div class="pull-right">
                        <button id="action-save-post" type="button" class="action-button btn-sm btn btn-success"><i class="fa fa-save"></i> Save & Post</button>
                        <button id="action-save-only" type="button" class="action-button btn-sm btn btn-primary"><i class="fa fa-save"></i> Save Without Posting</button>
                        <a href="{{url('/group/' . $group->code)}}" class="btn btn-sm btn bg-grey">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
