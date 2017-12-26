<div class="pull-right">
    @if($routeAction == "edit")
    <button id="action-update-close" type="button" class="action-button btn-sm btn btn-success">Update</button>
    @elseif($routeAction == "create")
    <button id="action-create-close" type="button" class="action-button btn-sm btn btn-success">Save</button>
    <button id="action-create-new" type="button" class="action-button btn-sm btn btn-primary">Save & New</button>
    @endif  

    <button id="action-close" type="button" class="action-button btn-sm btn bg-grey">Close</button>
</div>