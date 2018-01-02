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
                    @php $order = 1; @endphp

                    @foreach($task->items as $taskItem)

                    @if ($taskItem->type_code === 'MC')
                    @include('pages.task.partials.task-item-mc', [
                        'order' => $order,
                        'taskItem' => $taskItem
                    ])
                    @endif

                    @php $order++; @endphp

                    @endforeach
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
