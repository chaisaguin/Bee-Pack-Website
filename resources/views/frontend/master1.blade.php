<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>@yield('title', 'Bee Pack')</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    
    @yield('extra-css')
</head>
<body>
    @include('components.navbar')
    @yield('content')
    


    <script src="{{ asset('js/main.js') }}"></script>
    @yield('extra-js')
</body>
</html>

