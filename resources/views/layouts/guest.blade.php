@props(['title' => 'Zeeyame'])

<!DOCTYPE html>
<html :class="{ 'dark': dark }" x-data="data()" lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ $title }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
            rel="stylesheet" />

        <!-- Vite Assets -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

        <!-- Alpine.js -->
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        <script src="{{ asset('assets/js/init-alpine.js') }}"></script>
    </head>

    <body>
        {{ $slot }}
    </body>

</html>
