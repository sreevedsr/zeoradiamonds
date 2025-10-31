@if (session()->has('success') || session()->has('error') || session()->has('info') || session()->has('warning'))
    <div class="fixed top-4 right-4 z-50 w-80">
        @foreach (['success', 'error', 'info', 'warning'] as $msg)
            @if (session($msg))
                <div

                    class="
                        mb-3 px-4 py-3 rounded-lg shadow-lg border
                        transition-colors duration-300
                        @if($msg === 'success') bg-green-100 text-green-800 border-green-300 dark:bg-green-900dark:border-green-700
                        @elseif($msg === 'error') bg-red-100 text-red-800 border-red-300 dark:bg-red-900 dark:text-red-100 dark:border-red-700
                        @elseif($msg === 'info') bg-blue-100 text-blue-800 border-blue-300 dark:bg-blue-900 dark:text-blue-100 dark:border-blue-700
                        @elseif($msg === 'warning') bg-yellow-100 text-yellow-800 border-yellow-300 dark:bg-yellow-900 dark:text-yellow-100 dark:border-yellow-700
                        @endif
                    "
                >
                    <strong class="capitalize">{{ $msg }}:</strong> {{ session($msg) }}
                </div>
            @endif
        @endforeach
    </div>
@endif
