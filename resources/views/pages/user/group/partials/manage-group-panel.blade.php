<div class="col-md-5">
    <div class="panel panel-default b-a-0 shadow-box">
        <div class="panel-heading">
            Manage Group
        </div>
        <div class="panel-body">
            <ul class="p-l-0">
                <li class="list-group-item b-a-0 p-x-0 b-b-0 p-y-0 r-a-0">
                    <a class="list-group-item text-center b-b-0 b-r-0 b-l-0 b-r-b-r-0 b-r-b-l-0" href="{{route('group.edit',  $group->getCode())}}">
                        <i class="fa fa-users"></i> Edit This Group
                    </a>
                </li>

                <li class="list-group-item b-a-0 p-x-0 b-b-0 p-y-0 r-a-0">
                    <a id="action-delete-group" class="list-group-item text-center b-b-0 b-r-0 b-l-0 b-r-b-r-0 b-r-b-l-0" href="javascript:void(0)">
                        <i class="fa fa-remove"></i> <span class="text-danger">Delete This Group</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>