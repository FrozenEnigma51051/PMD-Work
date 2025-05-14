@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>Weather Observation Details</h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.weather-observations.index', ['status' => $observation->status]) }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <!-- Observation Details -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Observation #{{ $observation->id }}</h3>
                    <span class="badge 
                        @if($observation->status == 'pending') bg-primary 
                        @elseif($observation->status == 'approved') bg-success 
                        @elseif($observation->status == 'archived') bg-secondary 
                        @elseif($observation->status == 'flagged') bg-danger 
                        @endif">
                        {{ ucfirst($observation->status) }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h4>Event Information</h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span class="fw-bold">Event Date:</span>
                                    <span>{{ $observation->event_date->format('Y-m-d') }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span class="fw-bold">Event Time:</span>
                                    <span>{{ $observation->event_time }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span class="fw-bold">Location:</span>
                                    <span>{{ $observation->location_city }}, {{ $observation->location_state }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span class="fw-bold">Time Zone:</span>
                                    <span>{{ $observation->time_zone }}</span>
                                </li>
                                <li class="list-group-item">
                                    <span class="fw-bold">Coordinates:</span>
                                    <span>{{ $observation->latitude }}, {{ $observation->longitude }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4>Submitter Information</h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span class="fw-bold">Name:</span>
                                    <span>{{ $observation->user_name }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span class="fw-bold">Personal Number:</span>
                                    <span>{{ $observation->personal_number }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span class="fw-bold">Designation:</span>
                                    <span>{{ $observation->designation }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span class="fw-bold">Submitted On:</span>
                                    <span>{{ $observation->created_at->format('Y-m-d H:i') }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h4>Weather Phenomena</h4>
                            <div class="mb-3">
                                @foreach($observation->weather_types as $type)
                                    <span class="badge bg-primary p-2 mb-1">{{ str_replace('_', ' ', ucfirst($type)) }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h4>Damages Reported</h4>
                            <div class="mb-3">
                                @if(is_array($observation->damages) && count($observation->damages) > 0)
                                    <ul class="list-group">
                                        @foreach($observation->damages as $key => $damage)
                                            @if($key !== 'other_damage_details')
                                                <li class="list-group-item">{{ str_replace('_', ' ', ucfirst($damage)) }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    
                                    @if(isset($observation->damages['other_damage_details']))
                                        <div class="mt-3">
                                            <h5>Other Damage Details:</h5>
                                            <p>{{ $observation->damages['other_damage_details'] }}</p>
                                        </div>
                                    @endif
                                @else
                                    <p>No damages reported</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h4>Event Description</h4>
                            <div class="card">
                                <div class="card-body">
                                    {{ $observation->event_description ?? 'No description provided' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(is_array($observation->media_files) && count($observation->media_files) > 0)
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h4>Media Files</h4>
                                <div class="row">
                                    @foreach($observation->media_files as $media)
                                        <div class="col-md-4 mb-3">
                                            @php
                                                $extension = pathinfo($media, PATHINFO_EXTENSION);
                                                $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                                            @endphp
                                            
                                            @if($isImage)
                                                <a href="{{ asset('storage/' . $media) }}" target="_blank">
                                                    <img src="{{ asset('storage/' . $media) }}" class="img-fluid rounded" alt="Media">
                                                </a>
                                            @else
                                                <a href="{{ asset('storage/' . $media) }}" class="btn btn-outline-primary" target="_blank">
                                                    <i class="bi bi-file-earmark-play"></i> View Video
                                                </a>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if($observation->status === 'flagged' && $observation->flag_reason)
                <div class="card mb-4 border-danger">
                    <div class="card-header bg-danger text-white">
                        <h4 class="mb-0">Flag Reason</h4>
                    </div>
                    <div class="card-body">
                        {{ $observation->flag_reason }}
                    </div>
                </div>
            @endif
        </div>

        <div class="col-md-4">
            <!-- Action Panel -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="mb-0">Actions</h4>
                </div>
                <div class="card-body">
                    @if($observation->status === 'pending')
                        <form action="{{ route('admin.weather-observations.approve', $observation) }}" method="POST" class="mb-3">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success btn-lg w-100">
                                <i class="bi bi-check-circle"></i> Approve Observation
                            </button>
                        </form>
                    @endif

                    @if($observation->status !== 'archived')
                        <form action="{{ route('admin.weather-observations.archive', $observation) }}" method="POST" class="mb-3">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-secondary btn-lg w-100">
                                <i class="bi bi-archive"></i> Archive Observation
                            </button>
                        </form>
                    @endif

                    @if($observation->status !== 'flagged')
                        <button type="button" class="btn btn-danger btn-lg w-100" data-bs-toggle="modal" data-bs-target="#flagModal">
                            <i class="bi bi-flag"></i> Flag Observation
                        </button>
                    @endif
                </div>
            </div>

            <!-- Map Card -->
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Location Map</h4>
                </div>
                <div class="card-body">
                    <div id="map" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Flag Modal -->
<div class="modal fade" id="flagModal" tabindex="-1" aria-labelledby="flagModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.weather-observations.flag', $observation) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title" id="flagModalLabel">Flag Observation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="flag_reason" class="form-label">Reason for Flagging</label>
                        <textarea class="form-control" id="flag_reason" name="flag_reason" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Flag Observation</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&callback=initMap" async defer></script>
<script>
    function initMap() {
        const lat = {{ $observation->latitude }};
        const lng = {{ $observation->longitude }};
        const location = { lat: lat, lng: lng };
        
        const map = new google.maps.Map(document.getElementById("map"), {
            center: location,
            zoom: 13,
        });
        
        const marker = new google.maps.Marker({
            position: location,
            map: map,
            title: "Weather Event Location",
        });
    }
</script>
@endsection 