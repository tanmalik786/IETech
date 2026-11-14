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
</li>
<li class="nav-item">
    <a href="{{route('manage.mentors')}}" class="nav-link {{Request::is('manage.mentors') ? 'active' : ''}}">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Manage Mentors
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('manage.link-tutors')}}" class="nav-link {{Request::is('manage.link-tutors') ? 'active' : ''}}">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Manage Link Tutors
        </p>
    </a>
</li>
<hr>
<li class="nav-item {{Request::is('pages') || Request::is('pages/*') ? 'menu-is-opening menu-open' : ''}} ">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-copy"></i>
        <p>
            Pages
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('pages')}}" class="nav-link {{Request::is('pages') ? 'active' : ''}}">
                <i class="fas fa-file nav-icon"></i>
                <p>Pages</p>
            </a>
        </li>
    </ul>
</li>