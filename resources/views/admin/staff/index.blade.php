<x-app-layout>
    @slot('title', 'All Staff')


    <x-table :headers="['Code', 'Name', 'Phone No.', 'Address']" :from="$staff->firstItem()" :to="$staff->lastItem()" :total="$staff->total()" :pages="$staff->getUrlRange(1, $staff->lastPage())" :current="$staff->currentPage()"
        :route="route('admin.staff.index')" :filters="[]" searchPlaceholder="Search staff...">
        @forelse ($staff as $s)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40 transition duration-150">
                <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-100">{{ $s->code }}</td>
                <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-100">{{ $s->name }}</td>
                <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-100">{{ $s->phone_no }}</td>
                <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-100">{{ $s->address }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-4 py-3 text-center text-sm text-gray-500 dark:text-gray-400">
                    No staff records found.
                </td>
            </tr>
        @endforelse
    </x-table>
</x-app-layout>
