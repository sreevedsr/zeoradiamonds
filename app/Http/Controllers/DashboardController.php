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

        // Merchant scope closure
        $merchantScope = function ($query) use ($merchantId, $isAdmin) {
            if (!$isAdmin) {
                return $query->where('merchant_id', $merchantId);
            }
            return $query;
        };

        $cacheKey = 'dashboard_v4_' . ($isAdmin ? 'admin' : 'merchant_' . $merchantId);

        $metrics = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($merchantScope, $isAdmin, $merchantId) {

            /** -------------------------------------
             * MONTHLY SALES (last 6 months)
             * --------------------------------------*/
            $months = collect();
            $values = collect();

            for ($i = 5; $i >= 0; $i--) {
                $dt = Carbon::now()->subMonths($i);
                $label = $dt->format('M Y');

                $sum = $merchantScope(Card::query())
                    ->join('purchase_invoices', 'purchase_invoices.id', '=', 'cards.purchase_invoice_id')
                    ->whereBetween('purchase_invoices.invoice_date', [
                        $dt->copy()->startOfMonth(),
                        $dt->copy()->endOfMonth(),
                    ])
                    ->sum('cards.total_amount');

                $months->push($label);
                $values->push((float) $sum);
            }

            /** -------------------------------------
             * SALES THIS MONTH
             * --------------------------------------*/
            $salesThisMonth = $merchantScope(Card::query())
                ->join('purchase_invoices', 'purchase_invoices.id', '=', 'cards.purchase_invoice_id')
                ->whereBetween('purchase_invoices.invoice_date', [
                    Carbon::now()->startOfMonth(),
                    Carbon::now()->endOfMonth()
                ])
                ->sum('cards.total_amount');

            /** -------------------------------------
             * SALES LAST MONTH
             * --------------------------------------*/
            $salesLastMonth = $merchantScope(Card::query())
                ->join('purchase_invoices', 'purchase_invoices.id', '=', 'cards.purchase_invoice_id')
                ->whereBetween('purchase_invoices.invoice_date', [
                    Carbon::now()->subMonth()->startOfMonth(),
                    Carbon::now()->subMonth()->endOfMonth()
                ])
                ->sum('cards.total_amount');

            /** -------------------------------------
             * SALES DIFFERENCE
             * --------------------------------------*/
            $salesDiff = $salesThisMonth - $salesLastMonth;
            $salesDiffPercent = $salesLastMonth > 0
                ? round(($salesDiff / $salesLastMonth) * 100, 2)
                : null;


            /** -------------------------------------
             * ADMIN ANALYTICS
             * --------------------------------------*/
            if ($isAdmin) {

                $totalMerchants = User::where('role', 'merchant')->count();

                $newMerchantsThisMonth = User::where('role', 'merchant')
                    ->whereBetween('created_at', [
                        Carbon::now()->startOfMonth(),
                        Carbon::now()->endOfMonth()
                    ])
                    ->count();

                $last = User::where('role', 'merchant')
                    ->whereBetween('created_at', [
                        Carbon::now()->subMonth()->startOfMonth(),
                        Carbon::now()->subMonth()->endOfMonth()
                    ])
                    ->count();

                $newMerchantsDiffPercent = $last > 0
                    ? round((($newMerchantsThisMonth - $last) / $last) * 100, 2)
                    : null;

                $topMerchants = \DB::table('admin_sales_invoices')
                    ->selectRaw('merchant_id, COUNT(*) as orders, SUM(amount) as amount')
                    ->join('users', 'users.id', '=', 'admin_sales_invoices.merchant_id')
                    ->groupBy('merchant_id')
                    ->orderByDesc('amount')
                    ->limit(8)
                    ->get()
                    ->map(fn($m) => [
                        'name' => User::find($m->merchant_id)->name ?? 'Unknown',
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
             * MERCHANT ANALYTICS
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
