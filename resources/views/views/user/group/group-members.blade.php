

<div class="table-responsive">
    <table class="table table-hover group-members-table">

        <!-- START Head Table -->
        <thead>
            <tr>                    
                <th class="small text-muted text-uppercase"><strong>Member</strong> </th>
                <th class="small text-muted text-uppercase text-right"><strong>Actions</strong> </th>
            </tr>
        </thead>
        <!-- END Head Table -->

        <tbody>

            @foreach($members AS $member)

            <!-- START Row -->
            <tr>                                
                <td class="v-a-m">
                    <div class="media">
                        <div class="media-left media-middle media-middle">
                            <a href="javascript: void(0)" data-toggle="tooltip" data-placement="top" title="" data-original-title="Go to Full Profile">
                                <div class="avatar avatar-image"> 
                                    <img class="media-object img-circle" src="{{asset($member->getImageUrl())}}" alt="Avatar">
                                </div>
                            </a>
                        </div>
                        <div class="media-body media-auto">
                            <h5 class="m-b-0"><span>{{$member->getDisplayName()}}</span></h5>
                            <p class="m-t-0"><span>{{$member->getSerializedRoleNames()}}</span></p>
                        </div>
                    </div>
                </td>

                <td class="text-right v-a-m">
                    @if ($group->getOwner()->getUsername() == Auth::user()->getUsername() && $member->getUsername() !=  Auth::user()->getUsername())
                    <div class="dropdown">
                        <button class="btn btn-default btn-sm  dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> 
                            <i class="fa fa-bars m-r-1"></i> 
                            <span class="caret"></span> 
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a href="javascript: void(0)" data-toggle="modal" data-target=".bs-example-modal-sm">
                                    <i class="fa fa-fw text-gray-lighter fa-remove m-r-1"></i> Kick
                                </a>
                            </li>
                            <!--                            <li>
                                                            <a href="javascript: void(0)" data-toggle="modal" data-target=".bs-example-modal-sm">
                                                                <i class="fa fa-fw text-gray-lighter fa-remove m-r-1"></i> Ban
                                                            </a>
                                                        </li>-->
                        </ul>
                    </div>
                    @endif
                </td>
            </tr>
            <!-- END Row -->
            @endforeach

        </tbody>
    </table>
</div>
