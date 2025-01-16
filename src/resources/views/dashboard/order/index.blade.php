@extends('template.main')

@section('breadcrumbs')
<div class="pagetitle">
    <h1>Data Order</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item active">Order</li>
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
            <h5 class="card-title">Order @can('create request') <a class="btn btn-success" href="{{ route('orders.create') }}">Add <i class="bi bi-plus"></i></a> @endcan </h5>
            @role('staff')
            <div class="alert alert-warning"><b>Note</b>: Please add a supplier first.</div>
            @endrole

            @role('admin')
            <div class="alert alert-info"><b>Note</b>: To <span class="badge bg-success">ACCEPT</span> or <span class="badge bg-danger">REJECT</span> an order, click the details button.</div>
            @endrole
            
            <!-- Table with stripped rows -->
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover datatable">
                <thead>
                  <tr>
                    <th width="10%">No.</th>
                    @role('admin')
                    <th width="20%">
                      <b>N</b>ame User
                    </th>
                    @endrole
                    <th width="20%">Product</th>
                    <th width="20%">Deadline</th>
                    <th width="10%">Status</th>

                    @role('admin')
                    <th width="10%">Action</th>
                    @endrole

                    @role('staff')
                    <th width="20%">Action</th>
                    @endrole
                  </tr>
                </thead>
                <tbody>
                  @foreach($orders as $order)
                      <tr>
                          <td>{{ $loop->iteration }}.</td>
                          @role('admin')
                          <td>{{ $order->user->username }}</td>
                          @endrole
                          <td>{{ $order->product->name }}</td>
                          <td>{{ $order->deadline }}</td>
                          <td>
                            @if ($order->status->value == 'pending')
                                <span class="badge bg-primary">{{ $order->status->name }}</span>
                            @elseif($order->status->value == 'accept')
                                <span class="badge bg-success">{{ $order->status->name }}</span>
                            @elseif($order->status->value == 'reject')
                                <span class="badge bg-danger">{{ $order->status->name }}</span>
                            @endif
                            </td>
                          <td>
                              <div class="btn-group" role="group" aria-label="Action button">
                                  <a href="{{ route('orders.show', $order->id) }}" class="btn btn-success">Detail</a>
                                  @can('edit request')
                                  <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">Edit</a>
                                  @endcan

                                  @can('delete request')
                                  <form id="deleteForm" action="{{ route('orders.destroy', $order->id) }}" method="POST">
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