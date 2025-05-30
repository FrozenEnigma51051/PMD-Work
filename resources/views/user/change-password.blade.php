@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <a href="{{ route('user.dashboard') }}" class="btn btn-outline-light btn-sm me-3">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                    <h5 class="mb-0">Change Password</h5>
                </div>

                <div class="card-body p-4">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="alert alert-info mb-4" role="alert">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        <strong>Password Requirements:</strong>
                        <ul class="mt-2 mb-0">
                            <li>At least 8 characters long</li>
                            <li>Must contain uppercase and lowercase letters</li>
                            <li>Must contain at least one number</li>
                            <li>Must contain at least one special character</li>
                        </ul>
                    </div>

                    <form method="POST" action="{{ route('user.password.change') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="current_password" class="form-label">
                                <i class="bi bi-lock-fill me-2"></i>Current Password
                            </label>
                            <input id="current_password" 
                                   type="password" 
                                   class="form-control @error('current_password') is-invalid @enderror" 
                                   name="current_password" 
                                   required 
                                   autofocus>

                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">
                                <i class="bi bi-key-fill me-2"></i>New Password
                            </label>
                            <input id="password" 
                                   type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" 
                                   required>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">
                                <i class="bi bi-key-fill me-2"></i>Confirm New Password
                            </label>
                            <input id="password_confirmation" 
                                   type="password" 
                                   class="form-control" 
                                   name="password_confirmation" 
                                   required>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary me-md-2">
                                <i class="bi bi-x-circle me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Change Password
                            </button>
                        </div>
                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        <p class="text-muted mb-2">
                            <strong>Forgot your password?</strong>
                        </p>
                        <p class="small text-muted mb-3">
                            If you can't remember your current password, you can use the password reset option below. 
                            This will log you out and send a reset link to your email.
                        </p>
                        <a href="{{ route('password.request') }}" class="btn btn-outline-warning btn-sm">
                            <i class="bi bi-envelope me-2"></i>Reset Password via Email
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 