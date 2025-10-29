 @include('admin.layouts.partials.header')

    <!-- Main Menu -->
    @include('admin.layouts.partials.sidebar')

        @yield('content')
    @include('admin.layouts.partials.footer')
        @yield('script')
</body>

</html>