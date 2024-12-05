<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts-current.title-meta')
    @include('layouts-current.head')
</head>

@section('body')

    <body style="background-color: gainsboro">
    @show
    @yield('content')
    @include('layouts-current.vendor-scripts')
</body>

</html>
