@extends('template.main')

@section('breadcrumbs')
<div class="pagetitle">
    <h1>Data Request</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item">Request</li>
        <li class="breadcrumb-item active">Create</li>
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
            <h5 class="card-title">Form Add Request</h5>
            <div class="alert alert-info"><b>Note</b>: Please, for the description column, provide as much detail as possible.</div>

            <form action="{{ route('requests.store') }}" method="POST" class="row g-3 needs-validation @if($errors->any()) was-validated @endif" novalidate>
                @csrf
                <div class="col-12 required">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" placeholder="Laptop" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 required">
                  <label for="supplier_id" class="form-label">Supplier</label>
                  <select class="form-select" name="supplier_id" aria-label="Select Supplier" required>
                    <option value="" selected>-- Choose Supplier --</option>
                    @foreach($suppliers as $supplier)
                      <option value="{{ $supplier->id }}" @if(old('supplier_id') == $supplier->id) selected @endif>{{ $supplier->name }}</option>
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
                    <div id="quill-editor">{!! old('description') !!}</div>
                    <!-- End Quill Editor Default -->                
                  </div>
                </div>
                

                <div class="col-12 required">
                  <label for="quantity" class="form-label">Quantity</label>
                  <input type="number" class="form-control" name="quantity" id="quantity" placeholder="e.g., 2" required>
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 required">
                  <label for="deadline" class="form-label">Deadline</label>
                  <input type="date" class="form-control" name="deadline" id="deadline" required>
                    @error('deadline')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @role('admin')
                <div class="col-12">
                  <label for="supplier" class="form-label">Status</label>
                  <select class="form-select" id="select-status" name="status" aria-label="Select Status">
                    <option value="" selected>-- Choose Status --</option>
                    @foreach($status as $stat)
                      <option value="{{ $stat->value }}" @if(old('status') == $stat->value) selected @endif>{{ $stat->name }}</option>
                    @endforeach
                  </select>
                    @error('status')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 d-none">
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