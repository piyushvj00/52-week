 @include('user.layouts.partials.header')

    <!-- Main Menu -->
    @include('user.layouts.partials.sidebar')

        @yield('content')
    @include('user.layouts.partials.footer')
        @yield('script')
</body>

</html>