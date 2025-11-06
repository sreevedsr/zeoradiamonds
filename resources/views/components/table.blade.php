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
    <div x-data="{
        query: '{{ $searchQuery }}',
        results: [],
        timeout: null,
        async search() {
            clearTimeout(this.timeout);
            this.timeout = setTimeout(async () => {
                const response = await fetch('{{ $route ?? url()->current() }}?search=' + encodeURIComponent(this.query));
                const html = await response.text();

                // Extract the table or main content (optional customization)
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newTable = doc.querySelector('#data-table'); // use your actual table wrapper ID

                if (newTable) {
                    document.querySelector('#data-table').innerHTML = newTable.innerHTML;
                }
            }, 300); // debounce 300ms
        }
    }"
        class="flex flex-col justify-between space-y-3 border-b dark:border-gray-700 md:flex-row md:items-center md:space-y-0">

        <div class="flex w-full flex-col gap-3 md:flex-row md:items-center">
            <!-- Search box -->
            <div
                class="flex flex-col justify-between space-y-3 p-4 dark:border-gray-700 md:flex-row md:items-center md:space-y-0">
                <div class="relative flex-grow">
                    <input id="search-input" x-model="query" @input="search" type="text"
                        placeholder="{{ $searchPlaceholder }}"
                        class="w-full rounded-lg border px-4 py-2 text-sm focus:ring-2 focus:ring-purple-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200" />
                    <button type="button"
                        class="absolute right-2 top-1/2 -translate-y-1/2 p-2 text-gray-500 hover:text-purple-700 dark:text-gray-300 dark:hover:text-purple-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor"
                            stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 7.5-7.5 7.508 7.508 0 0 1-7.5 7.5z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Filter dropdown (optional) -->
            @if ($filters)
                <select name="filter"
                    onchange="window.location='{{ $route ?? url()->current() }}?filter=' + this.value"
                    class="rounded-lg border px-4 py-2 text-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200">
                    <option value="">All</option>
                    @foreach ($filters as $key => $label)
                        <option value="{{ $key }}" {{ $selectedFilter == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            @endif
        </div>
    </div>

    <!-- Data Table -->
    <div id="data-table" class="relative max-h-[70vh] overflow-auto rounded-lg custom-scrollbar">
        <table class="min-w-full whitespace-nowrap text-left border-collapse">
            <thead class="sticky top-0 z-10 bg-gray-50 dark:bg-gray-800">
                <tr
                    class="border-b text-xs font-semibold uppercase tracking-wide text-gray-500 dark:border-gray-700 dark:text-gray-400">
                    @foreach ($headers as $header)
                        <th class="px-4 py-3">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>

            <tbody class="divide-y bg-white dark:divide-gray-700 dark:bg-gray-800">
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

        searchInput.addEventListener('input', function() {
            clearTimeout(timer);
            timer = setTimeout(() => {
                const query = this.value.trim();
                const url = "{{ $route ?? url()->current() }}" + "?search=" +
                    encodeURIComponent(query);

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
