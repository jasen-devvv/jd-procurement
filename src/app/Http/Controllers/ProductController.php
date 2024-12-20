<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

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
        $data = [
            'title' => 'Product | E-Procurement',
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
            'name' => 'required',
            'description' => 'sometimes',
            'price' => 'required',
        ]);

        Product::create($validData);

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
        $data = [
            'title' => 'Product | E-Procurement',
            'product' => $product
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
            'name' => 'required',
            'description' => 'sometimes',
            'price' => 'required',
        ]);

        $product->update($validData);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('products.index');
    }
}
