<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use App\Models\Supplier;
use App\Enums\RequestStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin')) {
            $requests = ModelsRequest::with('supplier')->get();
        } else {
            $requests = ModelsRequest::with('supplier')->where('user_id', Auth::id())->get();
        }

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
        $status = RequestStatus::cases();

        $data = [
            'title' => 'Request | E-Procurement',
            'suppliers' => $suppliers,
            'status' => $status
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
            'supplier_id' => 'required',
            'name' => 'required|string',
            'description' => 'sometimes|string',
            'quantity' => 'required',
            'deadline' => 'required|date',
            'status' => [Rule::enum(RequestStatus::class)],
            'rejection_reason' => 'sometimes|string'
        ], [
            'supplier_id' => 'The supplier field is required.',
        ]);
        
        $validData['user_id'] = $userId;

        ModelsRequest::create($validData);
        ModelsRequest::logActivity("created");

        return redirect()->route('requests.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $request = ModelsRequest::findOrFail($id);

        $data = [
            'title' => 'Request | E-Procurement',
            'request' => $request,
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
        $status = RequestStatus::cases();

        $data = [
            'title' => 'Request | E-Procurement',
            'request' => $request,
            'suppliers' => $suppliers,
            'status' => $status
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
            'supplier_id' => 'required',
            'name' => 'required|string',
            'description' => 'sometimes|string',
            'quantity' => 'required',
            'deadline' => 'required|date',
            'status' => ['sometimes',Rule::enum(RequestStatus::class)],
            'rejection_reason' => 'sometimes|string'
        ], [
            'supplier_id' => 'The supplier field is required.'
        ]);

        $requestData->update($validData);
        ModelsRequest::logActivity("updated");

        return redirect()->route('requests.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $request = ModelsRequest::findOrFail($id);

        $request->delete($id);
        ModelsRequest::logActivity("deleted");

        return redirect()->route('requests.index');
    }

    public function status(Request $request, string $id) 
    {
        $validData = $request->validate([
            'status' => [Rule::enum(RequestStatus::class)]
        ]);

        $request = ModelsRequest::findOrFail($id);
        $request->update([
            'status' => $validData['status']
        ]);

        ModelsRequest::logActivity("updated status");
        
        return redirect()->route('requests.index');
    }
}
