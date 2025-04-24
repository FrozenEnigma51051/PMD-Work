@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">{{ __('Register') }}</div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="personal_number" class="col-md-4 col-form-label text-md-end">{{ __('Personal Number') }}</label>

                            <div class="col-md-6">
                                <input id="personal_number" type="text" class="form-control @error('personal_number') is-invalid @enderror" name="personal_number" value="{{ old('personal_number') }}" required>

                                @error('personal_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="region_id" class="col-md-4 col-form-label text-md-end">{{ __('Region') }}</label>

                            <div class="col-md-6">
                                <select id="region_id" class="form-select @error('region_id') is-invalid @enderror" name="region_id" required>
                                    <option value="">-- Select Region --</option>
                                    @foreach($regions as $region)
                                        <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>
                                            {{ $region->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('region_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="station_id" class="col-md-4 col-form-label text-md-end">{{ __('Station') }}</label>

                            <div class="col-md-6">
                                <select id="station_id" class="form-select @error('station_id') is-invalid @enderror" name="station_id" required>
                                    <option value="">-- Select Station --</option>
                                </select>

                                @error('station_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="designation" class="col-md-4 col-form-label text-md-end">{{ __('Designation') }}</label>

                            <div class="col-md-6">
                                <select id="designation" class="form-select @error('designation') is-invalid @enderror" name="designation" required>
                                    <option value="">-- Select Designation --</option>
                                    <option value="Observer" {{ old('designation') == 'Observer' ? 'selected' : '' }}>Observer</option>
                                    <option value="Senior Observer" {{ old('designation') == 'Senior Observer' ? 'selected' : '' }}>Senior Observer</option>
                                </select>

                                @error('designation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select id="gender" class="form-select @error('gender') is-invalid @enderror" name="gender" required>
                                    <option value="">-- Select Gender --</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-6 offset-md-4">
                                <div class="alert alert-info">
                                    <small>Your account will need to be approved by an administrator before you can log in.</small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-0 row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const regionSelect = document.getElementById('region_id');
        const stationSelect = document.getElementById('station_id');
        
        // Function to fetch stations based on selected region
        function loadStations(regionId) {
            if (!regionId) {
                stationSelect.innerHTML = '<option value="">-- Select Station --</option>';
                return;
            }
            
            fetch(`/api/regions/${regionId}/stations`)
                .then(response => response.json())
                .then(stations => {
                    stationSelect.innerHTML = '<option value="">-- Select Station --</option>';
                    
                    stations.forEach(station => {
                        const option = document.createElement('option');
                        option.value = station.id;
                        option.textContent = station.name;
                        
                        // Set selected if it matches old value
                        if (station.id == {{ old('station_id') ? old('station_id') : 'null' }}) {
                            option.selected = true;
                        }
                        
                        stationSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error loading stations:', error));
        }
        
        // Initial load if region is selected
        if (regionSelect.value) {
            loadStations(regionSelect.value);
        }
        
        // Add event listener for region change
        regionSelect.addEventListener('change', function() {
            loadStations(this.value);
        });
    });
</script>
@endpush
@endsection