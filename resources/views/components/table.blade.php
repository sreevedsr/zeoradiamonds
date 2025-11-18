@props([
    'headers' => [],
    'collection' => null, // Laravel paginator instance
    'filters' => [],
    'searchPlaceholder' => 'Search...',
    'searchQuery' => request('search', ''),
    'selectedFilter' => request('filter', ''),
    'route' => null,
])

<div class="w-full overflow-hidden rounded-t-lg rounded-b-none bg-white dark:bg-gray-800">
    <div x-data="{
        query: '{{ $searchQuery }}',
        timeout: null,
        async search() {
            clearTimeout(this.timeout);
            this.timeout = setTimeout(async () => {
                const url = '{{ $route ?? url()->current() }}?search=' + encodeURIComponent(this.query);
                const response = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                const html = await response.text();

                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newTable = doc.querySelector('#data-table');
                if (newTable) document.querySelector('#data-table').innerHTML = newTable.innerHTML;
            }, 300);
        }
    }"
        class="flex flex-col justify-between space-y-3 border-b dark:border-gray-700 md:flex-row md:items-center md:space-y-0">
        <div class="flex w-full flex-col gap-3 md:flex-row md:items-center p-4">
            <!-- Search box -->
            <div class="relative">
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

            <!-- Filter dropdown -->
            @if (!empty($filters))
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

    <!-- 🧾 Data Table -->
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

    <!-- 📄 Pagination -->
    @if ($collection instanceof \Illuminate\Pagination\LengthAwarePaginator)
        @include('components.pagination', [
            'from' => $collection->firstItem(),
            'to' => $collection->lastItem(),
            'total' => $collection->total(),
            'pages' => range(1, $collection->lastPage()),
            'current' => $collection->currentPage(),
            'nextPageUrl' => $collection->nextPageUrl(),
            'prevPageUrl' => $collection->previousPageUrl(),
            'route' => $route,
        ])
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('search-input');
        const tableBody = document.querySelector('#data-table tbody');
        let timer;

        searchInput?.addEventListener('input', function() {
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
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newBody = doc.querySelector('#data-table tbody');
                        if (newBody) tableBody.innerHTML = newBody.innerHTML;
                    })
                    .catch(err => console.error('Live search error:', err));
            }, 300);
        });
    });
</script>
