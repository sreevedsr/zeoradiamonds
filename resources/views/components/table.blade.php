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
    'route' => null,
])

<div class="w-full overflow-hidden rounded-lg bg-white dark:bg-gray-800">
    <!-- Search & Filter Bar -->
    <div
        class="flex flex-col md:flex-row md:items-center justify-between border-b dark:border-gray-700 space-y-3 md:space-y-0">
        <form method="GET" action="{{ $route ?? url()->current() }}"
            class="flex flex-col md:flex-row md:items-center gap-3 w-full">

            <!-- Search box -->
            <div
                class="flex flex-col md:flex-row md:items-center justify-between p-4 dark:border-gray-700 space-y-3 md:space-y-0">
                <div class="relative flex-grow">
                    <input id="search-input" type="text" placeholder="{{ $searchPlaceholder }}"
                        value="{{ $searchQuery }}"
                        class="w-full px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-purple-600 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200" />
                    <button type="button"
                        class="absolute right-2 top-1/2 -translate-y-1/2 p-2 text-gray-500 hover:text-purple-700 dark:text-gray-300 dark:hover:text-purple-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor"
                            stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 7.5-7.5 7.508 7.508 0 0 1-7.5 7.5z" />
                        </svg>
                    </button>
                </div>
            </div>


            <!-- Filter dropdown (optional) -->
            @if ($filters)
                <select name="filter" onchange="this.form.submit()"
                    class="px-4 py-2 border rounded-lg text-sm dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
                    <option value="">All</option>
                    @foreach ($filters as $key => $label)
                        <option value="{{ $key }}" {{ $selectedFilter == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            @endif
        </form>
    </div>

    <!-- Data Table -->
    <div class="w-full overflow-x-auto">
        <table class="w-full text-left whitespace-nowrap">
            <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
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
<script>
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('search-input');
    const tableBody = document.querySelector('tbody');
    let timer;

    searchInput.addEventListener('input', function () {
        clearTimeout(timer);
        timer = setTimeout(() => {
            const query = this.value.trim();
            const url = "{{ $route ?? url()->current() }}" + "?search=" + encodeURIComponent(query);

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.text())
            .then(html => {
                // Parse the new table body only from response
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newBody = doc.querySelector('tbody');
                if (newBody) tableBody.innerHTML = newBody.innerHTML;
            })
            .catch(err => console.error('Live search error:', err));
        }, 300); // delay 300ms for smoother typing
    });
});
</script>

