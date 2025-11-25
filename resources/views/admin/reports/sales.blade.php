<x-app-layout>
    @slot('title', 'Sales Report')

    @php
        $headers = [
            'SI. No.',
            'Date',
            'Invoice #',
            'Product Code',
            'Rate / Amount',
            'Qty',
            'Gross (g)',
            'Stone (g)',
            'Diamond (ct)',
            'Net (g)',
            'Net Amt',
            'GST Total',
            'Total',
        ];
    @endphp

    <x-table :headers="$headers"
        :collection="$invoices"
        :route="route('admin.reports.sales')"
        searchPlaceholder="Search invoice, product code">

        {{-- 🎯 FILTERS SLOT --}}
        <x-slot:filters>

            {{-- From Date --}}
            <x-date-input label="From" name="from" :value="request('from')" />

            {{-- To Date --}}
            <x-date-input label="To" name="to" :value="request('to')" />

            {{-- Merchant Dropdown --}}
            <x-searchable-dropdown name="merchant_id"
                api="/admin/api/dropdown/merchants"
                label="Merchant"
                placeholder="Select merchant"
                optionLabel="name"
                optionValue="id"
                autoSubmit="true" />

            {{-- Apply Button --}}
            <div>
                <label class="block text-sm text-transparent">.</label>
                <button type="submit"
                    class="rounded-lg px-4 py-2 bg-purple-600 text-white hover:bg-purple-700 focus:ring">
                    Apply
                </button>
            </div>

            {{-- Totals --}}
            {{-- <div class="ml-auto text-right">
                <div class="text-sm text-gray-500 dark:text-gray-300">
                    Total invoices:
                    <strong>{{ $totals->count ?? 0 }}</strong>
                </div>
                <div class="text-sm text-gray-500 dark:text-gray-300">
                    Total amount:
                    <strong>₹{{ number_format($totals->amount_sum ?? 0, 2) }}</strong>
                </div>
            </div> --}}

        </x-slot:filters>

        {{-- TABLE ROWS --}}
        @foreach ($invoices as $index => $invoice)
            <tr class="text-sm dark:text-gray-200">

                {{-- SI No --}}
                <td class="px-4 py-3">{{ $invoices->firstItem() + $index }}</td>

                {{-- Date --}}
                <td class="px-4 py-3">{{ $invoice->sale_date?->format('Y-m-d') }}</td>

                {{-- Invoice No --}}
                <td class="px-4 py-3">{{ $invoice->invoice_no }}</td>

                {{-- Product Code --}}
                <td class="px-4 py-3">{{ $invoice->product_code }}</td>

                {{-- Rate / Amount --}}
                <td class="px-4 py-3">₹{{ number_format($invoice->amount, 2) }}</td>

                {{-- Qty --}}
                <td class="px-4 py-3">{{ $invoice->card->quantity ?? 1 }}</td>

                {{-- Weights --}}
                <td class="px-4 py-3">{{ $invoice->card->gross_weight ?? '-' }}</td>
                <td class="px-4 py-3">{{ $invoice->card->stone_weight ?? '-' }}</td>
                <td class="px-4 py-3">{{ $invoice->card->diamond_weight ?? '-' }}</td>
                <td class="px-4 py-3">{{ $invoice->card->net_weight ?? '-' }}</td>

                {{-- Net Amount --}}
                <td class="px-4 py-3">₹{{ number_format($invoice->amount, 2) }}</td>

                {{-- GST --}}
                <td class="px-4 py-3">-</td>

                {{-- Total With GST --}}
                <td class="px-4 py-3">₹{{ number_format($invoice->amount, 2) }}</td>

            </tr>
        @endforeach

    </x-table>

</x-app-layout>
