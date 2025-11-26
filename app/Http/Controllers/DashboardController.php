<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $isAdmin = $user->role === 'admin';
        $merchantId = $isAdmin ? null : $user->id;

        $cacheKey = 'dashboard_v_combined_' . ($isAdmin ? 'admin' : 'merchant_' . $merchantId);

        $metrics = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($isAdmin, $merchantId) {

            // --- Months (last 6 months labels)
            $months = collect();
            for ($i = 5; $i >= 0; $i--) {
                $dt = Carbon::now()->subMonths($i);
                $months->push($dt->format('M Y'));
            }

            $startThis = Carbon::now()->startOfMonth();
            $endThis = Carbon::now()->endOfMonth();
            $startLast = Carbon::now()->subMonth()->startOfMonth();
            $endLast = Carbon::now()->subMonth()->endOfMonth();

            // -----------------------------
            // ADMIN SALES (admin_sales_invoices) - for admin overview
            // -----------------------------
            $adminSalesQuery = DB::table('admin_sales_invoices')
                ->selectRaw('DATE_FORMAT(created_at, "%b %Y") as month, SUM(amount) as total, COUNT(*) as orders')
                ->groupBy('month')
                ->orderByRaw('MIN(created_at)');

            if (!$isAdmin) {
                // if merchants are viewing dashboard but admin_sales_invoices has merchant_id, scope it
                $adminSalesQuery->where('merchant_id', $merchantId);
            }

            $adminSalesMonthly = $adminSalesQuery->get()->keyBy('month');

            $totalAdminSales = DB::table('admin_sales_invoices')
                ->when(!$isAdmin, fn($q) => $q->where('merchant_id', $merchantId))
                ->sum('amount');

            // -----------------------------
            // PURCHASES / STOCK (cards JOIN purchase_invoices)
            // We must sum cards.total_amount grouped by purchase_invoices.invoice_date
            // -----------------------------
            $purchaseMonthlyQuery = DB::table('cards')
                ->join('purchase_invoices', 'purchase_invoices.id', '=', 'cards.purchase_invoice_id')
                ->selectRaw('DATE_FORMAT(purchase_invoices.invoice_date, "%b %Y") as month, SUM(cards.total_amount) as total, COUNT(cards.id) as items')
                ->groupBy('month')
                ->orderByRaw('MIN(purchase_invoices.invoice_date)');

            if (!$isAdmin) {
                $purchaseMonthlyQuery->where('purchase_invoices.merchant_id', $merchantId);
            }

            $purchaseMonthly = $purchaseMonthlyQuery->get()->keyBy('month');

            $totalPurchases = DB::table('cards')
                ->join('purchase_invoices', 'purchase_invoices.id', '=', 'cards.purchase_invoice_id')
                ->when(!$isAdmin, fn($q) => $q->where('purchase_invoices.merchant_id', $merchantId))
                ->sum('cards.total_amount');

            // -----------------------------
            // MERCHANT SALES (cards) - per merchant/customer granularity
            // -----------------------------
            $cardsMonthlyQuery = Card::query()
                ->join('purchase_invoices', 'purchase_invoices.id', '=', 'cards.purchase_invoice_id')
                ->selectRaw('DATE_FORMAT(purchase_invoices.invoice_date, "%b %Y") as month, SUM(cards.total_amount) as total, COUNT(cards.id) as orders')
                ->groupBy('month')
                ->orderByRaw('MIN(purchase_invoices.invoice_date)');

            if (!$isAdmin) {
                $cardsMonthlyQuery->where('cards.merchant_id', $merchantId);
            }

            $cardsMonthly = $cardsMonthlyQuery->get()->keyBy('month');

            $totalCardsSales = Card::query()
                ->join('purchase_invoices', 'purchase_invoices.id', '=', 'cards.purchase_invoice_id')
                ->when(!$isAdmin, fn($q) => $q->where('cards.merchant_id', $merchantId))
                ->sum('cards.total_amount');

            // -----------------------------
            // Build series for chart (last 6 months)
            // -----------------------------
            $salesSeries = [];
            $purchaseSeries = [];

            foreach ($months as $m) {
                // sales: admin for admin view, cards for merchant view
                $salesSeries[] = (float) ($isAdmin ? ($adminSalesMonthly[$m]->total ?? 0) : ($cardsMonthly[$m]->total ?? 0));
                // purchases: from purchaseMonthly (cards joined with purchase_invoices)
                $purchaseSeries[] = (float) ($purchaseMonthly[$m]->total ?? 0);
            }

            // -----------------------------
            // KPIs: this month / last month (sales and purchases)
            // -----------------------------
            if ($isAdmin) {
                $salesThisMonth = DB::table('admin_sales_invoices')
                    ->when(!$isAdmin, fn($q) => $q->where('merchant_id', $merchantId))
                    ->whereBetween('created_at', [$startThis, $endThis])
                    ->sum('amount');

                $salesLastMonth = DB::table('admin_sales_invoices')
                    ->when(!$isAdmin, fn($q) => $q->where('merchant_id', $merchantId))
                    ->whereBetween('created_at', [$startLast, $endLast])
                    ->sum('amount');
            } else {
                $salesThisMonth = DB::table('cards')
                    ->join('purchase_invoices', 'purchase_invoices.id', '=', 'cards.purchase_invoice_id')
                    ->where('cards.merchant_id', $merchantId)
                    ->whereBetween('purchase_invoices.invoice_date', [$startThis, $endThis])
                    ->sum('cards.total_amount');

                $salesLastMonth = DB::table('cards')
                    ->join('purchase_invoices', 'purchase_invoices.id', '=', 'cards.purchase_invoice_id')
                    ->where('cards.merchant_id', $merchantId)
                    ->whereBetween('purchase_invoices.invoice_date', [$startLast, $endLast])
                    ->sum('cards.total_amount');
            }

            $purchasesThisMonth = DB::table('cards')
                ->join('purchase_invoices', 'purchase_invoices.id', '=', 'cards.purchase_invoice_id')
                ->when(!$isAdmin, fn($q) => $q->where('purchase_invoices.merchant_id', $merchantId))
                ->whereBetween('purchase_invoices.invoice_date', [$startThis, $endThis])
                ->sum('cards.total_amount');

            $purchasesLastMonth = DB::table('cards')
                ->join('purchase_invoices', 'purchase_invoices.id', '=', 'cards.purchase_invoice_id')
                ->when(!$isAdmin, fn($q) => $q->where('purchase_invoices.merchant_id', $merchantId))
                ->whereBetween('purchase_invoices.invoice_date', [$startLast, $endLast])
                ->sum('cards.total_amount');

            // -----------------------------
            // Diffs & Profit
            // -----------------------------
            $salesDiff = $salesThisMonth - $salesLastMonth;
            $salesDiffPercent = $salesLastMonth > 0 ? round(($salesDiff / $salesLastMonth) * 100, 2) : null;

            $profitThisMonth = $salesThisMonth - $purchasesThisMonth;
            $profitTotal = ($isAdmin ? $totalAdminSales : $totalCardsSales) - $totalPurchases;

            // -----------------------------
            // Top entities
            // -----------------------------
            if ($isAdmin) {
                $topMerchants = DB::table('admin_sales_invoices')
                    ->selectRaw('merchant_id, COUNT(*) as orders, SUM(amount) as amount')
                    ->groupBy('merchant_id')
                    ->orderByDesc('amount')
                    ->limit(8)
                    ->get()
                    ->map(function ($m) {
                        $user = User::find($m->merchant_id);
                        return [
                            'name' => $user->name ?? 'Unknown',
                            'orders' => $m->orders,
                            'amount' => (float) $m->amount,
                        ];
                    });

                $topEntities = $topMerchants;
            } else {
                $topCustomers = Card::query()
                    ->selectRaw('customer_id, COUNT(*) as orders, SUM(total_amount) as amount')
                    ->where('merchant_id', $merchantId)
                    ->whereNotNull('customer_id')
                    ->groupBy('customer_id')
                    ->orderByDesc('amount')
                    ->limit(8)
                    ->with('customer')
                    ->get()
                    ->map(function ($c) {
                        return [
                            'name' => optional($c->customer)->name ?? 'Unknown',
                            'orders' => $c->orders,
                            'amount' => (float) $c->amount,
                        ];
                    });

                $topEntities = $topCustomers;
            }

            // -----------------------------
            // Totals / New entities
            // -----------------------------
            if ($isAdmin) {
                $totalEntities = User::where('role', 'merchant')->count();
                $newEntitiesThisMonth = User::where('role', 'merchant')->whereBetween('created_at', [$startThis, $endThis])->count();
                $lastCount = User::where('role', 'merchant')->whereBetween('created_at', [$startLast, $endLast])->count();
                $newEntitiesDiffPercent = $lastCount > 0 ? round((($newEntitiesThisMonth - $lastCount) / $lastCount) * 100, 2) : null;
            } else {
                $totalEntities = Customer::where('merchant_id', $merchantId)->count();
                $newEntitiesThisMonth = Customer::where('merchant_id', $merchantId)->whereBetween('created_at', [$startThis, $endThis])->count();
                $lastCount = Customer::where('merchant_id', $merchantId)->whereBetween('created_at', [$startLast, $endLast])->count();
                $newEntitiesDiffPercent = $lastCount > 0 ? round((($newEntitiesThisMonth - $lastCount) / $lastCount) * 100, 2) : null;
            }

            return [
                'scope' => $isAdmin ? 'admin' : 'merchant',
                'entity_title' => $isAdmin ? 'Merchants' : 'Customers',
                'months' => $months->values(),
                'sales_series' => $salesSeries,
                'purchase_series' => $purchaseSeries,
                'sales_this_month' => (float) $salesThisMonth,
                'sales_last_month' => (float) $salesLastMonth,
                'purchases_this_month' => (float) $purchasesThisMonth,
                'purchases_last_month' => (float) $purchasesLastMonth,
                'sales_diff' => (float) $salesDiff,
                'sales_diff_percent' => $salesDiffPercent,
                'profit_this_month' => (float) $profitThisMonth,
                'profit_total' => (float) $profitTotal,
                'total_entities' => $totalEntities,
                'new_entities_this_month' => $newEntitiesThisMonth,
                'new_entities_diff_percent' => $newEntitiesDiffPercent,
                'top_entities' => $topEntities,
            ];
        });

        return view('dashboard.main', compact('metrics'));
    }
}
