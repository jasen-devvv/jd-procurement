@extends('template.main')

@section('breadcrumbs')
<div class="pagetitle">
    <h1>Data Product</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item">Product</li>
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
            <h5 class="card-title">Form Add Product</h5>

            <form action="{{ route('products.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-12 required">
                  <label for="supplier" class="form-label">Supplier</label>
                  <select class="form-select @error('supplier_id') is-invalid @enderror" name="supplier_id" aria-label="Select supplier">
                    <option value="" selected>-- Choose Supplier --</option>
                    @foreach($suppliers as $supplier)
                      <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                  </select>
                    @error('supplier_id')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 required">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" id="name" placeholder="e.g., Laptop">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12">
                  <label for="description" class="form-label">Description</label>
                  <textarea name="description" class="form-control" id="description" rows="5" placeholder="e.g., Original product with official guarantee or Lenovo Thinkpad">{{ old('description') }}</textarea>
                </div>

                <div class="col-12 required">
                  <label for="price" class="form-label">Price</label>
                  <input class="rupiah-hidden" type="hidden" name="price" value="">
                  <div class="input-group has-validation">
                    <span class="input-group-text">IDR</span>
                    <input type="text" class="form-control rupiah-number @error('price') is-invalid @enderror" placeholder="e.g., 5.300.000">
                    <span class="input-group-text">,</span>
                    <input type="text" class="form-control rupiah-decimal @error('price') is-invalid @enderror" placeholder="e.g., 00">
                    @error('price')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="col-12">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection