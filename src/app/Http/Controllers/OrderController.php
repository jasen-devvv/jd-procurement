<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Enums\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    /**
     * Display a listing of the order.
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin')) {
            $orders = Order::with('product')->get();
        } else {
            $orders = Order::with('product')->where('user_id', Auth::id())->get();
        }

        $data = [
            'title' => 'Request | E-Procurement',
            'orders' => $orders
        ];

        return view('dashboard.order.index', $data);
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        $products = Product::with(['supplier'])->get();
        $status = OrderStatus::cases();

        $data = [
            'title' => 'Request | E-Procurement',
            'products' => $products,
            'status' => $status
        ];

        return view('dashboard.order.create', $data);
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $validData = $request->validate([
            'product_id' => ['required'],
            'description' => ['nullable', 'string'],
            'quantity' => ['required'],
            'deadline' => ['required', 'date'],
        ], [
            'product_id' => 'The product field is required.',
        ]);
        
        $validData['user_id'] = $userId;

        Order::create($validData);
        Order::activity("created");

        return redirect()->route('orders.index')->with('success', 'Order has been successfully created.');
    }

    /**
     * Display the specified order.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);

        $data = [
            'title' => 'Order | E-Procurement',
            'order' => $order,
        ];

        return view('dashboard.order.detail', $data);
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(string $id)
    {
        $products = Product::with(['supplier'])->get();
        $order = Order::findOrFail($id);
        $status = OrderStatus::cases();

        $data = [
            'title' => 'Order | E-Procurement',
            'order' => $order,
            'products' => $products,
            'status' => $status
        ];

        return view('dashboard.order.edit', $data);
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestData = Order::findOrFail($id);
        $validData = $request->validate([
            'product_id' => ['required'],
            'description' => ['nullable', 'string'],
            'quantity' => ['required'],
            'deadline' => ['required', 'date'],
        ], [
            'product_id' => 'The product field is required.',
        ]);

        $requestData->update($validData);
        Order::activity("updated");

        return redirect()->route('orders.index')->with('success', 'Order has been successfully updated.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(string $id)
    {
        $request = Order::findOrFail($id);

        $request->delete($id);
        Order::activity("deleted");

        return redirect()->route('orders.index')->with('success', 'Order has been successfully deleted.');
    }

    /**
     * Update status the specified order from storage.
     */
    public function status(Request $request, string $id) 
    {
        $validData = $request->validate([
            'status' => [Rule::enum(OrderStatus::class)]
        ]);

        $request = Order::findOrFail($id);
        $request->update([
            'status' => $validData['status']
        ]);

        Order::activity("updated status");
        
        return redirect()->route('orders.index')->with('success', 'Order status has been successfully updated.');
    }
}
