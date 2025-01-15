@extends('template.main')

@section('breadcrumbs')
<div class="pagetitle">
    <h1>Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Profile</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection

@section('content')
<section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="{{ asset('img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
            <h2>{{ auth()->user()->username }}</h2>
            <h3>{{ auth()->user()->roles[0]->name }}</h3>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link {{ $activeTab == 'profile-overview' ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

              <li class="nav-item">
                <button class="nav-link {{ $activeTab == 'profile-edit' ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>

              <li class="nav-item">
                <button class="nav-link {{ $activeTab == 'profile-change-password' ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
              </li>

            </ul>

            <div class="tab-content pt-2">
           

              <div class="tab-pane fade {{ $activeTab == 'profile-overview' ? 'show active' : '' }} profile-overview" id="profile-overview">
                <h5 class="card-title">About</h5>
                <p class="small fst-italic">{{ $profile->about ?? '' }}</p>

                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Full Name</div>
                  <div class="col-lg-9 col-md-8">{{ $profile->name ?? "" }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Gender</div>
                  <div class="col-lg-9 col-md-8">{{ $profile->gender ?? "" }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Phone</div>
                  <div class="col-lg-9 col-md-8">{{ $profile->phone ?? "" }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Address</div>
                  <div class="col-lg-9 col-md-8">{{ $profile->address ?? ""  }}</div>
                </div>

              </div>

              <div class="tab-pane fade {{ $activeTab == 'profile-edit' ? 'show active' : '' }} profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form method="POST" action="{{ route('profile.update') }}">
                  @csrf
                  @method('PUT')
                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input type="text" name="name" class="form-control" id="fullName" placeholder="Full name" value="{{ $profile->name ?? '' }}">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                    <div class="col-md-8 col-lg-9">
                      <textarea name="about" class="form-control" id="about" style="height: 100px" placeholder="About you">{{ $profile->about ?? '' }}</textarea>
                    </div>
                  </div>

                  <fieldset class="row mb-3">
                    <legend class="col-form-label col-md-4 col-lg-3">Gender</legend>
                    <div class="col-md-8 col-lg-9">
                    @foreach($genders as $gender)
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="{{ $gender->name }}" value="{{ $gender->value }}" @if($profile?->gender?->name == $gender->name) checked @endif>
                        <label class="form-check-label" for="{{ $gender->name }}">
                          {{ $gender->name }}
                        </label>
                      </div>
                    @endforeach
                    </div>
                  </fieldset>

                  <div class="row mb-3">
                    <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="phone" type="text" class="form-control" id="phone" placeholder="Your phone" value="{{ $profile->phone ?? '' }}">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                    <div class="col-md-8 col-lg-9">
                      <textarea name="address" class="form-control" id="address" style="height: 100px" placeholder="Your address">{{ $profile->address ?? '' }}</textarea>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

              <div class="tab-pane fade {{ $activeTab == 'profile-change-password' ? 'show active' : '' }} pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form method="POST" action={{ route('profile.change_password') }}>
                  @csrf
                  @method("PUT")
                  <div class="row mb-3">
                    <div class="col-md-4 col-lg-3">
                      <label for="oldPassword" class="col-form-label">Old Password</label>
                    </div>
                    <div class="col-md-8 col-lg-9">
                      <div class="input-group has-validation">
                        <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="oldPassword" placeholder="enter your current password">
                        <span class="input-group-text password-toggle"><i class="bi bi-eye-slash-fill"></i></span>
                        @error('old_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-4 col-lg-3">
                      <label for="newPassword" class="col-form-label">New Password</label>
                    </div>
                    <div class="col-md-8 col-lg-9">
                      <div class="input-group has-validation">
                        <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="newPassword" placeholder="enter your new password">
                        <span class="input-group-text password-toggle"><i class="bi bi-eye-slash-fill"></i></span>
                        @error('new_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-4 col-lg-3">
                      <label for="renewPassword" class="col-form-label">Re-enter New Password</label>
                    </div>
                    <div class="col-md-8 col-lg-9">
                      <div class="input-group has-validation">
                        <input type="password" name="new_password_confirmation" class="form-control @error('new_password_confirmation') is-invalid @enderror" id="renewPassword" placeholder="re-enter new password">
                        <span class="input-group-text password-toggle"><i class="bi bi-eye-slash-fill"></i></span>
                        @error('new_password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                  </div>
                </form><!-- End Change Password Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>
@endsection