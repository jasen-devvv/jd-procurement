@extends('template.main')

@section('breadcrumbs')
<div class="pagetitle">
    <h1>Data Product</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item">Product</li>
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
            <h5 class="card-title">Form Edit Product</h5>

            <form action="{{ route('products.update', $product->id) }}" method="POST" class="row g-3 needs-validation @if($errors->any()) was-validated @endif" novalidate>
                @csrf
                @method('PUT')
                <div class="col-12 required">
                  <label for="supplier" class="form-label">Supplier</label>
                  <select class="form-select" name="supplier_id" aria-label="Default select example" required>
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
                  <input type="text" class="form-control" value="{{ $product->name }}" name="name" id="name" placeholder="ex: Laptop" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12">
                  <label for="description" class="form-label">Description</label>
                  <textarea name="description" class="form-control" id="description" rows="5" placeholder="ex: Thinkpad T480 TS">{{ $product->description }}</textarea>
                </div>

                <div class="col-12 required">
                  <label for="price" class="form-label">Price</label>
                  <div class="input-group @error('price') has-validation @enderror">
                    <span class="input-group-text">Rp.</span>
                    <input type="text" class="form-control rupiah-number" placeholder="3.000.000" required>
                    <span class="input-group-text">,</span>
                    <input type="text" class="form-control rupiah-decimal" placeholder="00" required>
                    <input type="hidden" class="rupiah-hidden" value="{{ $product->price }}" name="price">
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