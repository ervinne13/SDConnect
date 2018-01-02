<?php $uses = ["form"]; ?>

@extends('layouts.skarla')

@section('js')

<script>

    let task = {!! $task !!};

</script>


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">            

            @include('views.loader.rainbow')
            
            <div class="panel panel-default b-a-0 shadow-box">
                <div class="panel-heading">
                    {{$task->display_name}}
                </div>
                <div class="panel-body">
                    @php 
                    $orderDisplay = 0; 

                    $taskItems = $task->items;
                    if ($task->randomizes_tasks) {                    
                        $taskItems = $taskItems->shuffle();
                    }
                    @endphp

                    @foreach($taskItems as $taskItem)

                        @php
                            if ($taskItem->type_code === 'MC') {
                                $template = 'pages.task.partials.task-item-mc';
                            } else if ($taskItem->type_code === 'TF') {
                                $template = 'pages.task.partials.task-item-tf';
                            } else {
                                $template = null;
                            }

                            $orderDisplay++;
                        @endphp

                        @if ($template)
                            @include($template, [
                                'orderDisplay' => $orderDisplay,
                                'taskItem' => $taskItem
                            ])
                        @endif

                    @endforeach
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
