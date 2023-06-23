<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{ route('admin.index') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>
                <li class="menu-title">AML Features</li><!-- /.menu-title -->
                <li><a href="{{ route('admin.recent-searches') }}"> <i class="menu-icon fa fa-list"></i>All Searches</a></li>
                <li><a href="{{ route('admin.users') }}"> <i class="menu-icon fa fa-user"></i>All Users</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->