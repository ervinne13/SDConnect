<li class="dropdown">
    <a class="dropdown-toggle user-dropdown" data-toggle="dropdown" href="javascript: void(0)" role="button" aria-expanded="true">
        <span class="m-r-1">{{Auth::user()->getDisplayName()}}</span>
        <div class="avatar avatar-image avatar-inline">
            @if (Auth::user()->getImageUrl())
            <img alt="" src="{{asset(Auth::user()->getImageUrl())}}">
            @else
            <img alt="" src="{{asset('/img/logo-small.jpg')}}">
            @endif
        </div>
    </a>
    <div class="dropdown-menu">
        <div class="yamm-content p-t-0 p-r-0 p-l-0 p-b-0">
            <ul class="list-group m-b-0">
                <li class="list-group-item b-r-0 b-l-0 b-r-0 b-t-r-0 b-t-l-0 b-b-2 w-350">
                    <small class="text-uppercase">
                        <strong>Account</strong>
                    </small>
                </li>

                <li class="list-group-item">
                    <a href="../apps/profile-edit.html">
                        <i class="fa fa-gear fa-fw text-gray-dark m-r-1"></i>
                        Your Account
                    </a>
                </li>

                <li class="list-group-item b-b-0">
                    <a href="{{url('/logout')}}">
                        <i class="fa fa-sign-out fa-fw text-gray-dark m-r-1"></i>
                        Log Out
                    </a>
                </li>
            </ul>
        </div>

    </div>

</li>