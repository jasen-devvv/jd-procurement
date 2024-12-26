<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        $productCount = Product::whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->count();
        $supplierCount = Supplier::whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->count();
        $requestCount = ModelsRequest::whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->count();

        $previousProductCount = Product::whereBetween('created_at', [$previousStartDate, $previousEndDate])->count();
        $previousSupplierCount = Supplier::whereBetween('created_at', [$previousStartDate, $previousEndDate])->count();
        $previousRequestCount = ModelsRequest::whereBetween('created_at', [$previousStartDate, $previousEndDate])->count();

        $productPercentageChange = $this->calculatePercentageChange($productCount, $previousProductCount);
        $supplierPercentageChange = $this->calculatePercentageChange($supplierCount, $previousSupplierCount);
        $requestPercentageChange = $this->calculatePercentageChange($requestCount, $previousRequestCount);

        $data = [
            'title' => 'Dashboard | E-Procurement',
            'productCount' => $productCount,
            'supplierCount' => $supplierCount,
            'requestCount' => $requestCount,
            'productPercentageChange' => $productPercentageChange,
            'supplierPercentageChange' => $supplierPercentageChange,
            'requestPercentageChange' => $requestPercentageChange,
        ];

        return view('dashboard.index', $data);
    }


    private function calculatePercentageChange($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0; // Jika sebelumnya 0, beri 100% atau 0% berdasarkan kondisi
        }

        return (($current - $previous) / $previous) * 100;
    }

    public function profile()
    {
        $data = [
            'title' => 'Profile | E-Procurement'
        ];

        return view('dashboard.profile', $data);
    }
}
