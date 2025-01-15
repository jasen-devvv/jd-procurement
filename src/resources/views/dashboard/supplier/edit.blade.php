@extends('template.main')

@section('breadcrumbs')
<div class="pagetitle">
    <h1>Data Supplier</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item">Supplier</li>
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
            <h5 class="card-title">Form Edit Supplier</h5>

            <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST" class="row g-3">
                @csrf
                @method('PUT')
                <div class="col-12 required">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $supplier->name }}" name="name" id="name" autocomplete="off" placeholder="e.g., ABC Supply Co.">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 required">
                  <label for="contact" class="form-label">Contact</label>
                  <input type="text" class="form-control @error('contact') is-invalid @enderror" value="{{ $supplier->contact }}" id="contact" autocomplete="off" name="contact" placeholder="e.g., +6201234567890 or email@example.com">
                    @error('contact')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 required">
                  <label for="address" class="form-label">Address</label>
                  <input type="text" class="form-control @error('address') is-invalid @enderror" value="{{ $supplier->address }}" id="address" autocomplete="off" name="address" placeholder="e.g., 123 Main Street, City, Country">
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection