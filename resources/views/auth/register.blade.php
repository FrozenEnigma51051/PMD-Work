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
                                    <option value="Director General" {{ old('designation') == 'Director General' ? 'selected' : '' }}>Director General</option>
                                    <option value="Chief Meteorologist" {{ old('designation') == 'Chief Meteorologist' ? 'selected' : '' }}>Chief Meteorologist</option>
                                    <option value="Director (Engineering) / Principal Engineer" {{ old('designation') == 'Director (Engineering) / Principal Engineer' ? 'selected' : '' }}>Director (Engineering) / Principal Engineer</option>
                                    <option value="Director / Principal Meteorologist" {{ old('designation') == 'Director / Principal Meteorologist' ? 'selected' : '' }}>Director / Principal Meteorologist</option>
                                    <option value="Senior Private Secretary" {{ old('designation') == 'Senior Private Secretary' ? 'selected' : '' }}>Senior Private Secretary</option>
                                    <option value="Deputy Director / Senior Meteorologist" {{ old('designation') == 'Deputy Director / Senior Meteorologist' ? 'selected' : '' }}>Deputy Director / Senior Meteorologist</option>
                                    <option value="Senior Programmer" {{ old('designation') == 'Senior Programmer' ? 'selected' : '' }}>Senior Programmer</option>
                                    <option value="Deputy Chief Administrative Officer" {{ old('designation') == 'Deputy Chief Administrative Officer' ? 'selected' : '' }}>Deputy Chief Administrative Officer</option>
                                    <option value="Sr. Electronic Engineer / Deputy Director (Engineering)" {{ old('designation') == 'Sr. Electronic Engineer / Deputy Director (Engineering)' ? 'selected' : '' }}>Sr. Electronic Engineer / Deputy Director (Engineering)</option>
                                    <option value="Administrative Officer" {{ old('designation') == 'Administrative Officer' ? 'selected' : '' }}>Administrative Officer</option>
                                    <option value="Meteorologist" {{ old('designation') == 'Meteorologist' ? 'selected' : '' }}>Meteorologist</option>
                                    <option value="Accounts Officer" {{ old('designation') == 'Accounts Officer' ? 'selected' : '' }}>Accounts Officer</option>
                                    <option value="Librarian" {{ old('designation') == 'Librarian' ? 'selected' : '' }}>Librarian</option>
                                    <option value="Security Officer" {{ old('designation') == 'Security Officer' ? 'selected' : '' }}>Security Officer</option>
                                    <option value="Electronics Engineer" {{ old('designation') == 'Electronics Engineer' ? 'selected' : '' }}>Electronics Engineer</option>
                                    <option value="Programmer" {{ old('designation') == 'Programmer' ? 'selected' : '' }}>Programmer</option>
                                    <option value="Assistant Meteorologist" {{ old('designation') == 'Assistant Meteorologist' ? 'selected' : '' }}>Assistant Meteorologist</option>
                                    <option value="Superintendent" {{ old('designation') == 'Superintendent' ? 'selected' : '' }}>Superintendent</option>
                                    <option value="Assistant Private Secretary" {{ old('designation') == 'Assistant Private Secretary' ? 'selected' : '' }}>Assistant Private Secretary</option>
                                    <option value="Assistant Programmer" {{ old('designation') == 'Assistant Programmer' ? 'selected' : '' }}>Assistant Programmer</option>
                                    <option value="Assistant Mechanical Engineer" {{ old('designation') == 'Assistant Mechanical Engineer' ? 'selected' : '' }}>Assistant Mechanical Engineer</option>
                                    <option value="Assistant Electronic Engineer" {{ old('designation') == 'Assistant Electronic Engineer' ? 'selected' : '' }}>Assistant Electronic Engineer</option>
                                    <option value="Head Draughtsman" {{ old('designation') == 'Head Draughtsman' ? 'selected' : '' }}>Head Draughtsman</option>
                                    <option value="Assistant Ministerial" {{ old('designation') == 'Assistant Ministerial' ? 'selected' : '' }}>Assistant Ministerial</option>
                                    <option value="Data Entry Operator" {{ old('designation') == 'Data Entry Operator' ? 'selected' : '' }}>Data Entry Operator</option>
                                    <option value="Meteorological Assistant" {{ old('designation') == 'Meteorological Assistant' ? 'selected' : '' }}>Meteorological Assistant</option>
                                    <option value="Stenotypist" {{ old('designation') == 'Stenotypist' ? 'selected' : '' }}>Stenotypist</option>
                                    <option value="Sub Engineer (Electronics)" {{ old('designation') == 'Sub Engineer (Electronics)' ? 'selected' : '' }}>Sub Engineer (Electronics)</option>
                                    <option value="Sub Engineer (Mechanical)" {{ old('designation') == 'Sub Engineer (Mechanical)' ? 'selected' : '' }}>Sub Engineer (Mechanical)</option>
                                    <option value="Mechanical Assistant" {{ old('designation') == 'Mechanical Assistant' ? 'selected' : '' }}>Mechanical Assistant</option>
                                    <option value="Draughtsman" {{ old('designation') == 'Draughtsman' ? 'selected' : '' }}>Draughtsman</option>
                                    <option value="Upper Division Clerk" {{ old('designation') == 'Upper Division Clerk' ? 'selected' : '' }}>Upper Division Clerk</option>
                                    <option value="Lower Division Clerk" {{ old('designation') == 'Lower Division Clerk' ? 'selected' : '' }}>Lower Division Clerk</option>
                                    <option value="Senior Observer" {{ old('designation') == 'Senior Observer' ? 'selected' : '' }}>Senior Observer</option>
                                    <option value="Observer" {{ old('designation') == 'Observer' ? 'selected' : '' }}>Observer</option>
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
            
            fetch(`/stations/by-region?region_id=${regionId}`)
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