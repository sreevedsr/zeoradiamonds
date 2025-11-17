<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $isAdmin = $user->role === 'admin';
        $merchantId = $isAdmin ? null : $user->id;

        // Scope for merchant
        $merchantScope = function ($query) use ($merchantId, $isAdmin) {
            if (!$isAdmin) {
                return $query->where('merchant_id', $merchantId);
            }
            return $query;
        };

        $cacheKey = 'dashboard_v4_' . ($isAdmin ? 'admin' : 'merchant_' . $merchantId);

        $metrics = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($merchantScope, $isAdmin, $merchantId) {

            /** -------------------------------------
             * SALES STATISTICS (same for admin/merchant, but merchant-scoped)
             * --------------------------------------*/
            $months = collect();
            $values = collect();

            for ($i = 5; $i >= 0; $i--) {
                $dt = Carbon::now()->subMonths($i);
                $label = $dt->format('M Y');

                $sum = $merchantScope(Card::query())
                    ->whereBetween('date', [
                            $dt->startOfMonth(),
                            $dt->endOfMonth()
                        ])
                    ->sum('total_amount');

                $months->push($label);
                $values->push((float) $sum);
            }

            $salesThisMonth = $merchantScope(Card::query())
                ->whereBetween('date', [
                        Carbon::now()->startOfMonth(),
                        Carbon::now()->endOfMonth()
                    ])
                ->sum('total_amount');

            $salesLastMonth = $merchantScope(Card::query())
                ->whereBetween('date', [
                        Carbon::now()->subMonth()->startOfMonth(),
                        Carbon::now()->subMonth()->endOfMonth()
                    ])
                ->sum('total_amount');

            $salesDiff = $salesThisMonth - $salesLastMonth;
            $salesDiffPercent = $salesLastMonth > 0
                ? round(($salesDiff / $salesLastMonth) * 100, 2)
                : null;

            /** -------------------------------------
             * IF ADMIN → SHOW MERCHANT ANALYTICS
             * --------------------------------------*/
            if ($isAdmin) {

                // Total merchants
                $totalMerchants = User::where('role', 'merchant')->count();

                // New merchants this month
                $newMerchantsThisMonth = User::where('role', 'merchant')
                    ->whereBetween('created_at', [
                            Carbon::now()->startOfMonth(),
                            Carbon::now()->endOfMonth()
                        ])
                    ->count();

                // Last month merchants
                $last = User::where('role', 'merchant')
                    ->whereBetween('created_at', [
                            Carbon::now()->subMonth()->startOfMonth(),
                            Carbon::now()->subMonth()->endOfMonth()
                        ])
                    ->count();

                $newMerchantsDiffPercent = $last > 0
                    ? round((($newMerchantsThisMonth - $last) / $last) * 100, 2)
                    : null;

                // Top merchants (by sale)
                $topMerchants = Card::query()
                    ->selectRaw('merchant_id, COUNT(*) as orders, SUM(total_amount) as amount')
                    ->with('merchant')
                    ->whereNotNull('merchant_id')
                    ->groupBy('merchant_id')
                    ->orderByDesc('amount')
                    ->limit(8)
                    ->get()
                    ->map(fn($m) => [
                        'name' => optional($m->merchant)->name ?? 'Unknown',
                        'orders' => $m->orders,
                        'amount' => $m->amount
                    ]);

                return [
                    'scope' => 'admin',
                    'entity_title' => 'Merchants',
                    'monthly_sales' => $months->map(fn($l, $i) => ['label' => $l, 'value' => $values[$i]]),
                    'sales_this_month' => $salesThisMonth,
                    'sales_last_month' => $salesLastMonth,
                    'sales_diff' => $salesDiff,
                    'sales_diff_percent' => $salesDiffPercent,
                    'total_entities' => $totalMerchants,
                    'new_entities_this_month' => $newMerchantsThisMonth,
                    'new_entities_diff_percent' => $newMerchantsDiffPercent,
                    'top_entities' => $topMerchants
                ];
            }

            /** -------------------------------------
             * IF MERCHANT → SHOW CUSTOMER ANALYTICS
             * --------------------------------------*/

            $totalCustomers = Customer::where('merchant_id', $merchantId)->count();

            $newCustomersThisMonth = Customer::where('merchant_id', $merchantId)
                ->whereBetween('created_at', [
                        Carbon::now()->startOfMonth(),
                        Carbon::now()->endOfMonth()
                    ])
                ->count();

            $last = Customer::where('merchant_id', $merchantId)
                ->whereBetween('created_at', [
                        Carbon::now()->subMonth()->startOfMonth(),
                        Carbon::now()->subMonth()->endOfMonth()
                    ])
                ->count();

            $newCustomersDiffPercent = $last > 0
                ? round((($newCustomersThisMonth - $last) / $last) * 100, 2)
                : null;

            $topCustomers = Card::query()
                ->selectRaw('customer_id, COUNT(*) as orders, SUM(total_amount) as amount')
                ->where('merchant_id', $merchantId)
                ->with('customer')
                ->whereNotNull('customer_id')
                ->groupBy('customer_id')
                ->orderByDesc('amount')
                ->limit(8)
                ->get()
                ->map(fn($c) => [
                    'name' => optional($c->customer)->name ?? 'Unknown',
                    'orders' => $c->orders,
                    'amount' => $c->amount
                ]);

            return [
                'scope' => 'merchant',
                'entity_title' => 'Customers',
                'monthly_sales' => $months->map(fn($l, $i) => ['label' => $l, 'value' => $values[$i]]),
                'sales_this_month' => $salesThisMonth,
                'sales_last_month' => $salesLastMonth,
                'sales_diff' => $salesDiff,
                'sales_diff_percent' => $salesDiffPercent,
                'total_entities' => $totalCustomers,
                'new_entities_this_month' => $newCustomersThisMonth,
                'new_entities_diff_percent' => $newCustomersDiffPercent,
                'top_entities' => $topCustomers
            ];
        });

        return view('dashboard.main', compact('metrics'));
    }
}
