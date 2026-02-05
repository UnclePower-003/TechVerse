<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>Document</title> --}}
    <link rel="icon" type="image/png" href="{{ asset('imagess/logo.svg') }}" />

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Tailwind CSS (CDN for demonstration) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/app.css', 'resources/js/app.js')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    @stack('styles')
    @stack('style')


</head>

<body>
    @include('frontend.components.navbar')
    <main class="pt-20 z-0 relative bg-[#d1e2f6]">
        @yield('content')
    </main>
    @include('frontend.components.footers')


    <script src="{{ asset('js/navbar.js') }}"></script>
    @stack('scripts')
    @stack('script')
</body>

</html>
