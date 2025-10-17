<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'Zeeyame' }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output.css') }}" />

    <!-- AlpineJS for interactivity -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{ asset('assets/js/init-alpine.js') }}"></script>

    <!-- Charts (optional) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <script src="{{ asset('assets/js/charts-lines.js') }}" defer></script>
    <script src="{{ asset('assets/js/charts-pie.js') }}" defer></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-300">
    <div class="flex h-screen" :class="{ 'overflow-hidden': isSideMenuOpen }">

        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main content area -->
        <div class="flex flex-col flex-1 w-full">

            <!-- Navigation / Top bar -->
            @include('layouts.navigation')

            <!-- Slot content with padding -->
            <main class="flex-1 overflow-y-auto px-6 transition-colors duration-300">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Optional: Modals -->
    @stack('modals')
</body>

</html>
