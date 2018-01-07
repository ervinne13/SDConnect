<?php

use App\Modules\System\Post\Post;

$uses = ["form"];
?>

@extends('layouts.skarla')

@section('js')

<script src="{{url("js/pages/task/task-report.js")}}"></script>

<script>

let task = {!! $task !!}
;

</script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">            

            @include('views.loader.rainbow')

            @foreach($task->groups_posted as $group)

            @php
            $post = Post::whereGroupCode($group->code)
            ->whereRelatedDataId($task->id)
            ->whereModule('Task')
            ->first();

            $members = $group->members;
            $studentMemberCount = 0;
            foreach($members as $member) {
            if ($member->student) {
            $studentMemberCount++;
            }
            }
            @endphp

            <div class="panel panel-default b-a-0 shadow-box b-b-success">
                <div class="panel-heading">
                    {{$task->display_name}} on Group: {{$group->display_name}}                    
                </div>
                <div class="panel-body">

                    <div class="hr-text m-t-2 hr-text-center">
                        <h6 class="text-gray-darker"><strong>Task Data</strong></h6>
                    </div>

                    <table class="table v-a-m">
                        <tbody>
                            <tr class="v-a-m b-t-0">
                                <td class="b-t-0"> Task Deadline </td>
                                <td class="text-right v-a-m text-gray-darker b-t-0">{{Carbon\Carbon::parse($post->date_time_to)->format('M d Y')}}</td>
                            </tr>
<!--                            <tr class=" v-a-m">
                                <td> Number of Students who submitted </td>
                                <td class="text-right v-a-m text-gray-darker"><span>1</span></td>
                            </tr>-->
                            <tr class=" v-a-m">
                                <td> Total number of students in group </td>
                                <td class="text-right v-a-m text-gray-darker">{{count($studentMemberCount)}}</td>
                            </tr>
                        </tbody>
                    </table>

                    <a href="{{url('/task/' . $task->id .'/group/' . $group->code . '/report')}}" target="_blank" class="btn btn-success btn-lg btn-block">Download Task Results</a>
                </div>
            </div>

            @endforeach
        </div>

    </div>
</div>
@endsection
