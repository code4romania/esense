<html lang="en">

@include('partials.head')

<link href="{{ asset('assets/scss/esense/landing-page/landing-page.scss') }}" rel="stylesheet">

<body>

    @section('flash')
        <p
            data-control="flash-message"
            class="flash-message fade {{ $type ?? "" }}"
            data-interval="5">
            {{ $message ?? "" }}
        </p>
    @endsection

    @yield('page')

    @include('partials.footer-scripts')

</body>

</html>
