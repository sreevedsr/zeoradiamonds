<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Models\Card;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AdminSalesInvoice;
use App\Http\Controllers\Controller;

class SalesReportController extends Controller
{
    public function index(Request $request)
    {
        // Validate incoming filters
        $request->validate([
            'from'         => 'nullable|date',
            'to'           => 'nullable|date',
            'merchant_id'  => 'nullable|integer|exists:users,id',
            'search'       => 'nullable|string',
        ]);

        $from       = $request->input('from');
        $to         = $request->input('to');
        $merchantId = $request->input('merchant_id');
        $search     = $request->input('search');

        // MAIN PAGINATED QUERY
        $query = AdminSalesInvoice::with(['card', 'merchant'])
            ->orderBy('sale_date', 'desc')
            ->when($from, fn($q) => $q->whereDate('sale_date', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('sale_date', '<=', $to))
            ->when($merchantId, fn($q) => $q->where('merchant_id', $merchantId))
            ->when($search, function ($q) use ($search) {
                $q->where(function ($inner) use ($search) {
                    $inner->where('product_code', 'like', "%{$search}%")
                        ->orWhere('invoice_no', 'like', "%{$search}%")
                        ->orWhere('notes', 'like', "%{$search}%");
                });
            });

        $invoices = $query->paginate(25)->withQueryString();


        // TOTALS (same filters, but no pagination)
        $totals = AdminSalesInvoice::query()
            ->when($from, fn($q) => $q->whereDate('sale_date', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('sale_date', '<=', $to))
            ->when($merchantId, fn($q) => $q->where('merchant_id', $merchantId))
            ->selectRaw('COUNT(*) as count, SUM(amount) as amount_sum')
            ->first();


        // CARD WEIGHT TOTALS
        $cardTotals = Card::query()
            ->join('admin_sales_invoices', 'cards.product_code', '=', 'admin_sales_invoices.product_code')
            ->when($from, fn($q) => $q->whereDate('admin_sales_invoices.sale_date', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('admin_sales_invoices.sale_date', '<=', $to))
            ->when($merchantId, fn($q) => $q->where('admin_sales_invoices.merchant_id', $merchantId))
            ->selectRaw('
                SUM(COALESCE(cards.gross_weight,0))   as gross_wt,
                SUM(COALESCE(cards.stone_weight,0))   as stone_wt,
                SUM(COALESCE(cards.diamond_weight,0)) as diamond_wt,
                SUM(COALESCE(cards.net_weight,0))     as net_wt
            ')
            ->first();


        // Dropdown merchant list
        $merchants = User::whereIn('role', ['merchant', 'admin'])
            ->orderBy('name')
            ->get(['id','name']);

        return view('admin.reports.sales', compact(
            'invoices',
            'totals',
            'cardTotals',
            'merchants'
        ));
    }
}
