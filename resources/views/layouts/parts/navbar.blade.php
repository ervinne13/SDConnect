<div class="navbar-default navbar navbar-fixed-top">
    <div class="container-fluid">

        <div class="navbar-header">
            <a class="current navbar-brand" href="../index.html">
                <!--<img alt="{{config('organization_name')}}" class="h-20" src="{{skarla_images_url("logo-warning-black@2X.png")}}">-->
            </a>
            <button class="action-right-sidebar-toggle navbar-toggle collapsed" data-target="#navdbar" data-toggle="collapse" type="button" data-original-title="" title="">
                <i class="fa fa-fw fa-align-right"></i>
            </button>
            <button class="navbar-toggle collapsed" data-target="#navbar" data-toggle="collapse" type="button">
                <i class="fa fa-fw fa-user"></i>
            </button>
            <button class="action-sidebar-open navbar-toggle collapsed" type="button">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbar">

            <!-- START Left Side Navbar -->
            <ul class="nav navbar-nav navbar-left clearfix yamm">

                <!-- START Switch Sidebar ON/OFF -->
                <li id="sidebar-switch" class="hidden-xs">
                    <a class="action-toggle-sidebar-slim" data-placement="bottom" data-toggle="tooltip" href="javascript: void(0)" title="" data-original-title="Slim sidebar on/off">
                        <i class="fa fa-lg fa-bars fa-fw"></i>
                    </a>
                </li>
                <!-- END Switch Sidebar ON/OFF -->

                @if (strpos($pageLayout, "sidebar-disabled") !== false)
                <li>
                    <a href="{{url("/home")}}" role="button">
                        <strong>{!!config("app.name_html")!!}</strong>
                    </a>
                </li>
                @endif

                @if (Auth::check())                
                @include('layouts.parts.navbar.user-group-selection-dropdown')                
                <li>
                    <a href="{{url('/material')}}" role="button">
                        <i class="fa fa-folder-open"></i> Materials
                    </a>
                </li>
                
                @if (Auth::user()->isAdmin())
                <li>
                    <a href="{{url('/teachers')}}" role="button">
                        <i class="fa fa-users"></i> Teachers
                    </a>
                </li>
                @endif
                
                @endif
            </ul>
            <!-- START Left Side Navbar -->

            <!-- START Right Side Navbar -->
            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    @if (Auth::check() && Auth::user()->student)
                    @include('layouts.parts.navbar.tasks')
                    @endif
                </li>

                <li role="separator" class="divider hidden-lg hidden-md hidden-sm"></li>

                @if (Auth::check())
                @include('layouts.parts.navbar.user-info-dropdown')               
                @endif                
            </ul>
            <!-- END Right Side Navbar -->
        </div>

    </div>
</div>