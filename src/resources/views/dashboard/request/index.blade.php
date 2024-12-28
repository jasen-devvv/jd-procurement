@extends('template.main')

@section('breadcrumbs')
<div class="pagetitle">
    <h1>Data Request</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item active">Request</li>
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
            <h5 class="card-title">Requests @can('create request') <a class="btn btn-success" href="{{ route('requests.create') }}">Add <i class="bi bi-plus"></i></a> @endcan </h5>
            @role('staff')
            <div class="alert alert-warning"><b>Note</b>: Please add a supplier first.</div>
            @endrole
            @role('admin')
            <div class="alert alert-info"><b>Note</b>: To provide approval or rejection status, click the detail button.</div>
            @endrole
            
            <!-- Table with stripped rows -->
            <div class="table-responsive">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th width="10%">No.</th>
                    <th width="20%">
                      <b>N</b>ame
                    </th>
                    <th width="20%">Supplier</th>
                    <th width="20%">Deadline</th>
                    <th width="10%">Status</th>
                    <th width="20%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($requests as $request)
                      <tr>
                          <td>{{ $loop->iteration }}.</td>
                          <td>{{ $request->supplier->name }}</td>
                          <td>{{ $request->name }}</td>
                          <td>{{ $request->deadline }}</td>
                          <td>
                            @if ($request->status->value == 'pending')
                                <span class="badge bg-primary">{{ $request->status->name }}</span>
                            @elseif($request->status->value == 'success')
                                <span class="badge bg-success">{{ $request->status->name }}</span>
                            @elseif($request->status->value == 'reject')
                                <span class="badge bg-danger">{{ $request->status->name }}</span>
                            @endif
                          <td>
                              <div class="btn-group" role="group" aria-label="Action button">
                                  <a href="{{ route('requests.show', $request->id) }}" class="btn btn-success">Detail</a>
                                  @can('edit request')
                                  <a href="{{ route('requests.edit', $request->id) }}" class="btn btn-warning">Edit</a>
                                  @endcan

                                  @can('delete request')
                                  <form action="{{ route('requests.destroy', $request->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger d-inline rounded-0 rounded-end">Delete</button>
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