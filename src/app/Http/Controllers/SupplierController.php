<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\SupplierRating;
use App\Enums\RatingStar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::withAvg('ratings as rating_avg', 'rating')->get();

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
            'name' => ['required', 'string'],
            'contact' => ['required', 'string'],
            'address' => ['required', 'string'],
        ]);

        Supplier::create($validData);
        Supplier::activity("created");

        return redirect()->route('suppliers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        $userId = Auth::id();
        $supplierRating = SupplierRating::where('user_id', $userId)->where('supplier_id', $id)->first();

        $rating = [
            'rating' => $supplierRating->rating ?? null,
            'review' => $supplierRating->review ?? '',
        ];

        $data = [
            'title' => 'Supplier | E-Procurement',
            'supplier' => $supplier,
            'rating' => $rating
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
            'name' => ['required', 'string'],
            'contact' => ['required', 'string'],
            'address' => ['required', 'string'],
        ]);

        $supplier->update($validData);
        Supplier::activity("updated");

        return redirect()->route('suppliers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::find($id);

        $supplier->delete();
        Supplier::activity("deleted"); 
     
        return redirect()->route('suppliers.index');
    }

    public function rating(Request $request, string $id)
    {
        $userId = Auth::id();

        $validData = $request->validate([
            'rating' => ['required'],
            'review' => ['nullable']
        ]);

        SupplierRating::updateOrCreate([
            'supplier_id' => $id,
            'user_id' => $userId
        ],
        [
            'rating' => $validData['rating'],
            'review' => $validData['review'],
        ]);

        return redirect()->route('suppliers.index');
    }
}
