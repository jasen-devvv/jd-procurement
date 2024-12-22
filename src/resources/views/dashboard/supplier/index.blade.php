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
            <h5 class="card-title">Suppliers <a class="btn btn-success" href="{{ route('suppliers.create') }}">Add <i class="bi bi-plus"></i></a></h5>
            <div class="alert alert-info"><b>Note</b>: Click detail for rating</div>

            <!-- Table with stripped rows -->
            <div class="table-responsive">
              <table class="table table-hover datatable">
                <thead>
                  <tr>
                    <th width="10%">No.</th>
                    <th width="30%">
                      <b>N</b>ame
                    </th>
                    <th width="10%">Contact</th>
                    <th width="30%">Address</th>
                    <th width="10%">Rating</th>
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
                          <td>{{ $supplier->rating }}</td>
                          <td>
                              <div class="btn-group" role="group" aria-label="Action button">
                                  <a href="{{ route('suppliers.show', $supplier->id) }}" class="btn btn-success">Detail</a>
                                  <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-warning">Edit</a>
                                  <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST">
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

@section('script')
<script>

</script>
@endsection