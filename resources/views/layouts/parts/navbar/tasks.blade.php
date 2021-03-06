<!-- START Icon Notification with Badge (10)-->
<a class="dropdown-toggle" data-toggle="dropdown" href="javascript: void(0)" role="button" aria-expanded="false">
    <i class="fa fa-lg fa-fw fa-bell hidden-xs"></i>
    <span class="hidden-sm hidden-md hidden-lg">
        Notifications <span class="badge badge-primary m-l-1">{{count($tasks)}}</span>
    </span>
    <span class="label label-primary label-pill label-with-icon hidden-xs">{{count($tasks)}}</span>
    <span class="fa fa-fw fa-angle-down hidden-lg hidden-md hidden-sm"></span>
</a>
<!-- END Icon Notification with Badge (10)-->

<!-- START Notification Dropdown Menu -->
<ul class="dropdown-menu dropdown-menu-right p-t-0 b-t-0 p-b-0 b-b-0 b-a-0">
    <li>
        <div class="yamm-content p-t-0 p-r-0 p-l-0 p-b-0">
            <ul class="list-group m-b-0 b-b-0">
                <li class="list-group-item b-r-0 b-l-0 b-r-0 b-t-r-0  b-t-l-0 b-b-2 w-350">
                    <small class="text-uppercase">
                        <strong>Tasks</strong>
                    </small>
                </li>

                <!-- START Scroll Inside Panel -->
                <li class="list-group-item b-a-0 p-x-0 p-y-0 b-t-0">
                    <div class="scroll-300 custom-scrollbar ps-container ps-theme-default" data-ps-id="7b107e6f-c2c4-a04a-e075-743a7512b50c">

                        @if (count($tasks) <= 0)
                        <div class="media">
                            <div class="media-body" style="padding: 10px;">
                                <p>
                                    <b>Nice!</b> You don't currently have any tasks pending
                                </p>
                            </div>
                        </div>
                        @endif

                        @foreach($tasks as $task)                        
                        <a href="{{url('task/' . $task->id)}}" class="list-group-item b-r-0 b-l-0">
                            <div class="media">
                                <div class="media-left">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle-thin fa-stack-2x text-warning"></i>
                                        <i class="fa fa-exclamation fa-stack-1x fa-fw text-warning"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <h5 class="m-t-0">
                                        <b>{{task_type_name($task->type_code)}}: {{$task->display_name}}</b>
                                        <p>{{$task->post->content}}</p>
                                    </h5>
                                    <p class="text-nowrap small m-b-0">
                                        <span>05-Sep-2014, 05:01</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endforeach

                        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                </li>

                <!-- END Scroll Inside Panel -->
                <li class="list-group-item b-a-0 p-x-0 p-y-0 r-a-0 b-b-0">
                    <a class="list-group-item text-center b-r-0 b-b-0 b-l-0 b-r-b-r-0 b-r-b-l-0" href="{{url('task')}}">
                        See All Tasks <i class="fa fa-angle-right"></i>
                    </a>
                </li>
                <!--                <li class="list-group-item b-a-0 p-x-0 p-y-0 r-a-0 b-b-0">
                                    <a class="list-group-item text-center b-r-0 b-b-0 b-l-0 b-r-b-r-0 b-r-b-l-0" href="../pages/timeline.html">
                                        See All Open Tasks <i class="fa fa-angle-right"></i>
                                    </a>
                                </li>-->
            </ul>
        </div>

    </li>
</ul>
<!-- END Notification Dropdown Menu -->