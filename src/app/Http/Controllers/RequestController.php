<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = ModelsRequest::all();

        $data = [
            'title' => 'Request | E-Procurement',
            'requests' => $requests
        ];

        return view('dashboard.request.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();

        $data = [
            'title' => 'Request | E-Procurement',
            'suppliers' => $suppliers
        ];

        return view('dashboard.request.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $validData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'quantity' => 'required',
            'deadline' => 'date',
        ]);

        $validData['user_id'] = $userId;

        ModelsRequest::create($validData);

        return redirect()->route('requests.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $suppliers = Supplier::all();
        $request = ModelsRequest::findOrFail($id);

        $data = [
            'title' => 'Request | E-Procurement',
            'request' => $request,
            'suppliers' => $suppliers
        ];

        return view('dashboard.request.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $suppliers = Supplier::all();
        $request = ModelsRequest::findOrFail($id);

        $data = [
            'title' => 'Request | E-Procurement',
            'request' => $request,
            'suppliers' => $suppliers
        ];

        return view('dashboard.request.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestData = ModelsRequest::findOrFail($id);
        $validData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'quantity' => 'required',
            'deadline' => 'date',
        ]);

        $requestData->update($validData);

        return redirect()->route('requests.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $request = ModelsRequest::findOrFail($id);

        $request->delete($id);

        return redirect()->route('requests.index');
    }
}
