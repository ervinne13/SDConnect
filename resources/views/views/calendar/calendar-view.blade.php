
<div class="col-md-9">
    <div id="calendar"></div>        
</div>

<div class="col-md-3">

    <div>
        <h4 class="m-r-1">Welcome {{Auth::user()->getDisplayName()}}</h4>
        <div class="center-block" style="text-align: center">
            @if (Auth::user()->getImageUrl())
            <img alt="" src="{{asset(Auth::user()->getImageUrl())}}" height="120">
            @else
            <img alt="" src="{{asset('/img/logo-small.jpg')}}" height="120">
            @endif
        </div>
    </div>

    <!-- @include('views.calendar.calendar-filter-view') -->
</div>

@include('pages.user.group.templates.post-template')
@include('pages.user.group.templates.event-template')
@include('pages.user.group.templates.task-template')