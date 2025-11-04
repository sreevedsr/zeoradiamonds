<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="text-center">
        <h1 class="text-6xl font-bold text-red-600 mb-4">403</h1>
        <p class="text-xl text-gray-700 dark:text-gray-300 mb-6">You don’t have permission to access this page.</p>
        <a href="{{ url()->previous() }}" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Go Back</a>
    </div>
</body>
</html>
