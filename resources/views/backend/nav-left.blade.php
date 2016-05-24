<div class="left_col scroll-view">

    <div class="navbar nav_title" style="border: 0;">
        <a href="{{route('backend::dashboard')}}" class="site_title">
            <i class="fa fa-paw"></i> {{env('APP_NAME')}} CMS            
        </a>
    </div>
    <div class="clearfix"></div>

    <!-- menu prile quick info -->
    <div class="profile">
        <div class="profile_pic">
            <img src="{{Auth::user()->getThumbBySize(128,'avatar')}}" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
            <span>Welcome,</span>
            <h2>{{Auth::user()->name}}</h2>
        </div>
    </div>
    <!-- /menu prile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <h3>General</h3>
            <ul class="nav side-menu">
                <li><a href="{{route('backend::dashboard')}}"><i class="fa fa-home"></i> Home</a>
                </li>                

                @role('admin')
                    <li>
                        <a><i class="fa fa-users"></i> Auth manager</a>
                        <ul class="nav child_menu" style="display: none">
                            @permission('*-user')
                            <li><a href="{{route('backend::user.home')}}">Users </a>
                            </li>
                            @endpermission
                            @permission('edit-role')
                            <li><a href="{{route('backend::role.home')}}">Roles</a>
                            </li>
                            @endpermission           
                        </ul>
                    </li>
                @endrole               
            </ul>
        </div>
    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
        <a data-toggle="tooltip" data-placement="top" title="Settings">
            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Lock">
            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{url('logout')}}">
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
        </a>
    </div>
    <!-- /menu footer buttons -->
</div>