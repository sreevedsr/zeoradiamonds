@props(['paginator'])

@if ($paginator->hasPages())
    <div
        class="py-3 text-xs font-semibold tracking-wide text-gray-600 uppercase
           dark:text-gray-300 select-none">

        <div class="grid grid-cols-1 sm:grid-cols-3 items-center sm:gap-0 gap-3">

            {{-- Showing X–Y of Z — hidden on mobile --}}
            <span class="flex items-center sm:block hidden">
                Showing {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} of {{ $paginator->total() }}
            </span>

            {{-- Empty center column (desktop only) --}}
            <span class="hidden sm:block"></span>

            {{-- Pagination --}}
            <div class="flex justify-center sm:justify-end w-full">
                <nav aria-label="Pagination">
                    <ul class="flex items-center gap-1">

                        {{-- Prev Arrow --}}
                        @if ($paginator->previousPageUrl())
                            <li>
                                <a href="{{ $paginator->previousPageUrl() }}"
                                    class="flex items-center justify-center w-9 h-9 rounded-xl
                                       bg-gray-200 dark:bg-gray-700
                                       hover:bg-gray-300 dark:hover:bg-gray-600
                                       transition-all">
                                    <svg class="w-4 h-4 text-gray-700 dark:text-gray-200" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" />
                                    </svg>
                                </a>
                            </li>
                        @endif


                        {{-- Page logic --}}
                        @php
                            $current = $paginator->currentPage();
                            $last = $paginator->lastPage();
                            $range = 1; // smaller range for mobile, still works on desktop
                            $pages = [];

                            $pages[] = 1;
                            for ($i = $current - $range; $i <= $current + $range; $i++) {
                                if ($i > 1 && $i < $last) {
                                    $pages[] = $i;
                                }
                            }
                            if ($last > 1) {
                                $pages[] = $last;
                            }

                            $pages = array_unique($pages);
                            sort($pages);
                        @endphp

                        @php $prev = null; @endphp

                        @foreach ($pages as $page)
                            @if ($prev && $page > $prev + 1)
                                <li><span class="px-2 text-gray-400 dark:text-gray-500">…</span></li>
                            @endif

                            <li>
                                <a href="{{ $paginator->url($page) }}"
                                    class="px-3 py-1.5 rounded-xl text-sm transition-all
                                       {{ $page == $current
                                           ? 'bg-purple-600 text-white hover:bg-purple-700 shadow-sm'
                                           : 'bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600' }}
                                       sm:px-3
                                       px-2 text-xs">
                                    {{-- smaller on mobile --}}
                                    {{ $page }}
                                </a>
                            </li>

                            @php $prev = $page; @endphp
                        @endforeach


                        {{-- Next Arrow --}}
                        @if ($paginator->nextPageUrl())
                            <li>
                                <a href="{{ $paginator->nextPageUrl() }}"
                                    class="flex items-center justify-center w-9 h-9 rounded-xl
                                       bg-gray-200 dark:bg-gray-700
                                       hover:bg-gray-300 dark:hover:bg-gray-600
                                       transition-all">
                                    <svg class="w-4 h-4 text-gray-700 dark:text-gray-200" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" />
                                    </svg>
                                </a>
                            </li>
                        @endif

                    </ul>
                </nav>
            </div>

        </div>
    </div>
@endif
