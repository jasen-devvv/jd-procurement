<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'daily');
        $card = $request->get('card');
        $today = Carbon::now();

        switch ($period) {
            case 'monthly':
                $startDate = $today->copy()->startOfMonth();
                $endDate = $today->copy()->endOfMonth();
                $previousStartDate = $today->copy()->subMonth()->startOfMonth();
                $previousEndDate = $today->copy()->subMonth()->endOfMonth();
                break;

            case 'yearly':
                $startDate = $today->copy()->startOfYear();
                $endDate = $today->copy()->endOfYear();
                $previousStartDate = $today->copy()->subYear()->startOfYear();
                $previousEndDate = $today->copy()->subYear()->endOfYear();
                break;

            case 'daily':
            default:
                $startDate = $today->copy()->startOfDay();
                $endDate = $today->copy()->endOfDay();
                $previousStartDate = $today->copy()->subDay()->startOfDay();
                $previousEndDate = $today->copy()->subDay()->endOfDay();
                break;
        }

        $productCount = Product::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->count();
        $supplierCount = Supplier::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->count();
        $orderCount = Order::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->count();

        $previousProductCount = Product::whereBetween('created_at', [$previousStartDate, $previousEndDate])->count();
        $previousSupplierCount = Supplier::whereBetween('created_at', [$previousStartDate, $previousEndDate])->count();
        $previousOrderCount = Order::whereBetween('created_at', [$previousStartDate, $previousEndDate])->count();

        $productPercentageChange = parent::calculatePercentageChange($productCount, $previousProductCount);
        $supplierPercentageChange = parent::calculatePercentageChange($supplierCount, $previousSupplierCount);
        $orderPercentageChange = parent::calculatePercentageChange($orderCount, $previousOrderCount);

        // Activity Logs
        $recentActivities = Activity::orderBy('created_at', 'desc')->where('causer_id', auth()->user()->id)->take(5)->get();

        // Requests
        $orders = Order::with(['product'])->get();

         // Data chart
         $productData = Product::selectRaw('DATE(created_at) as date, COUNT(*) as count')
         ->groupBy('date')
         ->orderBy('date')
         ->get();

        $supplierData = Supplier::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->groupBy('date')
                ->orderBy('date')
                ->get();

        $orderData = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->groupBy('date')
                ->orderBy('date')
                ->get();

        $data = [
            'title' => 'Dashboard | E-Procurement',
            'productCount' => $productCount,
            'supplierCount' => $supplierCount,
            'orderCount' => $orderCount,
            'productPercentageChange' => $productPercentageChange,
            'supplierPercentageChange' => $supplierPercentageChange,
            'orderPercentageChange' => $orderPercentageChange,
            'recentActivities' => $recentActivities,
            'orders' => $orders,
            'productData' => $productData,
            'supplierData' => $supplierData,
            'orderData' => $orderData
        ];

        return view('dashboard.index', $data);
    }
}
