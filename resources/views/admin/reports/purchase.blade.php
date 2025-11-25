<x-app-layout>
    @slot('title', 'Purchase Report')

    @php
        $headers = [
            'SI. No.',
            'Date',
            'Rate',
            'Total',
            'Qty',
            'Gross Wgt',
            'Stone Wgt',
            'Diamond Carat',
            'Net Wgt',
            'Net Amt',
            'GST',
            'Total (With GST)',
            'Actions',
        ];
    @endphp

    <x-table :headers="$headers" :collection="$cards" :route="route('admin.reports.purchase')" searchPlaceholder="Search certificate ID, item name">

        {{-- 🎯 FILTERS SLOT --}}
        <x-slot:filters>

            <x-date-input label="From" name="from" :value="request('from')" />

            <x-date-input label="To" name="to" :value="request('to')" />


            {{-- Supplier Dropdown --}}
            <x-searchable-dropdown name="supplier_id" api="/admin/api/dropdown/suppliers" label="Supplier"
                placeholder="Select supplier" optionLabel="name" optionValue="id" autoSubmit="true" />

            {{-- Apply Button --}}
            <div>
                <label class="block text-sm text-transparent">.</label>
                <button type="submit"
                    class="rounded-lg px-4 py-2 bg-purple-600 text-white hover:bg-purple-700 focus:ring">
                    Apply
                </button>
            </div>

        </x-slot:filters>

        {{-- TABLE ROWS --}}
        @foreach ($cards as $index => $card)
            <tr class="text-sm dark:text-gray-200">

                {{-- SI No --}}
                <td class="px-4 py-3">{{ $cards->firstItem() + $index }}</td>

                {{-- Date --}}
                <td class="px-4 py-3">{{ optional($card->purchaseInvoice)->invoice_date }}</td>

                {{-- Rate --}}
                <td class="px-4 py-3">{{ $card->gold_rate + $card->diamond_rate }}</td>

                {{-- Total --}}
                <td class="px-4 py-3">{{ number_format($card->total_amount, 2) }}</td>

                {{-- Quantity --}}
                <td class="px-4 py-3">{{ $card->quantity }}</td>

                {{-- Weights --}}
                <td class="px-4 py-3">{{ $card->gross_weight }}</td>
                <td class="px-4 py-3">{{ $card->stone_weight }}</td>
                <td class="px-4 py-3">{{ $card->diamond_weight }}</td>
                <td class="px-4 py-3">{{ $card->net_weight }}</td>

                {{-- Net Amount --}}
                <td class="px-4 py-3">{{ number_format($card->total_amount, 2) }}</td>

                {{-- GST --}}
                <td class="px-4 py-3">{{ number_format($card->total_amount * 0.03, 2) }}</td>

                {{-- Total With GST --}}
                <td class="px-4 py-3">{{ number_format($card->total_amount * 1.03, 2) }}</td>

                {{-- Actions --}}
                <td class="px-4 py-3">
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.products.edit', $card->id) }}">
                            <x-secondary-button>Edit</x-secondary-button>
                        </a>

                        <x-danger-button type="button" x-data
                            x-on:click.prevent="
                                $dispatch('open-modal', 'confirm-delete-modal');
                                document.getElementById('deleteMerchantForm').action =
                                    '{{ route('admin.products.destroy', $card->id) }}';
                            ">
                            Delete
                        </x-danger-button>
                    </div>
                </td>

            </tr>
        @endforeach

    </x-table>

</x-app-layout>
