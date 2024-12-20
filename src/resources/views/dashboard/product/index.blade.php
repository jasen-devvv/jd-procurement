@extends('template.main')

@section('breadcrumbs')
<div class="pagetitle">
    <h1>Data Product</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item active">Product</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection

@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Products <a class="btn btn-success" href="{{ route('products.create') }}">Add <i class="bi bi-plus"></i></a></h5>
            <p>Note: name prodcuts use uppercase</p>

            <!-- Table with stripped rows -->
            <div class="table-responsive">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th width="10%">No.</th>
                    <th width="20%">
                      <b>N</b>ame
                    </th>
                    <th width="20%">Description</th>
                    <th width="30%">Price</th>
                    <th width="10%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($products as $product)
                      <tr>
                          <td>{{ $loop->iteration }}.</td>
                          <td>{{ $product->name }}</td>
                          <td>{{ $product->description }}</td>
                          <td>{{ $product->price }}</td>
                          <td>
                              <div class="btn-group" role="group" aria-label="Action button">
                                  <a href="{{ route('products.show', $product->id) }}" class="btn btn-success">Detail</a>
                                  <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                                  <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger d-inline rounded-0 rounded-end">Delete</button>
                                  </form>
                              </div>
                          </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>
@endsection