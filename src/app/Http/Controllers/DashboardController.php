<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Request as ModelsRequest;
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
        $requestCount = ModelsRequest::whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->count();

        $previousProductCount = Product::whereBetween('created_at', [$previousStartDate, $previousEndDate])->count();
        $previousSupplierCount = Supplier::whereBetween('created_at', [$previousStartDate, $previousEndDate])->count();
        $previousRequestCount = ModelsRequest::whereBetween('created_at', [$previousStartDate, $previousEndDate])->count();

        $productPercentageChange = parent::calculatePercentageChange($productCount, $previousProductCount);
        $supplierPercentageChange = parent::calculatePercentageChange($supplierCount, $previousSupplierCount);
        $requestPercentageChange = parent::calculatePercentageChange($requestCount, $previousRequestCount);

        // Activity Logs
        $recentActivities = Activity::orderBy('created_at', 'desc')->where('causer_id', auth()->user()->id)->take(5)->get();

        // Requests
        $requests = ModelsRequest::with(['supplier'])->get();

        $data = [
            'title' => 'Dashboard | E-Procurement',
            'productCount' => $productCount,
            'supplierCount' => $supplierCount,
            'requestCount' => $requestCount,
            'productPercentageChange' => $productPercentageChange,
            'supplierPercentageChange' => $supplierPercentageChange,
            'requestPercentageChange' => $requestPercentageChange,
            'recentActivities' => $recentActivities,
            'requests' => $requests
        ];

        return view('dashboard.index', $data);
    }

    public function profile()
    {
        $data = [
            'title' => 'Profile | E-Procurement'
        ];

        return view('dashboard.profile', $data);
    }
}
