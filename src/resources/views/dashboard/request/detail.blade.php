@extends('template.main')

@section('breadcrumbs')
<div class="pagetitle">
    <h1>Data Request</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item">Request</li>
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
            <div class="card-header">Deadline: {{ $request->deadline }} | Status : <span class="badge @if($request->status->name === "PENDING") bg-primary @elseif($request->status->name === "ACCEPT") bg-success @else bg-danger @endif">{{ $request->status }}</span></div>
            <div class="card-body">
              <h5 class="card-title">{{ $request->name }}</h5>
              Description: <br/>
              {!! $request->description !!}

              Quantity: {{ $request->quantity }}

              @if($request->status->name === "REJECT")
              Rejection Reason : <br/>
              {{ $request->rejection_reason }}
              @endif
            </div>
            <div class="card-footer d-flex justify-content-between">
              <a href="{{ route('requests.index') }}" class="btn btn-secondary">Back</a>
              <div class="status-container d-flex gap-2">
                <form method="POST" action="{{ route('requests.status', $request->id) }}">
                    @csrf
                    @method("PATCH")
                    <input type="hidden" name="status" value="reject">
                    <button type="submit" class="btn btn-danger">REJECT</button>
                </form>
                <form method="POST" action="{{ route('requests.status', $request->id) }}">
                    @csrf
                    @method("PATCH")
                    <input type="hidden" name="status" value="accept">
                    <button type="submit" class="btn btn-success">ACCEPT</button>
                </form>
              </div>
            </div>
          </div><!-- End Card with header and footer -->

      </div>
    </div>
  </section>
@endsection