<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('includes.admin.head')
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('includes.admin.header')
        @include('includes.admin.left_menu')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @include('includes.admin.heading')
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        @include('includes.admin.footer')
        @include('includes.admin.right_menu')
    </div>
    @include('includes.admin.scripts')
</body>
</html>
