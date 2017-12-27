<?php $uses = ["datepicker", "timepicker", "icheck", "fullcalendar", "sg-formatter"]; ?>

@extends('layouts.skarla')

@section('css')

<!--<style>
    .group-members-table .dropdown-menu {
        z-index: 10000;
    }
</style>-->

@endsection

@section('vendor-js')
<script src="{{url("vendor/underscore/underscore.js")}}"></script>
@endsection

@section('js')
<script>
let group = {!! $group !!};
</script>

@include('pages.user.group.templates.post-container-template')
@include('pages.user.group.templates.post-template')
@include('pages.user.group.templates.event-template')
@include('pages.user.group.templates.task-template')

<script src="{{url("js/pages/user/group/view-controllers/PostViewController.js")}}"></script>

<script src="{{url("js/pages/user/group/group.js")}}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7">

            <div class="panel panel-default b-a-0 shadow-box">                
                <div class="panel-heading tabbable-line">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item active">
                            <a class="nav-link" data-toggle="tab" href="#post" role="tab" aria-controls="post">Announcements</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#event" role="tab" aria-controls="event">Event</a>
                        </li>

                        @if ($group->getType() === 'Class')                        
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#task" role="tab" aria-controls="task">Graded Task (Quizzes, Assignments, etc.)</a>
                        </li>
                        @endif
                    </ul>                   
                </div>

                <div class="tab-content">
                    <div class="tab-pane active" id="post" role="tabpanel">
                        @include('pages.user.group.tab-content.create-post')
                    </div>
                    <div class="tab-pane" id="event" role="tabpanel">
                        @include('pages.user.group.tab-content.create-event')
                    </div>
                    @if ($group->getType() === 'Class') 
                    <div class="tab-pane" id="task" role="tabpanel">
                        @include('pages.user.group.tab-content.create-task')
                    </div>
                    @endif
                </div>

            </div>

            <h4>Posts on {{$group->getDisplayName()}}</h4>

            <div class="posts-container">

            </div>

            <div class="posts-action-container">
                <button id="action-load-more-posts" class="btn btn-primary full-width">
                    <i class="fa fa-refresh"></i>
                    Load More ...
                </button>
            </div>
        </div>

        @if ($group->getOwner()->getUsername() == Auth::user()->getUsername() && !$group->isSystemGenerated())
        @include('pages.user.group.partials.manage-group-panel')
        @endif

        @include('pages.user.group.partials.about-group-panel')
    </div>
</div>
@endsection
