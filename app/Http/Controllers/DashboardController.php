<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $isAdmin = $user->role === 'admin';
        $merchantId = $isAdmin ? null : $user->id;

        $cacheKey = 'dashboard_v3_' . ($isAdmin ? 'admin' : 'merchant_' . $merchantId);

        $metrics = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($isAdmin, $merchantId) {

            // --- months (last 6 months)
            $months = collect();
            for ($i = 5; $i >= 0; $i--) {
                $months->push(Carbon::now()->subMonths($i)->format('M Y'));
            }

            $startThis = Carbon::now()->startOfMonth();
            $endThis = Carbon::now()->endOfMonth();
            $startLast = Carbon::now()->subMonth()->startOfMonth();
            $endLast = Carbon::now()->subMonth()->endOfMonth();

            // Helper: determines if card_ownerships has owner_type column
            $ownershipHasType = Schema::hasColumn('card_ownerships', 'owner_type');

            // Closure that applies ownership scoping for merchant queries.
            // It expects a Query Builder instance joined to 'cards' (or uses 'cards' table).
            $applyMerchantOwnershipScope = function ($query) use ($merchantId, $ownershipHasType) {
                // Ensure we are joining card_ownerships in the caller before calling this.
                $query->where('card_ownerships.owner_id', $merchantId);

                if ($ownershipHasType) {
                    // Adjust the string if you store a different owner_type value for merchants
                    $query->where('card_ownerships.owner_type', 'merchant');
                }

                return $query;
            };

            // -----------------------------
            // SALES (admin: admin_sales_invoices, merchant: cards via ownership)
            // -----------------------------
            if ($isAdmin) {
                $salesMonthly = DB::table('admin_sales_invoices')
                    ->selectRaw('DATE_FORMAT(created_at, "%b %Y") as month, SUM(amount) as total, COUNT(*) as orders')
                    ->groupBy('month')
                    ->orderByRaw('MIN(created_at)')
                    ->get()
                    ->keyBy('month');

                $totalSales = DB::table('admin_sales_invoices')->sum('amount');

                $salesThisMonth = DB::table('admin_sales_invoices')
                    ->whereBetween('created_at', [$startThis, $endThis])
                    ->sum('amount');

                $salesLastMonth = DB::table('admin_sales_invoices')
                    ->whereBetween('created_at', [$startLast, $endLast])
                    ->sum('amount');
            } else {
                // Merchant: sales are cards that are owned by the merchant (via card_ownerships)
                $salesMonthlyQuery = DB::table('cards')
                    ->join('purchase_invoices', 'purchase_invoices.id', '=', 'cards.purchase_invoice_id')
                    ->join('card_ownerships', 'card_ownerships.card_id', '=', 'cards.id')
                    ->selectRaw('DATE_FORMAT(purchase_invoices.invoice_date, "%b %Y") as month, SUM(cards.total_amount) as total, COUNT(cards.id) as orders')
                    ->groupBy('month')
                    ->orderByRaw('MIN(purchase_invoices.invoice_date)');

                // apply ownership
                $applyMerchantOwnershipScope($salesMonthlyQuery);

                $salesMonthly = $salesMonthlyQuery->get()->keyBy('month');

                $totalSales = DB::table('cards')
                    ->join('card_ownerships', 'card_ownerships.card_id', '=', 'cards.id')
                    ->when($ownershipHasType, fn($q) => $q->where('card_ownerships.owner_type', 'merchant'))
                    ->where('card_ownerships.owner_id', $merchantId)
                    ->sum('cards.total_amount');

                $salesThisMonth = DB::table('cards')
                    ->join('purchase_invoices', 'purchase_invoices.id', '=', 'cards.purchase_invoice_id')
                    ->join('card_ownerships', 'card_ownerships.card_id', '=', 'cards.id')
                    ->when($ownershipHasType, fn($q) => $q->where('card_ownerships.owner_type', 'merchant'))
                    ->where('card_ownerships.owner_id', $merchantId)
                    ->whereBetween('purchase_invoices.invoice_date', [$startThis, $endThis])
                    ->sum('cards.total_amount');

                $salesLastMonth = DB::table('cards')
                    ->join('purchase_invoices', 'purchase_invoices.id', '=', 'cards.purchase_invoice_id')
                    ->join('card_ownerships', 'card_ownerships.card_id', '=', 'cards.id')
                    ->when($ownershipHasType, fn($q) => $q->where('card_ownerships.owner_type', 'merchant'))
                    ->where('card_ownerships.owner_id', $merchantId)
                    ->whereBetween('purchase_invoices.invoice_date', [$startLast, $endLast])
                    ->sum('cards.total_amount');
            }

            // -----------------------------
            // PURCHASES (admin only) -> cards joined to purchase_invoices
            // -----------------------------
            if ($isAdmin) {
                $purchaseMonthly = DB::table('cards')
                    ->join('purchase_invoices', 'purchase_invoices.id', '=', 'cards.purchase_invoice_id')
                    ->selectRaw('DATE_FORMAT(purchase_invoices.invoice_date, "%b %Y") as month, SUM(cards.total_amount) as total, COUNT(cards.id) as items')
                    ->groupBy('month')
                    ->orderByRaw('MIN(purchase_invoices.invoice_date)')
                    ->get()
                    ->keyBy('month');

                $totalPurchases = DB::table('cards')
                    ->join('purchase_invoices', 'purchase_invoices.id', '=', 'cards.purchase_invoice_id')
                    ->sum('cards.total_amount');

                $purchasesThisMonth = DB::table('cards')
                    ->join('purchase_invoices', 'purchase_invoices.id', '=', 'cards.purchase_invoice_id')
                    ->whereBetween('purchase_invoices.invoice_date', [$startThis, $endThis])
                    ->sum('cards.total_amount');

                $purchasesLastMonth = DB::table('cards')
                    ->join('purchase_invoices', 'purchase_invoices.id', '=', 'cards.purchase_invoice_id')
                    ->whereBetween('purchase_invoices.invoice_date', [$startLast, $endLast])
                    ->sum('cards.total_amount');
            } else {
                $purchaseMonthly = collect([]);
                $totalPurchases = 0;
                $purchasesThisMonth = 0;
                $purchasesLastMonth = 0;
            }

            // -----------------------------
            // Chart series (last 6 months)
            // -----------------------------
            $salesSeries = $months->map(fn($m) => (float) ($salesMonthly[$m]->total ?? 0));
            $purchaseSeries = $months->map(fn($m) => (float) ($purchaseMonthly[$m]->total ?? 0));

            // -----------------------------
            // diffs & profit
            // -----------------------------
            $salesDiff = $salesThisMonth - $salesLastMonth;
            $salesDiffPercent = $salesLastMonth > 0 ? round(($salesDiff / $salesLastMonth) * 100, 2) : null;

            $profitThisMonth = $salesThisMonth - $purchasesThisMonth;
            $profitTotal = ($isAdmin ? DB::table('admin_sales_invoices')->sum('amount') : $totalSales) - $totalPurchases;

            // -----------------------------
            // TOP ENTITIES
            // -----------------------------
            if ($isAdmin) {
                $topEntities = DB::table('admin_sales_invoices')
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
            } else {
                // Top customers for this merchant (cards owned by merchant, grouped by customer_id)
                $topEntities = DB::table('card_ownerships as merchant_owner')
                    ->join('cards', 'cards.id', '=', 'merchant_owner.card_id')
                    ->join('card_ownerships as customer_owner', 'customer_owner.card_id', '=', 'cards.id')
                    ->join('customers', 'customers.id', '=', 'customer_owner.owner_id')
                    ->where('merchant_owner.owner_type', 'merchant')
                    ->where('merchant_owner.owner_id', $merchantId)
                    ->where('customer_owner.owner_type', 'customer')
                    ->selectRaw('
            customers.id as customer_id,
            customers.name as name,
            COUNT(cards.id) as orders,
            SUM(cards.total_amount) as amount
        ')
                    ->groupBy('customers.id', 'customers.name')
                    ->orderByDesc('amount')
                    ->limit(8)
                    ->get();
            }

            // -----------------------------
            // Totals / new entities
            // -----------------------------
            if ($isAdmin) {
                $totalEntities = User::where('role', 'merchant')->count();
                $newEntitiesThisMonth = User::where('role', 'merchant')->whereBetween('created_at', [$startThis, $endThis])->count();
                $lastCount = User::where('role', 'merchant')->whereBetween('created_at', [$startLast, $endLast])->count();
            } else {
                $totalEntities = Customer::where('merchant_id', $merchantId)->count();
                $newEntitiesThisMonth = Customer::where('merchant_id', $merchantId)->whereBetween('created_at', [$startThis, $endThis])->count();
                $lastCount = Customer::where('merchant_id', $merchantId)->whereBetween('created_at', [$startLast, $endLast])->count();
            }

            $newEntitiesDiffPercent = $lastCount > 0 ? round((($newEntitiesThisMonth - $lastCount) / $lastCount) * 100, 2) : null;

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
