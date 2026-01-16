<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard | Bandipur Hotel</title>
    <link rel="icon" type="image/png" href="{{ asset('frontendimages/logo.png') }}" />


    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    
    {{-- <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}"> --}}

    

    {{-- <script src="{{ asset('css/admin/admin.js') }}" defer></script> --}}

    @vite(['public/css/admin/app.css', 'public/css/admin/app.js'])


</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="flex h-screen overflow-hidden">

        @include('admin.layouts.sidebar')

        <div class="flex-1 flex flex-col relative overflow-hidden">

            @include('admin.layouts.navbar')

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @yield('content')
            </main>
        </div>
    </div>
@stack('scripts')
</body>

</html>