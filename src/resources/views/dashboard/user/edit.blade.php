@extends('template.main')

@section('breadcrumbs')
<div class="pagetitle">
    <h1>Data Users</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item">User</li>
        <li class="breadcrumb-item active">Edit</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection

@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-6">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Form Edit User</h5>

            <form id="formSupplier" action="{{ route('users.update', $user->id) }}" method="POST" class="row g-3 needs-validation @if($errors->any()) was-validated @endif" novalidate>
                @csrf
                @method('PUT')
                <div class="col-12 required">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" value="{{ $user->name }}" name="name" id="name" placeholder="Jasen" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 required">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" value="{{ $user->email }}" id="email" name="email" placeholder="test@example.com" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                  <label for="password" class="form-label">New Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="********">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @role('admin')
                <div class="col-12 required">
                  <label for="role" class="form-label">Role</label>
                  <select class="form-select" name="role" aria-label="Select Role" required>
                    <option value="" selected>-- Choose Role --</option>
                    @foreach($roles as $role)
                      <option value="{{ $role->name }}" @if($user->hasRole($role->name)) selected @endif>{{ $role->name }}</option>
                    @endforeach
                  </select>
                    @error('role')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @endrole

                <div class="col-12">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection