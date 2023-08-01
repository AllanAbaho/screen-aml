<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{ route('dashboard.index') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>
                <li class="menu-title">AML Features</li><!-- /.menu-title -->
                <li><a href="{{ route('dashboard.recent-searches') }}"> <i class="menu-icon fa fa-list"></i>My Searches</a></li>
                <li class="menu-item-has-children dropdown show">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="menu-icon fa fa-list-alt"></i>Search</a>
                    <ul class="sub-menu children dropdown-menu show">
                        <li><i class="menu-icon fa fa-user"></i><a href="{{ route('dashboard.ugandan-person') }}">Ugandan Person</a></li>
                        <li><i class="menu-icon fa fa-building"></i><a href="{{ route('dashboard.ugandan-company') }}">Ugandan Company</a></li>
                        <li><i class="menu-icon fa fa-search"></i><a href="{{ route('dashboard.search-form') }}">Foreign Search</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->