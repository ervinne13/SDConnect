<div class="col-md-5">
    <div class="panel panel-default b-a-0 shadow-box">
        <div class="panel-heading">
            <h4 class="pull-right m-t-0">{{$group->getDisplayName()}}</h4>
            About the Group
        </div>
        <div class="panel-body">

            <strong>Group Code:</strong> <span>(Use this to let users join this group)</span>            
            <p>
                <strong class="text-success">
                    {{$group->code}}
                </strong>
            </p>

            <strong>Description:</strong>
            <p>
                {{$group->description or "No description set for this group."}}
            </p>

            <strong>Members:</strong>
            @include('views.user.group.group-members')
        </div>
    </div>
</div>