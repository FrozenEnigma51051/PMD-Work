@extends('layouts.app')

@section('content')
<div class="container py-4">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Dashboard</h1>
            <p class="text-muted">Welcome back, {{ auth()->user()->username }}!</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('user.profile.edit') }}" class="btn btn-primary">
                <i class="bi bi-person-gear"></i> Edit Profile
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        @if(auth()->user()->profile_image)
                            <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="{{ auth()->user()->username }}" class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center bg-light text-primary" style="width: 150px; height: 150px; font-size: 3rem;">
                                {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    
                    <h4 class="mb-1">{{ auth()->user()->username }}</h4>
                    <p class="text-muted mb-3">{{ auth()->user()->designation }}</p>
                    
                    <div class="badge bg-primary mb-3">{{ auth()->user()->region->name }} - {{ auth()->user()->station->name }}</div>
                    
                    @if(auth()->user()->description)
                        <p>{{ auth()->user()->description }}</p>
                    @endif
                </div>
                <div class="card-footer bg-white">
                    <div class="small text-muted text-center">
                        Member since {{ auth()->user()->created_at->format('M d, Y') }}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card shadow h-100 border-primary">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                                    <i class="bi bi-geo-alt fs-4 text-primary"></i>
                                </div>
                                <h5 class="card-title mb-0">Your Station</h5>
                            </div>
                            <h4>{{ auth()->user()->station->name }}</h4>
                            <p class="text-muted">{{ auth()->user()->region->name }} Region</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-4">
                    <div class="card shadow h-100 border-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                                    <i class="bi bi-person-workspace fs-4 text-success"></i>
                                </div>
                                <h5 class="card-title mb-0">Your Role</h5>
                            </div>
                            <h4>{{ auth()->user()->designation }}</h4>
                            <p class="text-muted">Personal Number: {{ auth()->user()->personal_number }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Quick Links</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-grid">
                                <a href="{{ route('user.profile.edit') }}" class="btn btn-outline-primary btn-lg">
                                    <i class="bi bi-person-gear fs-5 me-2"></i>
                                    Update Profile
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-grid">
                                <a href="{{ route('user.password.change.form') }}" class="btn btn-outline-secondary btn-lg">
                                    <i class="bi bi-key fs-5 me-2"></i>
                                    Change Password
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-grid">
                                <a href="{{ route('weather.observation.create') }}" class="btn btn-outline-success btn-lg">
                                    <i class="bi bi-cloud-sun fs-5 me-2"></i>
                                    Weather Observation Form
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-grid">
                                <a href="{{ route('weather.observations') }}" class="btn btn-outline-info btn-lg">
                                    <i class="bi bi-table fs-5 me-2"></i>
                                    View Weather Reports
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Account Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <p class="text-muted mb-0">Email Address</p>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0 fw-medium">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <p class="text-muted mb-0">Personal Number</p>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0 fw-medium">{{ auth()->user()->personal_number }}</p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <p class="text-muted mb-0">Gender</p>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0 fw-medium">{{ auth()->user()->gender }}</p>
                        </div>
                    </div>
                    
                    @if(auth()->user()->date_of_birth)
                        <hr>
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <p class="text-muted mb-0">Date of Birth</p>
                            </div>
                            <div class="col-md-8">
                                <p class="mb-0 fw-medium">{{ auth()->user()->date_of_birth->format('F d, Y') }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection