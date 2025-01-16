@extends('template.main')

@section('breadcrumbs')
<div class="pagetitle">
    <h1>Data User</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item active">User</li>
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
            <h5 class="card-title">Users <a class="btn btn-success" href="{{ route('users.create') }}">Add <i class="bi bi-plus"></i></a></h5>
            <div class="alert alert-warning"><b>Note</b>: Password cannot be displayed and changed, it can only be updated.</div>

            <!-- Table with stripped rows -->
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover datatable">
                <thead>
                  <tr>
                    <th width="10%">No.</th>
                    <th width="30%">
                      <b>U</b>sername
                    </th>
                    <th width="30%">Email</th>
                    <th width="10%">Role</th>
                    <th width="10%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as $user)
                      <tr>
                          <td>{{ $loop->iteration }}.</td>
                          <td>{{ $user->username }}</td>
                          <td class="text-primary">{{ $user->email }}</td>
                          <td>
                            @foreach($user->roles as $role)
                              @if($role->name == 'admin')
                                <span class="badge bg-primary text-uppercase">{{ $role->name }}</span>
                              @elseif($role->name == 'staff')
                                <span class="badge bg-success text-uppercase">{{ $role->name }}</span>
                              @endif
                            @endforeach
                          </td>
                          <td>
                              <div class="btn-group" role="group" aria-label="Action button">
                                  <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                                  <form id="deleteForm" action="{{ route('users.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger btn-delete d-inline rounded-0 rounded-end">Delete</button>
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