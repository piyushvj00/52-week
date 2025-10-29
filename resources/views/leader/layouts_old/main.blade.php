 @include('leader.layouts.partials.header')

    <!-- Main Menu -->
    @include('leader.layouts.partials.sidebar')

        @yield('content')
    @include('leader.layouts.partials.footer')
        @yield('script')
</body>

</html>