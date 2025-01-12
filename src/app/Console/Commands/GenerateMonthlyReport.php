<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Report;

class GenerateMonthlyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate monthly report and save to database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now();
        $month = $today->copy()->format('F');
        $year = $today->copy()->format('Y');
        $name = 'Reports-' . $month . '-' . $year;

        $startDate = $today->copy()->startOfMonth();
        $endDate = $today->copy()->endOfMonth();

        $totalOrders = Order::whereBetween('created_at', [$startDate, $endDate])->count();
        
        $totalProducts = Product::whereBetween('created_at', [$startDate, $endDate])->count();
        
        $totalSuppliers = Supplier::whereBetween('created_at', [$startDate, $endDate])->count();

        $topProduct = Order::whereBetween('created_at', [$startDate, $endDate])
                        ->selectRaw('product_id, count(*) as total_orders')
                        ->groupBy('product_id')
                        ->orderByDesc('total_orders')
                        ->limit(1)
                        ->first();

        $topSupplier = Product::whereBetween('created_at', [$startDate, $endDate])
                        ->selectRaw('supplier_id, count(*) as total_products')
                        ->groupBy('supplier_id')
                        ->orderByDesc('total_products')
                        ->limit(1)
                        ->first();

        $topProductId = $topProduct ? $topProduct->product_id : null;
        $topProductTotal = $topProduct ? $topProduct->total_orders : 0;
        $topSupplierId = $topSupplier ? $topSupplier->supplier_id : null;
        $topSupplierTotal = $topSupplier ? $topSupplier->total_products : 0;

        Report::create([
            'name' => $name,
            'date_start' => $startDate,
            'date_end' => $endDate,
            'total_orders' => $totalOrders,
            'total_products' => $totalProducts,
            'total_suppliers' => $totalSuppliers,
            'top_product_id' => $topProductId,
            'top_product_total' => $topProductTotal,
            'top_supplier_id' => $topSupplierId,
            'top_supplier_total' => $topSupplierTotal
        ]);
    }
}
