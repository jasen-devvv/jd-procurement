@extends('template.main')

@section('breadcrumbs')
<div class="pagetitle">
    <h1>Data Supplier</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item active">Supplier</li>
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
            <h5 class="card-title">Suppliers @can('create supplier') <a class="btn btn-success" href="{{ route('suppliers.create') }}">Add <i class="bi bi-plus"></i></a> @endcan</h5>
            <div class="alert alert-info"><b>Note</b>: Click detail for rating</div>

            <!-- Table with stripped rows -->
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover datatable">
                <thead>
                  <tr>
                    <th width="10%">No.</th>
                    <th width="20%">
                      <b>N</b>ame
                    </th>
                    <th width="20%">Contact</th>
                    <th width="20%">Address</th>
                    <th width="20%">Average Rating</th>
                    <th width="10%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($suppliers as $supplier)
                      <tr>
                          <td>{{ $loop->iteration }}.</td>
                          <td>{{ $supplier->name }}</td>
                          <td>{{ $supplier->contact }}</td>
                          <td>{{ $supplier->address }}</td>
                          <td>{{ number_format($supplier->rating_avg, 2) }}</td>
                          <td>
                              <div class="btn-group" role="group" aria-label="Action button">
                                  <a href="{{ route('suppliers.show', $supplier->id) }}" class="btn btn-success">Detail</a>
                                  @can('edit supplier')
                                  <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-warning">Edit</a>
                                  @endcan

                                  @can('delete supplier')
                                  <form id="deleteForm" action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger btn-delete d-inline rounded-0 rounded-end">Delete</button>
                                  </form>
                                  @endcan
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