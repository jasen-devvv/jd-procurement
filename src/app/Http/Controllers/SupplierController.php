<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();

        $data = [
            'title' => 'Supplier | E-Procurement',
            'suppliers' => $suppliers,
        ];

        return view('dashboard.supplier.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Supplier | E-Procurement',
        ];

        return view('dashboard.supplier.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'name' => 'required|string',
            'contact' => 'required|string',
            'address' => 'required|string',
        ]);

        Supplier::create($validData);
        Supplier::logActivity("created");

        return redirect()->route('suppliers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = Supplier::findOrFail($id);

        $averageRating = $supplier->rating_count > 0 ? $supplier->rating_total / $supplier->rating_count : 0;

        $data = [
            'title' => 'Supplier | E-Procurement',
            'supplier' => $supplier,
            'average' => $averageRating
        ];

        return view('dashboard.supplier.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = Supplier::find($id);

        $data = [
            'title' => 'Supplier | E-Procurement',
            'supplier' => $supplier
        ];

        return view('dashboard.supplier.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $supplier = Supplier::find($id);

        $validData = $request->validate([
            'name' => 'required|string',
            'contact' => 'required|string',
            'address' => 'required|string',
        ]);

        $supplier->update($validData);
        Supplier::logActivity("updated");

        return redirect()->route('suppliers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::find($id);

        $supplier->delete();
        Supplier::logActivity("deleted"); 
     
        return redirect()->route('suppliers.index');
    }

    public function rating(Request $request, string $id)
    {
        $supplier = Supplier::findOrFail($id);

        $newRating = $request->input('rating');

        $supplier->rating_total += $newRating;
        $supplier->rating_count += 1;

        $supplier->save();

        return redirect()->route('suppliers.index');
    }
}
