@extends('template.main')

@section('breadcrumbs')
<div class="pagetitle">
    <h1>Data Order</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item">Order</li>
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
            <div class="card-header">Deadline: {{ $order->deadline }} | Status : <span class="text-uppercase badge @if($order->status->name === "PENDING") bg-primary @elseif($order->status->name === "ACCEPT") bg-success @else bg-danger @endif">{{ $order->status }}</span></div>
            <div class="card-body">
              <h5 class="card-title">{{ $order->product->name }}</h5>
              Description: <br/>
              {!! $order->description ?? "no description" !!}

              User: {{ $order->user->username }} <br/>
              Quantity: {{ $order->quantity }} <br/>

              @if($order->note)
              Note : <br/>
              {{ $order->note }}
              @endif
            </div>
            <div class="card-footer d-flex justify-content-between">
              <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back</a>
              @role('admin')
              <div class="status-container d-flex gap-2">
                <form method="POST" action="{{ route('orders.status', $order->id) }}">
                    @csrf
                    @method("PATCH")
                    <input type="hidden" name="status" value="reject">
                    <button type="submit" class="btn btn-danger">REJECT</button>
                </form>
                <form method="POST" action="{{ route('orders.status', $order->id) }}">
                    @csrf
                    @method("PATCH")
                    <input type="hidden" name="status" value="accept">
                    <button type="submit" class="btn btn-success">ACCEPT</button>
                </form>
              </div>
              @endrole
            </div>
          </div><!-- End Card with header and footer -->

      </div>
    </div>
  </section>
@endsection