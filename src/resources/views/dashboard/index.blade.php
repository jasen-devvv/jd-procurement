@extends('template.main')

@section('breadcrumbs')
<div class="pagetitle">
	<h1>Dashboard</h1>
	<nav>
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.html">Home</a></li>
		<li class="breadcrumb-item active">Dashboard</li>
	  </ol>
	</nav>
  </div><!-- End Page Title -->
@endsection

@section('content')
	

<section class="section dashboard">
	<div class="row">

	  <!-- Left side columns -->
	  <div class="@role('admin') col-lg-8 @endrole @role('staff') col-lg-6 @endrole">
		<div class="row">

		  <!-- Product Card -->
		  <div class="@role('admin') col-xxl-4 @endrole @role('staff') col-xxl-6 @endrole col-md-6">
			<div class="card info-card product-card">

			  <div class="filter">
				<a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
				<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
				  <li class="dropdown-header text-start">
					<h6>Filter</h6>
				  </li>

				  	<li><a class="dropdown-item" href="{{ route('dashboard', ['card' => 'product', 'period' => 'daily']) }}">Today</a></li>
					<li><a class="dropdown-item" href="{{ route('dashboard', ['card' => 'product', 'period' => 'monthly']) }}">This Month</a></li>
					<li><a class="dropdown-item" href="{{ route('dashboard', ['card' => 'product', 'period' => 'yearly']) }}">This Year</a></li>

				</ul>
			  </div>

			  <div class="card-body">
				<h5 class="card-title">Total Product <span>| {{ request()->get('period', 'daily') }}</span></h5>

				<div class="d-flex align-items-center">
				  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
					<i class="bi bi-box-fill"></i>
				  </div>
				  <div class="ps-3">
					<h6>{{ $productCount }}</h6>
					@role('admin')
					<span class="{{ $productPercentageChange >= 0 ? 'text-success' : 'text-danger' }} small pt-1 fw-bold">
						{{ number_format($productPercentageChange, 2) }}%
					</span>
					<span class="text-muted small pt-1 ps-1">
						{{ $productPercentageChange >= 0 ? 'increase' : 'decrease' }}
					</span>
					@endrole
				  </div>
				</div>
			  </div>

			</div>
		  </div><!-- End Product Card -->

		  <!-- Supplier Card -->
		  <div class="@role('admin') col-xxl-4 @endrole @role('staff') col-xxl-6 @endrole col-md-6">
			<div class="card info-card supplier-card">

			  <div class="filter">
				<a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
				<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
				  <li class="dropdown-header text-start">
					<h6>Filter</h6>
				  </li>

				  <li><a class="dropdown-item" href="{{ route('dashboard', ['card' => 'supplier', 'period' => 'daily']) }}">Today</a></li>
				  <li><a class="dropdown-item" href="{{ route('dashboard', ['card' => 'supplier', 'period' => 'monthly']) }}">This Month</a></li>
				  <li><a class="dropdown-item" href="{{ route('dashboard', ['card' => 'supplier', 'period' => 'yearly']) }}">This Year</a></li>
			  	</ul>
			  </div>

			  <div class="card-body">
				<h5 class="card-title">Total Supplier <span>| {{ request()->get('period', 'daily') }}</span></h5>

				<div class="d-flex align-items-center">
				  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
					<i class="bi bi-stack"></i>
				  </div>
				  <div class="ps-3">
					<h6>{{ $supplierCount }}</h6>
					@role('admin')
					<span class="{{ $supplierPercentageChange >= 0 ? 'text-success' : 'text-danger' }} small pt-1 fw-bold">
						{{ number_format($supplierPercentageChange, 2) }}%
					</span>
					<span class="text-muted small pt-1 ps-1">
						{{ $supplierPercentageChange >= 0 ? 'increase' : 'decrease' }}
					</span>
					@endrole
				  </div>
				</div>
			  </div>

			</div>
		  </div><!-- End Supplier Card -->

		  @role('admin')
		  <!-- Request Card -->
		  <div class="col-xxl-4 col-xl-12">

			<div class="card info-card request-card">

			  <div class="filter">
				<a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
				<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
				  <li class="dropdown-header text-start">
					<h6>Filter</h6>
				  </li>

				  <li><a class="dropdown-item" href="{{ route('dashboard', ['card' => 'request', 'period' => 'daily']) }}">Today</a></li>
				  <li><a class="dropdown-item" href="{{ route('dashboard', ['card' => 'request', 'period' => 'monthly']) }}">This Month</a></li>
				  <li><a class="dropdown-item" href="{{ route('dashboard', ['card' => 'request', 'period' => 'yearly']) }}">This Year</a></li>
				</ul>
			  </div>

			  <div class="card-body">
				<h5 class="card-title">Total Request <span>| {{ request()->get('period', 'daily') }}</span></h5>

				<div class="d-flex align-items-center">
				  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
					<i class="bi bi-arrow-left-right"></i>
				  </div>
				  <div class="ps-3">
					<h6>{{ $requestCount }}</h6>
					<span class="{{ $requestPercentageChange >= 0 ? 'text-success' : 'text-danger' }} small pt-1 fw-bold">
						{{ number_format($requestPercentageChange, 2) }}%
					</span>
					<span class="text-muted small pt-1 ps-1">
						{{ $requestPercentageChange >= 0 ? 'increase' : 'decrease' }}
					</span>
				  </div>
				</div>

			  </div>
			</div>

		  </div><!-- End Request Card -->
		  @endrole

		  <!-- Reports -->
		  @role('admin')
		  <div class="col-12">
			<div class="card">

			  <div class="card-body">
				<h5 class="card-title">Reports</h5>

				<!-- Line Chart -->
				<div id="reportsChart"></div>
				<!-- End Line Chart -->

			  </div>
			  
			</div>
		  </div><!-- End Reports -->		
		  @endrole
		  
		  @role('admin')
		  <div class="col-12">
			<!-- Recent Sales -->
			<div class="card recent-sales overflow-auto">
				<div class="card-body">
				<h5 class="card-title">Recent Request</h5>

				<table class="table table-borderless datatable">
					<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Request</th>
						<th scope="col">Supplier</th>
						<th scope="col">Deadline</th>
						<th scope="col">Status</th>
					</tr>
					</thead>
					<tbody>
						@foreach($requests as $req)
						<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $req->name }}</td>
						<td>{{ $req->supplier->name }}</td>
						<td>{{ $req->deadline }}</td>
						<td>
							@if ($req->status->value == 'pending')
								<span class="badge bg-primary">{{ $req->status->name }}</span>
							@elseif($req->status->value == 'accept')
								<span class="badge bg-success">{{ $req->status->name }}</span>
							@elseif($req->status->value == 'reject')
								<span class="badge bg-danger">{{ $req->status->name }}</span>
							@endif
						</tr>
						@endforeach
					</tbody>
				</table>

				</div>

			</div> <!-- End Recent Sales -->
		  </div>
		  @endrole

		  @role('staff')
		  <div class="col-12">
			  <!-- Full Calendar -->
			  <div class="card">
			  <div class="card-body">
				  <h5 class="card-title">Calendar</h5>
  
				  <div id="calendar"></div>
  
			  </div>
			  </div><!-- End Full Calendar -->
		  </div>
		@endrole

		</div>
	  </div><!-- End Left side columns -->

	  <!-- Right side columns -->
	  <div class="@role('admin') col-lg-4 @endrole @role('staff') col-lg-6 @endrole">

		<!-- Recent Activity -->
		<div class="card">
		  <div class="card-body">
			<h5 class="card-title">Recent Activity</h5>

			<div class="activity">

				@if($recentActivities->isEmpty())
					<div>No Activities</div>
				@else
					@foreach($recentActivities as $activity)
					<div class="activity-item d-flex">
						<div class="activite-label">{{ $activity->created_at->format('d M Y, H:i') }}</div>
							@php
								$color = match($activity->log_name) {
									'product' => 'text-warning',
									'supplier' => 'text-success',
									'request' => 'text-primary',
									default => 'text-secondary'
								}
							@endphp
							<i class='bi bi-circle-fill activity-badge {{ $color }} align-self-start'></i>
						<div class="activity-content">
							{{ $activity->description }}
						</div>
					</div><!-- End activity item-->
					@endforeach
				@endif

			</div>

		  </div>
		</div><!-- End Recent Activity -->

		@role('admin')
		<!-- Full Calendar -->
		<div class="card">
		  <div class="card-body">
			<h5 class="card-title">Calendar</h5>

			<div id="calendar"></div>

		  </div>
		</div><!-- End Full Calendar -->
		@endrole

	  </div><!-- End Right side columns -->

	</div>
  </section>
@endsection

@section('script')
<script>
	document.addEventListener("DOMContentLoaded", () => {
		const productData = @json($productData);
		const supplierData = @json($supplierData);
		const requestData = @json($requestData);

		const allDates = [
			...new Set([
				...productData.map(item => item.date),
				...supplierData.map(item => item.date),
				...requestData.map(item => item.date)
			])
		];

		const getDataForDate = (data, date) => {
			const item = data.find(d => d.date === date);
			return item ? item.count : 0;
		};

		const productSeries = allDates.map(date => getDataForDate(productData, date));
		const supplierSeries = allDates.map(date => getDataForDate(supplierData, date));
		const requestSeries = allDates.map(date => getDataForDate(requestData, date));

		new ApexCharts(document.querySelector("#reportsChart"), {
			series: [{
				name: 'Product',
				data: productSeries,
			}, {
				name: 'Supplier',
				data: supplierSeries,
			}, {
				name: 'Request',
				data: requestSeries,
			}],
			chart: {
				height: 350,
				type: 'area',
				toolbar: {
					show: false
				},
			},
			markers: {
				size: 4
			},
			colors: ['#ff4560', '#008ffb', '#00e396'],
			fill: {
				type: "gradient",
				gradient: {
					shadeIntensity: 1,
					opacityFrom: 0.3,
					opacityTo: 0.4,
					stops: [0, 90, 100]
				}
			},
			dataLabels: {
				enabled: false
			},
			stroke: {
				curve: 'smooth',
				width: 2
			},
			xaxis: {
				type: 'date',
				categories: allDates,
			},
			tooltip: {
				x: {
					format: 'dd/MM/yy'
				},
			}
		}).render();
	});
</script>
@endsection