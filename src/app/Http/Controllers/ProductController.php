<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('supplier')->get();

        $data = [
            'title' => 'Product | E-Procurement',
            'products' => $products
        ];

        return view('dashboard.product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();

        $data = [
            'title' => 'Product | E-Procurement',
            'suppliers' => $suppliers
        ];

        return view('dashboard.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'supplier_id' => 'required',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required',
        ], [
            'supplier_id' => 'The supplier field is required'
        ]);
        
        Product::create($validData);
        Product::activity("created");

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        $data = [
            'title' => 'Product | E-Procurement',
            'product' => $product
        ];

        return view('dashboard.product.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $suppliers = Supplier::all();
        $data = [
            'title' => 'Product | E-Procurement',
            'product' => $product,
            'suppliers' => $suppliers
        ];

        return view('dashboard.product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $validData = $request->validate([
            'supplier_id' => 'required',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required',
        ], [
            'supplier_id' => 'The supplier field is required'
        ]);

        $product->update($validData);
        Product::activity("updated");

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        $product->delete();
        Product::activity("deleted");

        return redirect()->route('products.index');
    }
}
