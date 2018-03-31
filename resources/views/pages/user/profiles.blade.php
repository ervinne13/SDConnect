@extends('layouts.skarla')

@section('js')

<script type="text/javascript">

</script>

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
                        <input type="text" class="form-control" placeholder="Search for student name">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="button" style="height: 32px;">
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

                            <tbody>

                                @foreach($students as $student)                              
                                @include('pages.user.profile-list-item', ['model' => $student])
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>

                <!-- START Tab Content: Teachers -->
                <div class="tab-pane fade in p-r-1" id="tab-teachers" role="tabpanel">

                </div>

            </div>

        </div>        

        <!-- START Profile Details -->
        <div class="col-lg-4">

            <div class="tab-content">

                <!-- START Person Detail #1 -->
                <div class="tab-pane fade in active p-r-1" id="tab-person-detail-1" role="tabpanel">
                    <div class="panel panel-default b-a-0 shadow-box">
                        <div class="panel-body">

                            <!-- START Avatar with Name -->
                            <div class="media m-l-1">
                                <div class="media-left">
                                    <div class="center-block">
                                        <div class="avatar avatar-image avatar-lg center-block">
                                            <img class="img-circle center-block m-t-1 m-b-2" src="https://s3.amazonaws.com/uifaces/faces/twitter/joshhemsley/128.jpg" alt="Avatar">                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="media-body ">
                                    <h4 class="m-b-0">
                                        <span>Gus Kub</span>                                       
                                    </h4>
                                    <p class="m-t-0"><span>Lead Brand Technician</span></p>
                                    <button type="button" class="btn btn-success">
                                        <i class="fa fa-star-o"></i>
                                        Give Badge
                                    </button>
                                </div>
                            </div>
                            <!-- END Avatar with Name -->

                            <div class="hr-text hr-text-left">
                                <h6 class="text-gray-darker bg-white-i">
                                    <strong>About</strong>
                                </h6>
                            </div>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta sapiente earum, necessitatibus commodi eius pariatur repudiandae cum sunt officiis ex!
                            <div class="hr-text hr-text-left m-t-2">
                                <h6 class="text-gray-darker bg-white-i">
                                    <strong>Badges</strong>
                                </h6>
                            </div>
                            <span class="badge badge-gray-dark badge-outline">
                                <span>
                                    <i class="fa fa-fw fa-star text-lighting-yellow fa-lg"></i>
                                    Punctuality
                                </span>
                            </span>

                            <span class="badge badge-gray-dark badge-outline">
                                <span>
                                    <i class="fa fa-fw fa-star text-lighting-yellow fa-lg"></i>
                                    Creativity
                                </span>
                            </span>

                            <span class="badge badge-gray-dark badge-outline">
                                <span>
                                    <i class="fa fa-fw fa-star text-lighting-yellow fa-lg"></i>
                                    Activeness
                                </span>
                            </span>

                            <span class="badge badge-gray-dark badge-outline">
                                <span>
                                    <i class="fa fa-fw fa-star text-lighting-yellow fa-lg"></i>
                                    Early Bird
                                </span>
                            </span>

                        </div>
                    </div>
                </div>
                <!-- END Person Detail #1 -->

            </div>
        </div>
        <!-- END People Details -->

    </div>

</div>
@endsection
