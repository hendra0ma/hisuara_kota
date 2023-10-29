@include('layouts.partials.head')
{{-- @include('layouts.partials.sidebar')  --}}
        @include('layouts.partials.header')
        @yield('content')
        @include('layouts.templateRekapitulator.footer-rekapitulator')
        @include('layouts.templateRekapitulator.footer-rekapitulator-var')
</body>
</html>