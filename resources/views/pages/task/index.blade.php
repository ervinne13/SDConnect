@extends('layouts.skarla')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2"> 

            <div class="panel panel-default b-a-0 shadow-box b-b-success">
                <div class="panel-heading">
                    My Tasks
                    <span class="pull-right">

                    </span>
                </div>
                <div class="panel-body">
                    @foreach($posts as $post)
                    <div class="v-a-m">
                        <div class="media media-auto">
                            <div class="media-left">
                                <div class="avatar avatar-image {{$post->author->image_url ? 'loaded' : ''}}">
                                    <img class="media-object img-circle" src="<%= author.image_url %>" alt="Avatar">                           
                                </div>
                            </div>
                            <div class="media-body">
                                <span class="media-heading text-gray-darker">Created by {{$post->author->display_name}}</span>
                                <br>
                                <span class="media-heading">
                                    <p>
                                        <b>Group: <span  style="color: rgb(100, 189, 99);">{{$post->group->display_name}}</span></b>
                                    </p>

                                    <p>
                                        <b>{{task_type_name($post->task->type_code)}}: <span  style="color: rgb(100, 189, 99);">{{$post->task->display_name}}</span></b>
                                    </p>

                                    <p>{{$post->content}}</p>
                                </span>
                                <span class="media-body">
                                    Deadline: {{Carbon\Carbon::parse($post->date_time_to)->format('M d Y')}}
                                    @if (!$post->task->student_number)
                                    <p>
                                        <a href="{{url('task/' . $post->task->id)}}">View This Task</a>
                                    </p>              
                                    @else
                                    <label style="color: rgb(100, 189, 99);">You already did this task</label>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
