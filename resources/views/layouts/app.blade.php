<!DOCTYPE html>
<html :class="{ 'dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Zeora Diamonds' }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">


    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

    <!-- AlpineJS -->
    <script src="{{ asset('assets/js/init-alpine.js') }}"></script>
</head>

<body
    class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-300 w-screen overflow-x-hidden">

    <div class="flex min-h-screen w-full">

        <!-- Fixed Sidebar -->
        @include('layouts.sidebar.main')

        <!-- Main Content -->
        <div class="flex flex-col flex-1 min-w-0 transition-all duration-300 ease-in-out"
            :class="isSidebarCollapsed ? 'md:ml-20' : 'md:ml-64'">
            @include('layouts.navigation')

            <main class="flex-1 overflow-y-auto px-6 pt-4 transition-colors duration-300">
                {{ $slot }}
            </main>
        </div>
    </div>
    <!-- Global Toast Messages -->
    @if (session('success'))
        <x-alert-toast type="success" :message="session('success')" />
    @endif

    @if ($errors->any())
        <x-alert-toast type="error" :message="$errors->first()" />
    @endif

</body>

</html>
