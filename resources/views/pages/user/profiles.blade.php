@extends('layouts.skarla')

@section('vendor-js')
<script src="{{url("vendor/underscore/underscore.js")}}"></script>
@endsection

@section('js')

<script src="{{url("js/pages/user/profiles.js")}}"></script>

<script type="text/javascript">

$(document).ready(function () {
    Profiles.init();
});

</script>

@include('pages.user.profile-card-template')

@endsection

@section('content')
<div class="container">
    <div class="row m-t-1">

        <div class="col-lg-8">
            <ul class="nav nav-tabs">
                <li role="presentation" class="active">
                    <a aria-expanded="true" data-toggle="tab" href="#tab-students" role="tab">
                        Students
                    </a>
                </li>
                <li role="presentation">
                    <a aria-expanded="true" data-toggle="tab" href="#tab-teachers" role="tab">
                        Teachers
                    </a>
                </li>

            </ul>

            <div class="tab-content">

                <!-- START Tab Content: People -->
                <div class="tab-pane fade in active p-r-1" id="tab-students" role="tabpanel">

                    <div class="input-group m-t-1">
                        <input type="text" class="form-control filter-field" data-filter-code="students" placeholder="Search for student name">
                        <span class="input-group-btn">
                            <button class="btn btn-primary filter-trigger" type="button" style="height: 32px;" data-filter-code="students">
                                <i class="fa fa-fw fa-search"></i>
                            </button>
                        </span>
                    </div>

                    <!-- START Table Users -->
                    <div class="table-responsive m-t-2" style="max-height: 400px; overflow-y: scroll">
                        <table class="table table-hover m-b-0">

                            <!-- START Head Table -->
                            <thead>
                                <tr>                                    
                                    <th class="small text-muted text-uppercase">
                                        <strong>Has Badge</strong>
                                    </th>
                                    <th class="small text-muted text-uppercase">
                                        <strong>Student</strong> 
                                    </th>                      
                                    <th class="small text-muted text-uppercase text-right">
                                        <strong>Actions</strong> 
                                    </th>
                                </tr>
                            </thead>
                            <!-- END Head Table -->

                            <tbody class="filterable-container" data-filter-code="students">

                                @foreach($students as $student)                              
                                @include('pages.user.profile-list-item', ['model' => $student])
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>

                <!-- START Tab Content: Teachers -->
                <div class="tab-pane fade in p-r-1" id="tab-teachers" role="tabpanel">

                    <div class="input-group m-t-1">
                        <input type="text" class="form-control filter-field" data-filter-code="teachers" placeholder="Search for teacher name">
                        <span class="input-group-btn">
                            <button class="btn btn-primary filter-trigger" type="button" style="height: 32px;" data-filter-code="teachers">
                                <i class="fa fa-fw fa-search"></i>
                            </button>
                        </span>
                    </div>

                    <!-- START Table Users -->
                    <div class="table-responsive m-t-2" style="max-height: 400px; overflow-y: scroll">
                        <table class="table table-hover m-b-0">

                            <!-- START Head Table -->
                            <thead>
                                <tr>                                    
                                    <th class="small text-muted text-uppercase">
                                        <strong>Has Badge</strong>
                                    </th>
                                    <th class="small text-muted text-uppercase">
                                        <strong>Teacher</strong> 
                                    </th>                      
                                    <th class="small text-muted text-uppercase text-right">
                                        <strong>Actions</strong> 
                                    </th>
                                </tr>
                            </thead>
                            <!-- END Head Table -->

                            <tbody class="filterable-container" data-filter-code="teachers">

                                @foreach($teachers as $teacher)                              
                                @include('pages.user.profile-list-item', ['model' => $teacher])
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

        </div>        

        <!-- START Profile Details -->
        <div class="col-lg-4">

            <div class="tab-content">

                <!-- START Person Detail #1 -->
                <div id="profile-card-container" class="tab-pane fade in active p-r-1" id="tab-person-detail-1" role="tabpanel">

                </div>
                <!-- END Person Detail #1 -->

            </div>
        </div>
        <!-- END People Details -->

    </div>

</div>
@endsection
