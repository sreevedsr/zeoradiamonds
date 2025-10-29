@props(['disabled' => false])

<input @disabled($disabled)
    {{ $attributes->merge([
        'class' => 'w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600
                                       dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-600',
    ]) }}>
