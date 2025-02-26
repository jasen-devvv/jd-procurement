@extends('template.main')

@section('breadcrumbs')
<div class="pagetitle">
    <h1>Data Order</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item">Order</li>
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
            <h5 class="card-title">Form Add Order</h5>
            <div class="alert alert-info"><b>Note</b>: Please, for the description column, provide as much detail as possible.</div>

            <form action="{{ route('orders.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-12 required">
                  <label for="product_id" class="form-label">Product</label>
                  <select class="form-select @error('product_id') is-invalid @enderror" name="product_id" aria-label="Select product">
                    <option value="" selected>-- Choose Product --</option>
                    @foreach($products as $product)
                      <option value="{{ $product->id }}" @if(old('product_id') == $product->id) selected @endif>{{ $product->name }} - {{ $product->supplier->name }}</option>
                    @endforeach
                  </select>
                    @error('product_id')
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
                  <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" id="quantity" placeholder="e.g., 2">
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 required">
                  <label for="deadline" class="form-label">Deadline</label>
                  <input type="date" class="form-control @error('deadline') is-invalid @enderror" name="deadline" id="deadline">
                    @error('deadline')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection