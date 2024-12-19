<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link @if(!request()->routeIs('dashboard')) collapsed @endif" href="{{ route('dashboard') }}">
          <i class="bi bi-grid-fill"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      
      <li class="nav-heading">Data</li>
      
      <li class="nav-item">
        <a class="nav-link @if(!request()->routeIs('suppliers/*')) collapsed @endif" href="{{ route('suppliers.index') }}">
          <i class="bi bi-stack"></i>
          <span>Supplier</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link @if(!request()->routeIs('requests/*')) collapsed @endif" href="{{ route('requests.index') }}">
          <i class="bi bi-arrow-left-right"></i>
          <span>Request</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link @if(!request()->routeIs('users/*')) collapsed @endif" href="{{ route('users.index') }}">
          <i class="bi bi-person-lines-fill"></i>
          <span>User</span>
        </a>
      </li><!-- End Dashboard Nav -->

   

      <li class="nav-heading">Reports</li>

      <li class="nav-item">
        <a class="nav-link @if(!request()->routeIs('reports/*')) collapsed @endif" href="{{ route('reports.export') }}">
          <i class="bi bi-file-earmark-bar-graph-fill"></i>
          <span>Report Request</span>
        </a>
      </li><!-- End Profile Page Nav -->
    </ul>

  </aside><!-- End Sidebar-->