<tr>
    <td class="v-a-m text-center">
        <a href="javascript:;" data-toggle="tooltip" data-placement="top">
            <i class="fa fa-fw fa-star-o text-muted fa-lg"></i>
            <i class="fa fa-fw fa-star text-lighting-yellow fa-lg"></i>
        </a>
    </td>
    <td class="v-a-m">
        <div class="media">
            <div class="media-left media-middle">
                <div class="avatar avatar-image"> 
                    <img class="media-object img-circle" src="{{$model->userAccount->image_url}}" alt="Avatar">
                </div>
            </div>
            <div class="media-body media-auto">
                <h5 class="m-b-0">
                    <strong>{{$model->userAccount->display_name}}</strong>
                </h5>
                <p class="m-t-0">
                    <span>
                        {{implode(', ', array_column($model->userAccount->groups->toArray(), 'display_name'))}}
                    </span>
                </p>
            </div>
        </div>
    </td>                                 
    <td class="v-a-m text-right">
        <h5>
            <a href="javascript:;" class="action-show-profile" data-username="{{$model->userAccount->username}}">
                <i class="fa fa-search"></i>
                Show Profile
            </a>
        </h5>
    </td>

</tr>