<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('librerias\fontawesome-free-6.4.0-web\css\all.css')}}">
    <link rel="stylesheet" href="{{asset('librerias\DataTables\datatables.css')}}">
    <title>{{$titulo}}</title>
</head>
<body>
    @include('sweetalert::alert')
    @yield('contenido')
    <script src="{{asset('librerias\b5\bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('librerias\DataTables\jQuery-3.6.0\jquery-3.6.0.js')}}"></script>
    <script src="{{asset('librerias\DataTables\datatables.js')}}"></script>
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>