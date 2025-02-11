@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
<script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Account Settings /</span> Account
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
        <h5 class="card-header">
            Profile Details
            <span class="badge">
                @if(session('status'))
                    <div class="alert alert-success">
                        <span><i class='bx bx-check'></i></span>{{ session('status') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger">
                        <span><i class='bx bx-x' ></i></span>{{ session('error') }}
                    </div>
                @endif
            </span>
        </h5>


      <!-- Account -->
      <div class="card-body">
        <form method="POST" enctype="multipart/form-data" id="profileForm">
            @csrf
            <!-- Your existing form fields -->
            <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img src="/uploads/profile/{{ $user->profile_img }}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                <div class="button-wrapper">
                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                        <span class="d-none d-sm-block">Upload new photo</span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                        <input type="file" id="upload" name="uploadImg" class="account-file-input" hidden accept="image/png, image/jpeg" />
                    </label>
                    <!-- Your existing buttons -->
                    <p class="text-muted mb-0">Allowed JPG PNG. Max size of 20MB</p>
                </div>
            </div>
            <!-- Remove the Save Changes button -->
        </form>
      </div>
      <hr class="my-0">
      <div class="card-body">
        <form method="POST" action="{{ route('update-account') }}">
            @csrf
            <div class="row">
                <div class="mb-3 col-md-6">
                <label for="firstName" class="form-label">Name</label>
                <input class="form-control" type="text" required maxlength="1000" id="name" name="name" value="{{ $user->name }}" autofocus />
                </div>
                <div class="mb-3 col-md-6">
                <label for="email" class="form-label">E-mail</label>
                <input class="form-control" type="email" required maxlength="1000" id="email" name="email" value="{{ $user->email }}" placeholder="enter your email" />
                </div>

                <div class="divider">
                    <div class="divider-text">
                    <i class="bx bx-buildings"></i>
                    </div>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="agn">Agency</label>
                    <select id="agn" name="agn" class="select2 form-select" required>
                        @foreach ($agns as $agn)
                            <option value="{{ $agn->id }}">{{ $agn->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="brn" class="form-label">Branch</label>
                    <select id="brn" name="brn" class="select2 form-select" required>
                        @foreach ($brns as $brn)
                            <option value="{{ $brn->id }}">{{ $brn->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="dpm" class="form-label">Department</label>
                    <select id="dpm" name="dpm" class="select2 form-select" required>
                        @foreach ($dpms as $dpm)
                            <option value="{{ $dpm->id }}">{{ $dpm->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 col-md-6">
                <label for="role" class="form-label">Role</label>
                <select id="role" name="role" class="select2 form-select" disabled>
                    <option value="0" selected>Admin</option>
                </select>
                </div>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
            </div>
        </form>
      </div>
      <!-- /Account -->
    </div>
  </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('upload').addEventListener('change', function () {
            var form = document.getElementById('profileForm');
            var formData = new FormData(form);

            $.ajax({
                type: 'POST',
                url: '{{ route('update-profile') }}',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
                        },
                success: function (response) {
                    // Handle the success response, if needed
                    console.log(response);
                    Swal.fire({
                        title: "Success!",
                        text: "Your work has been saved",
                        icon: "success"
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload()
                        }
                    });

                },
                error: function (error) {
                    // Handle the error response, if needed
                    console.error(error);
                    Swal.fire({
                        title: "Oops...",
                        text: "Something went wrong!",
                        icon: "error"
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload()
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
