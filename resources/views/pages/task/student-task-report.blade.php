@extends('layouts.skarla')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            @include('views.loader.rainbow')

            <div class="panel panel-default b-a-0 shadow-box b-b-success">
                <div class="panel-heading">
                    {{$student->userAccount->display_name}} responses on task {{$task->display_name}}                  
                </div>
                <div class="panel-body">
                    
                    <h3>Total Points: {{$taskCompletion->points}}</h3>
                    
                    @foreach($task->items as $taskItem)
                    <p>{{$taskItem->order}}. {{$taskItem->task_item_text}} ({{$taskItem->points}} Point(s))</p>

                    @if ($taskItem->type_code == 'MC')
                    <label>
                        Correct Answer: <span class="text-success">{{$taskItem->correct_answer_free_field}}</span>
                    </label>
                    @elseif ($taskItem->type_code == 'TF')
                    <label>
                        Correct Answer: <span class="text-success">{{$taskItem->correct_answer_free_field == 'true' ? 'True' : 'False'}}</span>
                    </label>
                    @endif

                    @php
                    $response = $responses[$taskItem->order];
                    $displayTextClass = $response->points > 0 ? 'text-success' : 'text-danger'
                    @endphp
                    <label>
                        Your Answer: <span class="{{$displayTextClass}}">{{$response->answer_free_field}}</span>
                    </label>

                    @endforeach
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
