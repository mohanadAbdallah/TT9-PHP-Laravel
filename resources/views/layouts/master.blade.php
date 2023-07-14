<!doctype html>
<html lang="en">
@include('partials.header')
<body>



<div class="page-content">
    <!-- Main sidebar -->
    <!-- /main sidebar -->
    <!-- Main content -->
    <div class="content-wrapper">
        <div class="content">
            @include('partials.navbar')
            @yield('content')
        </div>
        <!-- Footer -->
    @include('partials.footer')
    <!-- /footer -->
    </div>
</div>

</body>

</html>


