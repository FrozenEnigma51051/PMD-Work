@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Dashboard</h3>
                    <a href="{{ route('weather.observation.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> New Weather Observation
                    </a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($observations->isEmpty())
                        <div class="alert alert-info">
                            No weather observations found. Click the "New Weather Observation" button to create one.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Date & Time</th>
                                        <th>Location</th>
                                        <th>Weather Types</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($observations as $observation)
                                        <tr>
                                            <td>{{ $observation->event_date->format('Y-m-d') }} {{ $observation->event_time }}</td>
                                            <td>{{ $observation->location_city }}, {{ $observation->location_state }}</td>
                                            <td>
                                                @foreach($observation->weather_types as $type)
                                                    <span class="badge bg-primary">{{ $type }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ Str::limit($observation->event_description, 50) }}</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 