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
            <h5 class="card-title">Products @can('create product') <a class="btn btn-success" href="{{ route('products.create') }}">Add <i class="bi bi-plus"></i></a>@endcan</h5>
            <div class="alert alert-warning"><b>Note</b>: Please add a supplier first.</div>

            <!-- Table with stripped rows -->
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover datatable">
                <thead>
                  <tr>
                    <th width="10%">No.</th>
                    <th width="25%">Supplier</th>
                    <th width="15%">
                      <b>N</b>ame
                    </th>
                    <th width="20%">Description</th>
                    <th width="20%">Price</th>
                    @role('admin')
                    <th width="10%">Action</th>
                    @endrole
                  </tr>
                </thead>
                <tbody>
                  @foreach($products as $product)
                      <tr>
                          <td>{{ $loop->iteration }}.</td>
                          <td>{{ $product->supplier->name }}</td>
                          <td>{{ $product->name }}</td>
                          <td @empty($product->description) class="fst-italic" @endempty>{{ $product->description ?? "no description" }}</td>
                          <td>IDR {{ $product->price }}</td>
                          @role('admin')
                          <td>
                              <div class="btn-group" role="group" aria-label="Action button">
                                  @can('edit product')
                                  <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                                  @endcan

                                  @can('delete product')
                                  <form id="deleteForm" action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger btn-delete d-inline rounded-0 rounded-end">Delete</button>
                                  </form>
                                  @endcan
                              </div>
                          </td>
                          @endrole
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