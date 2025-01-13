<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the product.
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
     * Show the form for creating a new product.
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
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'supplier_id' => ['required'],
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'price' => ['required'],
        ], [
            'supplier_id' => 'The supplier field is required'
        ]);
        
        Product::create($validData);
        Product::activity("created");

        return redirect()->route('products.index')->with('success', 'Product has been successfully added.');
    }

    /**
     * Display the specified product.
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
     * Show the form for editing the specified product.
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
     * Update the specified product in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $validData = $request->validate([
            'supplier_id' => ['required'],
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'price' => ['required'],
        ], [
            'supplier_id' => 'The supplier field is required'
        ]);

        $product->update($validData);
        Product::activity("updated");

        return redirect()->route('products.index')->with('success', 'Product details have been successfully updated.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        $product->delete();
        Product::activity("deleted");

        return redirect()->route('products.index')->with('success', 'Product has been successfully deleted.');
    }
}
