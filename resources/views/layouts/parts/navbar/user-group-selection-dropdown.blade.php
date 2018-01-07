<li class="dropdown">
    <a class="dropdown-toggle user-dropdown" data-toggle="dropdown" href="javascript: void(0)" role="button" aria-expanded="true">
        <span class="m-r-1">{!!$currentGroup or "<strong>Switch Group</strong> <i class='fa fa-caret-down'></i>"!!}</span>      
    </a>
    <div class="dropdown-menu">

        <div class="yamm-content p-t-0 p-r-0 p-l-0 p-b-0">
            <ul class="list-group m-b-0">
                <li class="list-group-item b-r-0 b-l-0 b-r-0 b-t-r-0 b-t-l-0 b-b-2 w-350">
                    <small class="text-uppercase">
                        <strong>Select a group to switch views</strong>
                    </small>                        
                </li>

                <li class="list-group-item b-a-0 p-x-0 p-y-0 b-t-0">
                    <div class="scroll-200 custom-scrollbar">

                        @foreach($userGroups AS $group)
                        <a href="{{route('group.show', $group->getCode() )}}" class="list-group-item b-r-0 b-t-0 b-l-0">
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
                </li>

                @if ($currentGroup !== null)
                <li class="list-group-item b-a-0 p-x-0 b-b-0 p-y-0 r-a-0">
                    <a class="list-group-item text-center b-b-0 b-r-0 b-l-0 b-r-b-r-0 b-r-b-l-0" href="{{url("home")}}">
                        <i class="fa fa-home"></i> Back to Home Page
                    </a>
                </li>

                @endif

                <li class="list-group-item b-a-0 p-x-0 b-b-0 p-y-0 r-a-0">
                    <a class="list-group-item text-center b-b-0 b-r-0 b-l-0 b-r-b-r-0 b-r-b-l-0" href="{{url("group")}}">
                        <i class="fa fa-users"></i> Manage / See All My Groups
                    </a>
                </li>

                <li class="list-group-item b-a-0 p-x-0 b-b-0 p-y-0 r-a-0">
                    <a class="action-trigger-join-group list-group-item text-center b-b-0 b-r-0 b-l-0 b-r-b-r-0 b-r-b-l-0" href="javascript:void(0)">
                        <i class="fa fa-user-plus"></i> Join Group
                    </a>
                </li>

                @if (!Auth::user()->student)
                <li class="list-group-item b-a-0 p-x-0 b-b-0 p-y-0 r-a-0">
                    <a class="list-group-item text-center b-b-0 b-r-0 b-l-0 b-r-b-r-0 b-r-b-l-0" href="{{url("group/create")}}">
                        <i class="fa fa-plus"></i> Create New Group
                    </a>
                </li>
                @endif
            </ul>

        </div>

    </div>

</li>

@include('layouts.parts.navbar.join-group-modal')