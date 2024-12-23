@extends('template.main')

@section('breadcrumbs')
<div class="pagetitle">
    <h1>Data Supplier</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item">Supplier</li>
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
            <h5 class="card-title">Form Add Supplier</h5>

            <form id="formSupplier" action="{{ route('suppliers.store') }}" method="POST" class="row g-3 needs-validation @if($errors->any()) was-validated @endif" novalidate>
                @csrf
                <div class="col-12 required">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" value="{{ old('name') }}" name="name" id="name" placeholder="ex: Jasen" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 required">
                  <label for="contact" class="form-label">Contact</label>
                  <input type="number" class="form-control" value="{{ old('contanct') }}" id="contact" name="contact" placeholder="ex: 0812-3456-7890" required>
                    @error('contact')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 required">
                  <label for="address" class="form-label">Address</label>
                  <input type="text" class="form-control" value="{{ old('address') }}" id="address" name="address" placeholder="ex: New York 65, street 12" required>
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