@include('layouts.partials.head')
{{-- @include('layouts.partials.sidebar')  --}}
        @include('layouts.partials.header')
        @yield('content')
        @include('layouts.templateRekapitulatorKota.footer-rekapitulator')
        @include('layouts.templateRekapitulatorKota.footer-rekapitulator-var')
</body>
</html>