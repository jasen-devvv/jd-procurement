@extends('template.main')

@section('breadcrumbs')
<div class="pagetitle">
    <h1>Detail Report</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item">Report</li>
        <li class="breadcrumb-item active">Detail</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection

@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <!-- Card with header and footer -->
          <div class="card">
            <div class="card-header">Report Detail</div>
            <div class="card-body">
              <h5 class="card-title">{{ $report->name }}</h5>
              <p>Date : {{ $report->date_start->format('d/m/Y') }} - {{ $report->date_end->format('d/m/Y') }}</p>
              <!-- Primary Color Bordered Table -->
              <table class="table table-bordered table-striped border-dark">
                <thead class="table-success border-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Column</th>
                    <th scope="col">Data</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Total Suppliers</td>
                    <td>{{ $report->total_suppliers }}</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Total Products</td>
                    <td>{{ $report->total_products }}</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Total Orders</td>
                    <td>{{ $report->total_orders }}</td>
                  </tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>Top Supplier</td>
                    <td>{{ $report->top_supplier_id ? $report->supplier->name : "empty" }}</td>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td>Total Top Supplier</td>
                    <td>{{ $report->top_supplier_total }}</td>
                  </tr>
                  <tr>
                    <th scope="row">6</th>
                    <td>Top Product</td>
                    <td>{{ $report->top_product_id ? $report->product->name : "empty" }}</td>
                  </tr>
                  <tr>
                    <th scope="row">7</th>
                    <td>Total Top Product</td>
                    <td>{{ $report->top_product_total }}</td>
                  </tr>
                </tbody>
              </table>
              <!-- End Primary Color Bordered Table -->
            </div>
            <div class="card-footer">
              <a href="{{ route('reports') }}" class="btn btn-secondary">Back</a>
            </div>
          </div><!-- End Card with header and footer -->

      </div>
    </div>
  </section>
@endsection