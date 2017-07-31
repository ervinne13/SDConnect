<?php $uses = ["form", "colorpicker"]; ?>

@extends('layouts.skarla')

@section('js')
<script>

    let group = {!! $group !!};

</script>

<script src="{{url("js/pages/user/group/form.js")}}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default b-a-0 shadow-box">
                <div class="panel-heading">
                    Group (<span>{{$routeAction == "create" ? "Create New" : "Edit {$group->getDisplayName()}" }}</span>)
                </div>
                <div class="panel-body">
                    @include('pages.user.group.partials.form') 

                    @include('module.form-actions')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
