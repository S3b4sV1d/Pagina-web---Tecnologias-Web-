{{-- resources/views/layouts/app.blade.php --}}

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Trux-up')</title>

    {{-- Bootstrap --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    {{-- CSS principal --}}
    <link rel="stylesheet" href="{{ asset('styles/estilos.css') }}">

    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/4df0087ba8.js" crossorigin="anonymous"></script>

    @stack('styles')
</head>
<body>

    {{-- Header global --}}
    @include('partials.header')

    {{-- Contenido variable de cada página --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer global --}}
    @include('partials.footer')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Scripts globales --}}
    <script src="{{ asset('js/alerts.js') }}"></script>
    <script src="{{ asset('js/cart.js') }}"></script>

    {{-- Scripts específicos de cada página --}}
    @stack('scripts')

</body>
</html>