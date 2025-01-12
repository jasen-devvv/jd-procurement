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
        <a class="nav-link @if(!request()->is('dashboard/suppliers*')) collapsed @endif" href="{{ route('suppliers.index') }}">
          <i class="bi bi-stack"></i>
          <span>Supplier</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link @if(!request()->is('dashboard/products*')) collapsed @endif" href="{{ route('products.index') }}">
          <i class="bi bi-box-fill"></i>
          <span>Product</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link @if(!request()->is('dashboard/orders*')) collapsed @endif" href="{{ route('orders.index') }}">
          <i class="bi bi-arrow-left-right"></i>
          <span>Order</span>
        </a>
      </li><!-- End Dashboard Nav -->

      @role('admin')
      <li class="nav-item">
        <a class="nav-link @if(!request()->is('dashboard/users*')) collapsed @endif" href="{{ route('users.index') }}">
          <i class="bi bi-person-lines-fill"></i>
          <span>User</span>
        </a>
      </li><!-- End Dashboard Nav -->
      @endrole

      @role('admin')
      <li class="nav-heading">Reports</li>

      <li class="nav-item">
        <a class="nav-link @if(!request()->is('dashboard/reports*')) collapsed @endif" href="{{ route('reports') }}">
          <i class="bi bi-file-earmark-bar-graph-fill"></i>
          <span>Report Monthly</span>
        </a>
      </li><!-- End Profile Page Nav --> 
      @endrole
    </ul>

  </aside><!-- End Sidebar-->