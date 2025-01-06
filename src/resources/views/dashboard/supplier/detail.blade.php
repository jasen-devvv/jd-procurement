@extends('template.main')

@section('breadcrumbs')
<div class="pagetitle">
    <h1>Data Supplier</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item">Supplier</li>
        <li class="breadcrumb-item active">Detail</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection

@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-6">

         <!-- Card with header and footer -->
          <div class="card">
            <div class="card-header">Detail Supplier </div>
            <div class="card-body">
              <h5 class="card-title">{{ $supplier->name }}</h5>
              Contact: {{ $supplier->contact }} <br/>

              Address: {{ $supplier->address }} <br/>

              <ol class="list-group list-group-numbered mt-3">
                List Products: <br/>
                @foreach($supplier->products as $product)
                  <li class="list-group-item">{{ $product->name }}</li>
                @endforeach
              </ol>
            </div>
            <div class="card-footer">
              <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Back</a>
            </div>
          </div><!-- End Card with header and footer -->

      </div>
      <div class="col-lg-6">
          <div class="card">
            <div class="card-header">Rating Supplier</div>
            <div class="card-body">
              <form method="POST" action="{{ route('suppliers.rating', $supplier->id) }}">
                @csrf
                @method('PATCH')
                <div class="rating">
                  <input type="radio" name="rating" id="star5" value="5">
                  <label for="star5" class="bi bi-star-fill"></label>
                  <input type="radio" name="rating" id="star4" value="4">
                  <label for="star4" class="bi bi-star-fill"></label>
                  <input type="radio" name="rating" id="star3" value="3">
                  <label for="star3" class="bi bi-star-fill"></label>
                  <input type="radio" name="rating" id="star2" value="2">
                  <label for="star2" class="bi bi-star-fill"></label>
                  <input type="radio" name="rating" id="star1" value="1">
                  <label for="star1" class="bi bi-star-fill"></label>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </section>
@endsection