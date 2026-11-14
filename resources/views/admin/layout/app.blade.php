<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IET | Portal</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('vendor/adminlte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('vendor/adminlte/css/adminlte.min.css')}}">
    <style>
        .divider {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 1px solid #fff;
        }

        nav[role="navigation"] {
            display: flex;
            flex-direction: row;
            align-items: center !important;
            justify-content: flex-start !important;
        }

        nav[role="navigation"] div:nth-child(1) {
            display: none;
        }

        nav[role="navigation"]  svg {
            width: 10px;
            height: 10px;
        }
    </style>
    @stack('page-styles')

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
@include('admin.layout.header')
<!-- /.navbar -->

    <!-- Main Sidebar Container -->
@include('admin.layout.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @if(session()->has('viewing') && ! empty(session()->get('viewing')))
            <div class="alert alert-info fade show text-center d-flex gap-2 align-items-center py-2" role="alert">
                Viewing information of <strong class="ml-2">  {{session()->get('viewing')->full_name}}</strong>.
                <form action="{{route('impersonate.logout')}}" method="POST" class="ml-2">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger" name="stop_impersonating" value="true">Switch Back</button>
                </form>
            </div>
        @endif
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h3 class="m-0 text-dark">@yield('page-title')</h3>
                        @yield('page-subtitle')
                    </div><!-- /.col -->
                    <div class="col-sm-12">
                        @yield('page-breadcrumb')
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            @yield('content')
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
@include('admin.layout.sidebar-right')
<!-- /.control-sidebar -->

    <!-- Main Footer -->
    @include('admin.layout.footer')
    @include('admin.common.delete-record-modal')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('vendor/adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('vendor/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('vendor/adminlte/js/adminlte.min.js')}}"></script>

<script>
  $('#deleteRecordModal').on('show.bs.modal', function(event) {
    const modalEl = $('#deleteRecordModal');
    const button = $(event.relatedTarget);
    const action = button.data('action');
    modalEl.find('form').attr('action', action);
  });
</script>

@stack('page-scripts')
</body>
</html>
