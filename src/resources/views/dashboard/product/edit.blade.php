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
                <div class="col-12">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" value="{{ $product->name }}" name="name" id="name" placeholder="ex: Jasen" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-12">
                  <label for="description" class="form-label">Description</label>
                  <textarea name="description" class="form-control" value="{{ $product->description }}" id="description" rows="5" placeholder="ex: haloo"></textarea>
                </div>

                <div class="col-12">
                  <label for="price" class="form-label">Price</label>
                  <input type="number" class="form-control" value="{{ $product->price }}" name="price" id="price" placeholder="ex: 12" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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