@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Admin OTP Verification') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="alert alert-info" role="alert">
                        <i class="fas fa-info-circle"></i>
                        We've sent a 6-digit verification code to <strong>{{ $email }}</strong>. 
                        Please check your email and enter the code below.
                    </div>

                    <form method="POST" action="{{ route('admin.otp.verify') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="otp" class="form-label">{{ __('Verification Code') }}</label>
                                <input id="otp" type="text" class="form-control text-center @error('otp') is-invalid @enderror" 
                                       name="otp" value="{{ old('otp') }}" required autocomplete="off" 
                                       placeholder="Enter 6-digit code" maxlength="6" pattern="[0-9]{6}"
                                       style="font-size: 1.5rem; letter-spacing: 0.5rem;">

                                @error('otp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Verify OTP') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <hr>

                    <div class="text-center">
                        <p class="mb-2">Didn't receive the code?</p>
                        <form method="POST" action="{{ route('admin.otp.resend') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link p-0" style="text-decoration: underline;">
                                Send a new code
                            </button>
                        </form>
                    </div>

                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}" class="btn btn-secondary">
                            Back to Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto-focus on OTP input
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('otp').focus();
    });

    // Auto-submit when 6 digits are entered
    document.getElementById('otp').addEventListener('input', function(e) {
        if (e.target.value.length === 6) {
            // Small delay to ensure the last digit is processed
            setTimeout(function() {
                e.target.form.submit();
            }, 100);
        }
    });

    // Only allow numbers
    document.getElementById('otp').addEventListener('keypress', function(e) {
        if (!/[0-9]/.test(e.key) && e.key !== 'Backspace' && e.key !== 'Delete' && e.key !== 'Tab') {
            e.preventDefault();
        }
    });
</script>
@endsection 