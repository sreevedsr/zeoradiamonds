@props([
    'headers' => [],
    'collection' => null,
    'searchPlaceholder' => 'Search...',
    'searchQuery' => request('search', ''),
    'route' => null,
])

<div class="w-full overflow-hidden rounded-lg bg-white dark:bg-gray-800 p-4 md:p-7 md:pb-4">

    <form method="GET" action="{{ $route ?? url()->current() }}"
        class="flex flex-col space-y-3 border-b dark:border-gray-700 md:flex-row md:items-end md:justify-start md:space-y-0 md:gap-6 pb-4"
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


        <div class="grid grid-cols-1 md:grid-cols-[280px_1fr] lg:grid-cols-3 gap-4">

            <!-- 🔍 Search -->
            <div class="md:col-span-1 lg:col-span-1">
                <label for="search-input" class="block text-sm text-gray-600 dark:text-gray-300 mb-1">
                    Search
                </label>

                <div class="flex items-center border rounded-lg px-3 dark:border-gray-700 dark:bg-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-300"
                        fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 7.5-7.5 7.508 7.508 0 0 1-7.5 7.5z" />
                    </svg>

                    <input x-model="query" @input="search" type="text" name="search"
                        placeholder="{{ $searchPlaceholder }}"
                        class="w-full bg-transparent pl-3 py-2 focus:ring-0 border-none focus:outline-none
                   dark:text-gray-200" />
                </div>
            </div>

            <!-- ⭐ Filters -->
            <div class="md:col-span-1 lg:col-span-2 flex flex-wrap gap-3 items-end">
                {{ $filters ?? '' }}
            </div>

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

    @if ($collection instanceof \Illuminate\Pagination\LengthAwarePaginator)
        {{ $collection->withQueryString()->links('components.pagination') }}
    @endif

</div>
