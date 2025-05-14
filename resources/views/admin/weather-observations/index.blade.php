@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between mb-4">
        <div class="col-md-6">
            <h2>Weather Observations</h2>
        </div>
        <div class="col-md-6 text-end">
            <div class="btn-group" role="group">
                <a href="{{ route('admin.weather-observations.index', ['status' => 'pending']) }}" 
                   class="btn {{ $status === 'pending' ? 'btn-primary' : 'btn-outline-primary' }}">
                    Pending <span class="badge bg-light text-dark">{{ $pendingCount }}</span>
                </a>
                <a href="{{ route('admin.weather-observations.index', ['status' => 'approved']) }}" 
                   class="btn {{ $status === 'approved' ? 'btn-success' : 'btn-outline-success' }}">
                    Approved <span class="badge bg-light text-dark">{{ $approvedCount }}</span>
                </a>
                <a href="{{ route('admin.weather-observations.index', ['status' => 'archived']) }}" 
                   class="btn {{ $status === 'archived' ? 'btn-secondary' : 'btn-outline-secondary' }}">
                    Archived <span class="badge bg-light text-dark">{{ $archivedCount }}</span>
                </a>
                <a href="{{ route('admin.weather-observations.index', ['status' => 'flagged']) }}" 
                   class="btn {{ $status === 'flagged' ? 'btn-danger' : 'btn-outline-danger' }}">
                    Flagged <span class="badge bg-light text-dark">{{ $flaggedCount }}</span>
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">{{ ucfirst($status) }} Observations</h5>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($observations->isEmpty())
                <div class="alert alert-info">
                    No {{ strtolower($status) }} weather observations found.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date & Time</th>
                                <th>Location</th>
                                <th>Submitted By</th>
                                <th>Weather Types</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($observations as $observation)
                                <tr>
                                    <td>{{ $observation->id }}</td>
                                    <td>{{ $observation->event_date->format('Y-m-d') }} {{ $observation->event_time }}</td>
                                    <td>{{ $observation->location_city }}, {{ $observation->location_state }}</td>
                                    <td>{{ $observation->user_name }} ({{ $observation->designation }})</td>
                                    <td>
                                        @foreach($observation->weather_types as $type)
                                            <span class="badge bg-primary">{{ $type }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $observation->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.weather-observations.show', $observation) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $observations->appends(['status' => $status])->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 