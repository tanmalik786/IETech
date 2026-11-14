<li class="nav-item">
    <a href="{{url('dashboard')}}" class="nav-link {{Request::is('dashboard') ? 'active' : ''}}">
        <i class="nav-icon fas fa-chart-bar"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('review-forms')}}" class="nav-link {{(Request::is('review-forms') || Request::is('review-forms/*')) ? 'active' : ''}}">
        <i class="fas fa-star nav-icon"></i>
        <p>Reviews</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('rationale')}}" class="nav-link {{(Request::is('rationale') || Request::is('rationale/*')) ? 'active' : ''}}">
        <i class="fas fa-flag nav-icon"></i>
        <p>Rationale</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('observations')}}" class="nav-link {{(Request::is('observations') || Request::is('observations/*')) ? 'active' : ''}}">
        <i class="fas fa-link nav-icon"></i>
        <p>Observations</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('minimum-core')}}" class="nav-link {{(Request::is('minimum-core') || Request::is('minimum-core/*')) ? 'active' : ''}}">
        <i class="fas fa-gem nav-icon"></i>
        <p>Minimum Core</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('teaching-students')}}" class="nav-link {{(Request::is('teaching-students') || Request::is('teaching-students/*')) ? 'active' : ''}}">
        <i class="fas fa-users nav-icon"></i>
        <p>Teaching Students</p>
    </a>
</li>
@if( auth()->user()->hasRole('Link Tutor') )
    <li class="nav-item">
        <a href="{{route('manage.mentors')}}" class="nav-link {{Request::is('manage.mentors') ? 'active' : ''}}">
            <i class="nav-icon fas fa-user"></i>
            <p>
                Manage Mentors
            </p>
        </a>
    </li>
@endif
<div class="divider"></div>
<li class="nav-item">
    <a href="{{route('admin.blog-posts')}}" class="nav-link {{(Request::is('blog-posts') || Request::is('blog-posts/*')) ? 'active' : ''}}">
        <i class="fas fa-pencil-square nav-icon"></i>
        <p>Blog Posts</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('hourslog.index')}}" class="nav-link {{(Request::is('teaching-hours-log') || Request::is('teaching-hours-log/*')) ? 'active' : ''}}">
        <i class="fas fa-tasks nav-icon"></i>
        <p>Teaching Hours Log</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('action-plans')}}" class="nav-link {{(Request::is('action-plans') || Request::is('action-plans/*')) ? 'active' : ''}}">
        <i class="fas fa-check-square nav-icon"></i>
        <p>Action Plans</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('admin.shadow-forms')}}" class="nav-link {{(Request::is('shadow-forms') || Request::is('shadow-forms/*')) ? 'active' : ''}}">
        <i class="fas fa-search nav-icon"></i>
        <p>Shadow Forms</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('expert.observations')}}" class="nav-link {{(Request::is('expert-observations') || Request::is('expert-observations/*')) ? 'active' : ''}}">
        <i class="nav-icon fas fa-link"></i>
        <p>Expert Observations</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('admin.placement-tasks')}}" class="nav-link {{(Request::is('placement-tasks') || Request::is('placement-tasks/*')) ? 'active' : ''}}">
        <i class="nav-icon fas fa-link"></i>
        <p>Placement Tasks</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('reflections')}}" class="nav-link {{(Request::is('reflections') || Request::is('reflections/*')) ? 'active' : ''}}">
        <i class="fas fa-recycle nav-icon"></i>
        <p>Reflections</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('achievements')}}" class="nav-link {{(Request::is('achievements') || Request::is('achievements/*')) ? 'active' : ''}}">
        <i class="fas fa-trophy nav-icon"></i>
        <p>CPD</p>
    </a>
</li>