<div>
    <h4>Calendar Filter</h4>

    <div class="scroll-640 custom-scrollbar">

        <a href="javascript:void(0)" class="action-filter-calendar list-group-item b-r-0 b-t-0 b-l-0" data-filter-group="none">
            <div class="media">
                <div class="media-body media-auto">
                    <h5 class="m-b-0 m-t-0">
                        <strong>No Filter</strong>                        
                    </h5>
                    <p class="m-t-0 m-b-0">
                        <span>Display All Calendar Events</span>
                    </p>
                </div>
            </div>
        </a>

        @foreach($userGroups AS $group)
        <a href="javascript:void(0)" class="action-filter-calendar list-group-item b-r-0 b-t-0 b-l-0" data-filter-group="none">
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

    <a class="btn btn-primary text-center" style="width: 100%" href="{{route('group.index', Auth::user()->getUsername())}}">
        <i class="fa fa-users"></i> Manage / See All Groups
    </a>

    <a class="btn btn-success text-center b-t-1" style="width: 100%" href="{{route('group.create')}}">
        <i class="fa fa-plus"></i> Create New Group
    </a>

</div>