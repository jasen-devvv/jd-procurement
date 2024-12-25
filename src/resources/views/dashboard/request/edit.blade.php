@extends('template.main')

@section('breadcrumbs')
<div class="pagetitle">
    <h1>Data Request</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item">Request</li>
        <li class="breadcrumb-item active">Edit</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection

@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-6">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Form Edit Request</h5>

            <form action="{{ route('requests.update', $request->id) }}" method="POST" class="row g-3 needs-validation @if($errors->any()) was-validated @endif" novalidate>
                @csrf
                @method('PUT')
                <div class="col-12 required">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" value="{{ $request->name }}" name="name" id="name" placeholder="ex: Jasen" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12 required">
                  <label for="supplier_id" class="form-label">Supplier</label>
                  <select class="form-select" name="supplier_id" aria-label="Select Supplier" required>
                    <option value="" selected>-- Choose Supplier --</option>
                    @foreach($suppliers as $supplier)
                      <option value="{{ $supplier->id }}" @if($request->supplier->id == $supplier->id) selected @endif>{{ $supplier->name }}</option>
                    @endforeach
                  </select>
                    @error('supplier_id')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12">
                  <label for="description" class="form-label">Description</label>
                  <input type="hidden" name="description" id="quill-data">
                  <div class="card shadow-none">
                    <!-- Quill Editor Default -->
                    <div id="quill-editor">
                      {!! $request->description !!}
                    </div>
                    <!-- End Quill Editor Default -->                
                  </div>
                </div>

                <div class="col-12 required">
                  <label for="quantity" class="form-label">Quantity</label>
                  <input type="number" class="form-control" value="{{ $request->quantity }}" name="quantity" id="quantity" placeholder="e.g., 2" required>
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 required">
                  <label for="deadline" class="form-label">Deadline</label>
                  <input type="date" class="form-control" value="{{ $request->deadline }}" name="deadline" id="deadline" required>
                    @error('deadline')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @role('admin')
                <div class="col-12">
                  <label for="supplier" class="form-label">Status</label>
                  <select class="form-select" name="status" aria-label="Select Status">
                    <option value="" selected>-- Choose Status --</option>
                    @foreach($status as $stat)
                      <option value="{{ $stat->value }}" @if($request->status->value == $stat->value) selected @endif>{{ $stat->name }}</option>
                    @endforeach
                  </select>
                    @error('status')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                  <label for="rejection_reason" class="form-label">Rejection Reason</label>
                  <textarea name="rejection_reason" class="form-control" id="rejection_reason" rows="5" placeholder="e.g., Request doesn't meet requirements, Missing information">{{ old('rejection_reason') }}</textarea>
                </div>
                @endrole

                <div class="col-12">
                    <a href="{{ route('requests.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection