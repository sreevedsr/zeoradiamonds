<x-app-layout>
    @slot('title', 'Zeeyame-Dashboard')

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Dashboard
    </h2>

    <!-- Cards -->
    {{-- <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
        @include('dashboard.partials.card', ['title' => 'Total clients', 'value' => 6389, 'color' => 'orange','icon' => 'M10 2a8 8 0 100 16 8 8 0 000-16z'])
        @include('dashboard.partials.card', ['title' => 'Account balance', 'value' => '$46,760.89', 'color' => 'green','icon' => 'M10 2a8 8 0 100 16 8 8 0 000-16z'])
        @include('dashboard.partials.card', ['title' => 'New sales', 'value' => 376, 'color' => 'blue','icon' => 'M10 2a8 8 0 100 16 8 8 0 000-16z'])
        @include('dashboard.partials.card', ['title' => 'Pending contacts', 'value' => 35, 'color' => 'teal','icon' => 'M10 2a8 8 0 100 16 8 8 0 000-16z'])
    </div>

    <!-- Table -->
    @include('dashboard.partials.table', ['clients' => $clients ?? []])

    <!-- Charts -->
    @include('dashboard.partials.charts') --}}
</x-app-layout>
