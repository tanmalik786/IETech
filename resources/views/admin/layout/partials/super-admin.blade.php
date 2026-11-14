<li class="nav-item">
    <a href="{{url('dashboard')}}" class="nav-link {{Request::is('dashboard') ? 'active' : ''}}">
        <i class="nav-icon fas fa-chart-bar"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('users')}}" class="nav-link {{Request::is('users') ? 'active' : ''}}">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Users
        </p>
    </a>
    <a href="{{route('superadmin.topics')}}" class="nav-link {{Request::is('superadmin/topics') ? 'active' : ''}}">
        <i class="nav-icon fas fa-edit"></i>
        <p>
            Topics (Forum)
        </p>
    </a>
</li>