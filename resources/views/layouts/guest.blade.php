@props(['title' => 'Zeora Diamonds'])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }}</title>
    <script>
        (function() {
            const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
            const stored = localStorage.getItem("theme");
            const shouldUseDark = stored ? stored === "dark" : prefersDark;
            if (shouldUseDark) {
                document.documentElement.classList.add("dark");
            } else {
                document.documentElement.classList.remove("dark");
            }
        })();
    </script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">


    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

</head>

<body x-data="data()">
    {{ $slot }}
</body>

</html>
