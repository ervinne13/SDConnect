<?php $uses = ["datepicker", "timepicker", "icheck", "fullcalendar"]; ?>

@extends('layouts.skarla')

@section('js')
<script src="{{url("js/views/calendar/calendar-view.js")}}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default b-a-0 shadow-box">
                <div class="panel-heading">
                    Groups
                </div>
                <div class="panel-body">
                    @foreach($groups AS $group)
                    <a href="{{route("group.show", $group->getCode())}}" class="action-filter-calendar list-group-item b-r-0 b-t-0 b-l-0" data-filter-group="none">
                        <div class="media">
                            <div class="media-left media-auto">
                                <div class="avatar">
                                    <i class="fa fa-users fa-2x" style="color: {{$group->getColor()}}"></i>
                                </div>
                            </div>
                            <div class="media-body media-auto p-l-2">
                                <h5 class="m-b-0 m-t-0">
                                    <span>{{$group->getCode()}}</span>
                                    <small><span>{{$group->getOwner()->getDisplayName()}}</span></small>
                                </h5>
                                <p class="m-t-0 m-b-0">
                                    <span>{{$group->getDisplayName()}}</span>
                                </p>
                            </div>                           
                        </div>
                    </a>
                    @endforeach    
                </div>
                <div class="panel-footer">
                    <a class="btn btn-success text-center b-t-1 pull-right" href="{{route('group.create')}}">
                        <i class="fa fa-plus"></i> Create New Group
                    </a>

                    <div class="clearfix"></div>
                </div>

            </div>
        </div>       
    </div>

</div>
@endsection
