@props([
    'headers' => [],
    'collection' => null,
    'searchPlaceholder' => 'Search...',
    'searchQuery' => request('search', ''),
    'route' => null,
])

<div class="w-full overflow-hidden rounded-t-lg rounded-b-none bg-white dark:bg-gray-800">

    <form method="GET" action="{{ $route ?? url()->current() }}"
        class="flex flex-col space-y-3 border-b dark:border-gray-700 md:flex-row md:items-end md:justify-start md:space-y-0 p-4 gap-6"
        x-data="{
            query: '{{ $searchQuery }}',
            timeout: null,
            search() {
                clearTimeout(this.timeout);
                this.timeout = setTimeout(() => {
                    $refs.searchInput.value = this.query;
                    this.$root.submit();
                }, 300);
            }
        }">


        <!-- 🔍 Search -->
        <div class="relative min-w-64">
            <input x-model="query" @input="search" type="text" name="search" placeholder="{{ $searchPlaceholder }}"
                class="w-full rounded-lg border px-4 py-2 text-sm focus:ring-2 focus:ring-purple-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200" />

            <button type="button"
                class="absolute right-2 top-1/2 -translate-y-1/2 p-2 text-gray-500 dark:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor"
                    stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 7.5-7.5 7.508 7.508 0 0 1-7.5 7.5z" />
                </svg>
            </button>
        </div>

        <!-- ⭐ FILTERS SLOT -->
        <div class="flex flex-wrap gap-3 items-end">
            {{ $filters ?? '' }}
        </div>

    </form>

    <!-- 📊 DATA TABLE -->
    <div class="relative rounded-lg ">
        <div class="max-h-[68vh] overflow-auto custom-scrollbar">
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
    </div>

    <!-- 📄 PAGINATION -->
    <div class="p-4">
        @if ($collection instanceof \Illuminate\Pagination\LengthAwarePaginator)
            {{ $collection->withQueryString()->links() }}
        @endif
    </div>

</div>
