<!DOCTYPE html>
<html :class="{ 'dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'Zeora Diamonds' }}</title> <!-- keeps dynamic title -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

    <!-- AlpineJS -->
    {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script> --}}
    <script src="{{ asset('assets/js/init-alpine.js') }}"></script>

    <!-- Charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <script src="{{ asset('assets/js/charts-lines.js') }}" defer></script>
    <script src="{{ asset('assets/js/charts-pie.js') }}" defer></script>
</head>

<body
    class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-300 w-screen overflow-x-hidden">
    <div class="flex min-h-screen max-w-full overflow-hidden" :class="{ 'overflow-hidden': isSideMenuOpen }">

        @include('layouts.sidebar.main')

        <div class="flex flex-col flex-1 min-w-0">

            @include('layouts.navigation')

            <main class="flex-1 overflow-y-auto px-6 py-6 transition-colors duration-300">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
