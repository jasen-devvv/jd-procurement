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
                @forelse($supplier->products as $product)
                  <li class="list-group-item">{{ $product->name }}</li>
                @empty
                  <div class="alert border-danger text-danger show" role="alert">
                    Product empty.
                  </div>
                @endforelse
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
              <form class="row g-3" method="POST" action="{{ route('suppliers.rating', $supplier->id) }}">
                @csrf
                @method('PATCH')
                
                <div class="col-12">
                  <div class="rating">
                    @for($i = 5; $i >= 1; $i--)
                    <input type="radio" name="rating" id="star{{$i}}" value="{{$i}}" @if($rating['rating'] == $i) checked @endif>
                    <label for="star{{$i}}" class="bi bi-star-fill"></label>
                    @endfor
                  </div>
                </div>

                <div class="col-12">
                  <label for="review" class="form-label">Review</label>
                  <textarea name="review" class="form-control" id="review" style="height: 100px" placeholder="Review supplier here...">{{ $rating['review'] }}</textarea>
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