@extends('layouts.admin')

@section('admin-content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>User Details</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to Users
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <div class="position-relative mb-3">
                        @if($user->profile_image)
                            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->username }}" class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center bg-light text-primary" style="width: 150px; height: 150px; font-size: 3rem;">
                                {{ strtoupper(substr($user->username, 0, 1)) }}
                            </div>
                        @endif
                        
                        @if($user->status === 'active')
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                <i class="bi bi-check-lg"></i>
                            </span>
                        @else
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">
                                <i class="bi bi-clock"></i>
                            </span>
                        @endif
                    </div>
                    
                    <h3 class="mb-1">{{ $user->username }}</h3>
                    <p class="text-muted mb-3">{{ $user->designation }}</p>
                    
                    @if($user->status === 'inactive')
                        <form action="{{ route('admin.users.approve', $user) }}" method="POST" class="mb-3">
                            @csrf
                            <button type="submit" class="btn btn-success btn-lg w-100">
                                <i class="bi bi-check-circle"></i> Approve User
                            </button>
                        </form>
                    @else
                        <div class="alert alert-success mb-3">
                            <i class="bi bi-check-circle"></i> User is active
                        </div>
                    @endif
                    
                    <div class="d-grid gap-2">
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100" onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                <i class="bi bi-trash"></i> Delete User
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="card-footer bg-white">
                    <div class="small text-muted">
                        <div class="d-flex justify-content-between">
                            <span>Registered:</span>
                            <span>{{ $user->created_at->format('M d, Y') }}</span>
                        </div>
                        
                        @if($user->status === 'active')
                            <div class="d-flex justify-content-between">
                                <span>Approved:</span>
                                <span>{{ $user->updated_at->format('M d, Y') }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0">User Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <p class="text-muted mb-0">Email Address</p>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0 fw-medium">{{ $user->email }}</p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <p class="text-muted mb-0">Personal Number</p>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0 fw-medium">{{ $user->personal_number }}</p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <p class="text-muted mb-0">Region</p>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0 fw-medium">{{ $user->region->name }}</p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <p class="text-muted mb-0">Station</p>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0 fw-medium">{{ $user->station->name }}</p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <p class="text-muted mb-0">Designation</p>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0 fw-medium">{{ $user->designation }}</p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <p class="text-muted mb-0">Gender</p>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0 fw-medium">{{ $user->gender }}</p>
                        </div>
                    </div>
                    
                    @if($user->date_of_birth)
                        <hr>
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <p class="text-muted mb-0">Date of Birth</p>
                            </div>
                            <div class="col-md-8">
                                <p class="mb-0 fw-medium">{{ $user->date_of_birth->format('F d, Y') }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($user->description)
                        <hr>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <p class="text-muted mb-0">Description</p>
                            </div>
                            <div class="col-md-8">
                                <p class="mb-0">{{ $user->description }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Activity Log</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="mb-0"><i class="bi bi-person-plus text-success me-2"></i> User registered</p>
                                </div>
                                <div>
                                    <span class="text-muted">{{ $user->created_at->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                        </li>
                        
                        @if($user->status === 'active')
                            <li class="list-group-item px-0">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="mb-0"><i class="bi bi-check-circle text-primary me-2"></i> Account approved</p>
                                    </div>
                                    <div>
                                        <span class="text-muted">{{ $user->updated_at->format('M d, Y H:i') }}</span>
                                    </div>
                                </div>
                            </li>
                        @endif
                        
                        @if($user->profile_image)
                            <li class="list-group-item px-0">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="mb-0"><i class="bi bi-image text-info me-2"></i> Profile image uploaded</p>
                                    </div>
                                    <div>
                                        <span class="text-muted">{{ $user->updated_at->format('M d, Y H:i') }}</span>
                                    </div>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection