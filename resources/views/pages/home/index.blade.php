<?php $uses = ["datepicker", "timepicker", "icheck", "fullcalendar"]; ?>

@extends('layouts.skarla')

@section('css')
<style>
    .fc-event-container {
        cursor: pointer
    }
</style>
@endsection

@section('vendor-js')
<script src="{{url("vendor/underscore/underscore.js")}}"></script>
@endsection

@section('js')
<script src="{{url("js/views/calendar/calendar-view.js")}}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default b-a-0 shadow-box">
                <div class="panel-heading">
                    System Calendar                    
                </div>
                <div class="panel-body">
                    @include('views.calendar.calendar-view')
                </div>
            </div>
        </div>
    </div>
</div>

@include('pages.home.modals.event-view-modal')

@endsection
