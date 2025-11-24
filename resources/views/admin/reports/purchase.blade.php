<x-app-layout>
    @slot('title', 'Diamond Certificates')

    @php
        // Pre-calculate totals
        $totalQty = $cards->sum('quantity');
        $totalGross = $cards->sum('gross_weight');
        $totalStone = $cards->sum('stone_weight');
        $totalDiamond = $cards->sum('diamond_weight');
        $totalNet = $cards->sum('net_weight');

        $totalNetAmt = $cards->sum('total_amount');
        $totalGST = $cards->sum(fn($c) => $c->total_amount * 0.03);
        $grandTotal = $totalNetAmt + $totalGST;
    @endphp

    <div class="bg-white px-6 py-2 shadow dark:bg-gray-800 rounded-lg">
        <div class="mx-auto text-gray-900 dark:text-gray-100">

            <x-table
                :headers="[
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
                    'Actions'
                ]"
                :collection="$cards"
                :filters="$suppliers"
                :route="route('admin.products.index')"
                :searchQuery="request('search', '')"
            >

                @foreach ($cards as $index => $card)
                    <tr class="text-gray-700 dark:text-gray-400">

                        {{-- SI No --}}
                        <td class="px-4 py-3 text-sm">{{ $cards->firstItem() + $index }}</td>

                        {{-- Date --}}
                        <td class="px-4 py-3 text-sm">
                            {{ optional($card->purchaseInvoice)->invoice_date }}
                        </td>

                        {{-- Rate (gold + diamond) --}}
                        <td class="px-4 py-3 text-sm">
                            {{ $card->gold_rate + $card->diamond_rate }}
                        </td>

                        {{-- Total --}}
                        <td class="px-4 py-3 text-sm">
                            {{ number_format($card->total_amount, 2) }}
                        </td>

                        {{-- Quantity --}}
                        <td class="px-4 py-3 text-sm">{{ $card->quantity }}</td>

                        {{-- Gross Weight --}}
                        <td class="px-4 py-3 text-sm">{{ $card->gross_weight }}</td>

                        {{-- Stone Weight --}}
                        <td class="px-4 py-3 text-sm">{{ $card->stone_weight }}</td>

                        {{-- Diamond Carat --}}
                        <td class="px-4 py-3 text-sm">{{ $card->diamond_weight }}</td>

                        {{-- Net Weight --}}
                        <td class="px-4 py-3 text-sm">{{ $card->net_weight }}</td>

                        {{-- Net Amount --}}
                        <td class="px-4 py-3 text-sm">{{ number_format($card->total_amount, 2) }}</td>

                        {{-- GST (3%) --}}
                        <td class="px-4 py-3 text-sm">
                            {{ number_format($card->total_amount * 0.03, 2) }}
                        </td>

                        {{-- Total With GST --}}
                        <td class="px-4 py-3 text-sm">
                            {{ number_format($card->total_amount * 1.03, 2) }}
                        </td>

                        {{-- Actions --}}
                        <td class="px-4 py-3 text-sm">
                            <div class="flex items-center space-x-3">

                                <a href="{{ route('admin.products.edit', $card->id) }}">
                                    <x-secondary-button type="button">Edit</x-secondary-button>
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

                {{-- Totals Row --}}
                <tr class="bg-gray-100 dark:bg-gray-700 font-semibold text-gray-900 dark:text-gray-100">
                    <td colspan="4" class="px-4 py-3 text-right">Totals:</td>

                    <td class="px-4 py-3">{{ $totalQty }}</td>
                    <td class="px-4 py-3">{{ $totalGross }}</td>
                    <td class="px-4 py-3">{{ $totalStone }}</td>
                    <td class="px-4 py-3">{{ $totalDiamond }}</td>
                    <td class="px-4 py-3">{{ $totalNet }}</td>

                    <td class="px-4 py-3">{{ number_format($totalNetAmt, 2) }}</td>
                    <td class="px-4 py-3">{{ number_format($totalGST, 2) }}</td>
                    <td class="px-4 py-3">{{ number_format($grandTotal, 2) }}</td>

                    <td></td>
                </tr>

            </x-table>

            <!-- Delete Modal -->
            <x-confirm-delete-modal
                action="#"
                title="Confirm Deletion"
                message="Are you sure you want to delete this certificate? This action cannot be undone."
            />

        </div>
    </div>

</x-app-layout>
