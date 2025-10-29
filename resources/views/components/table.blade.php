@props([
    'headers' => [],
    'rows' => [],
    'from' => null,
    'to' => null,
    'total' => null,
    'pages' => [],
    'current' => 1,
    'filters' => [],
    'searchPlaceholder' => 'Search...',
    'searchQuery' => request('search', ''),
    'selectedFilter' => request('filter', ''),
    'route' => null, // route for form submission
])

<div class="w-full overflow-hidden rounded-lg bg-white dark:bg-gray-800">
    <!-- Search & Filter Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between p-4 border-b dark:border-gray-700 space-y-3 md:space-y-0">
        <form method="GET" action="{{ $route ?? url()->current() }}" class="flex flex-col md:flex-row md:items-center gap-3 w-full">
            <div class="relative flex-grow">
                <input
                    type="text"
                    name="search"
                    value="{{ $searchQuery }}"
                    placeholder="{{ $searchPlaceholder }}"
                    class="w-full px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-purple-600 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200"
                />
                <x-primary-button type="submit" class="absolute right-3 top-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 7.5-7.5 7.508 7.508 0 0 1-7.5 7.5z"/>
                    </svg>
                    Search
                </x-primary-button>
            </div>

            @if ($filters)
                <select
                    name="filter"
                    onchange="this.form.submit()"
                    class="px-4 py-2 border rounded-lg text-sm dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200"
                >
                    <option value="">All</option>
                    @foreach ($filters as $key => $label)
                        <option value="{{ $key }}" {{ $selectedFilter == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            @endif
        </form>
    </div>

    <!-- Data Table -->
    <div class="w-full overflow-x-auto">
        <table class="w-full text-left whitespace-nowrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    @foreach ($headers as $header)
                        <th class="px-4 py-3">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>

            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                {{ $slot }}
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @include('components.pagination', [
        'from' => $from,
        'to' => $to,
        'total' => $total,
        'pages' => $pages,
        'current' => $current,
    ])
</div>
