<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
    <div class="p-3 mr-4 text-{{ $color }}-500 bg-{{ $color }}-100 rounded-full dark:text-{{ $color }}-100 dark:bg-{{ $color }}-500">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
            <path d="{{ $icon }}"></path>
        </svg>
    </div>
    <div>
        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">{{ $title }}</p>
        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $value }}</p>
        @if(!empty($meta))
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{!! $meta !!}</p>
        @endif
    </div>
</div>
