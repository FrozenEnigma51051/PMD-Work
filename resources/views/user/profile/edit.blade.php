@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Edit Profile</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Profile Picture</h5>
                </div>
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

                    <form action="{{ route('user.profile.updateImage') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        
                        <div class="mb-3">
                            <label for="profile_image" class="form-label">Upload New Image</label>
                            <input type="file" class="form-control @error('profile_image') is-invalid @enderror" id="profile_image" name="profile_image" accept="image/*">
                            
                            @error('profile_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                            <div class="form-text">Recommended size: 300x300 pixels. Max 2MB.</div>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-cloud-upload"></i> Upload Image
                            </button>
                        </div>
                        
                        @if(auth()->user()->profile_image)
                            <div class="mt-3">
                                <form action="{{ route('user.profile.removeImage') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash"></i> Remove Image
                                    </button>
                                </form>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Personal Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.profile.update') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" value="{{ auth()->user()->username }}" disabled>
                                <div class="form-text">Username cannot be changed.</div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" value="{{ auth()->user()->email }}" disabled>
                                <div class="form-text">Email cannot be changed.</div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="personal_number" class="form-label">Personal Number</label>
                                <input type="text" class="form-control" id="personal_number" value="{{ auth()->user()->personal_number }}" disabled>
                                <input type="hidden" name="personal_number" value="{{ auth()->user()->personal_number }}">
                                <div class="form-text">Personal number cannot be changed.</div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" value="{{ auth()->user()->date_of_birth ? auth()->user()->date_of_birth->format('Y-m-d') : '' }}">
                                
                                @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="region_id" class="form-label">Region</label>
                                <select class="form-select" id="region_id" disabled>
                                    <option>{{ auth()->user()->region->name }}</option>
                                </select>
                                <input type="hidden" name="region_id" value="{{ auth()->user()->region_id }}">
                                <div class="form-text">Region cannot be changed.</div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="station_id" class="form-label">Station</label>
                                <select class="form-select" id="station_id" disabled>
                                    <option>{{ auth()->user()->station->name }}</option>
                                </select>
                                <input type="hidden" name="station_id" value="{{ auth()->user()->station_id }}">
                                <div class="form-text">Station cannot be changed.</div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="designation" class="form-label">Designation</label>
                                <select class="form-select" id="designation" disabled>
                                    <option>{{ auth()->user()->designation }}</option>
                                </select>
                                <input type="hidden" name="designation" value="{{ auth()->user()->designation }}">
                                <div class="form-text">Designation cannot be changed.</div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" disabled>
                                    <option>{{ auth()->user()->gender }}</option>
                                </select>
                                <input type="hidden" name="gender" value="{{ auth()->user()->gender }}">
                                <div class="form-text">Gender cannot be changed.</div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Bio / Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Tell us about yourself...">{{ auth()->user()->description }}</textarea>
                            
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                            <div class="form-text">Maximum 500 characters.</div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-counterclockwise"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection