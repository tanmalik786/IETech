<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
        <img src="{{asset('images/logo.png')}}" alt="IET Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">IET</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @if(auth()->user()->hasRole('Teaching Student'))
                    @include('admin.layout.partials.sidebar-teaching-student')
                @elseif(auth()->user()->hasRole('Institute Admin'))
                    @include('admin.layout.partials.sidebar-department-head')
                @elseif(auth()->user()->hasAnyRole(['Link Tutor', 'Mentor']))
                    @include('admin.layout.partials.sidebar-link-mentor')
                @elseif(auth()->user()->hasRole('Super Admin'))
                    @include('admin.layout.partials.super-admin')
                @else
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>