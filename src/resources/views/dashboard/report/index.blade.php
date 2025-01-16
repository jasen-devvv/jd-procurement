@extends('template.main')

@section('breadcrumbs')
<div class="pagetitle">
    <h1>Data Report</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item active">Report</li>
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
            <h5 class="card-title">Montly Reports</h5>
            
            <!-- Table with stripped rows -->
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover datatable">
                <thead>
                  <tr>
                    <th width="10%">No.</th>
                    <th width="35%">
                      <b>N</b>ame
                    </th>
                    <th width="35%">Date</th>
                    <th width="20%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($reports as $report)
                      <tr>
                          <td>{{ $loop->iteration }}.</td>
                          <td>{{ $report->name }}</td>
                          <td>{{ $report->date_start->format('d/m/Y') }} - {{ $report->date_end->format('d/m/Y') }}</td>
                          <td>
                              <div class="btn-group" role="group" aria-label="Action button">
                                  <a href="{{ route('reports.detail', $report->id) }}" class="btn btn-primary">Detail</a>
                                  <a href="{{ route('reports.pdf', $report->id) }}" class="btn btn-danger">Print</a>
                                  <a href="{{ route('reports.excel', $report->id) }}" class="btn btn-success">Excel</a>
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