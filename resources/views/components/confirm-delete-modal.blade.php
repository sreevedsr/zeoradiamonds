<x-modal name="confirm-delete-modal" focusable>
    <div class="p-6">
        <form method="POST" action="{{ $action }}" id="deleteForm">
            @csrf
            @method('DELETE')
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __($title) }}
            </h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                {{ __($message) }}
            </p>
            <div class="mt-6 flex justify-end space-x-3">
                <x-secondary-button type="button" x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>
                <x-danger-button>
                    {{ __('Yes, Delete') }}
                </x-danger-button>
            </div>
        </form>
    </div>
</x-modal>
