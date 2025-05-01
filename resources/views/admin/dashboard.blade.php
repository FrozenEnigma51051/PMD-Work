@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Admin Dashboard</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Users</h5>
                            <h2 class="mb-0">{{ $total_users }}</h2>
                        </div>
                        <i class="bi bi-people fs-1"></i>
                    </div>
                </div>
                <div class="card-footer bg-primary border-top-0">
                    <a href="{{ route('admin.users.index') }}" class="text-white text-decoration-none">View All</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-warning text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Pending Approvals</h5>
                            <h2 class="mb-0">{{ $pending_users }}</h2>
                        </div>
                        <i class="bi bi-person-exclamation fs-1"></i>
                    </div>
                </div>
                <div class="card-footer bg-warning border-top-0">
                    <a href="{{ route('admin.users.index', ['status' => 'inactive']) }}" class="text-white text-decoration-none">View Pending</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Active Users</h5>
                            <h2 class="mb-0">{{ $active_users }}</h2>
                        </div>
                        <i class="bi bi-person-check fs-1"></i>
                    </div>
                </div>
                <div class="card-footer bg-success border-top-0">
                    <a href="{{ route('admin.users.index', ['status' => 'active']) }}" class="text-white text-decoration-none">View Active</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Recent Registration Requests</h5>
                </div>
                <div class="card-body">
                    @if($recent_inactive_users->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Region</th>
                                        <th>Station</th>
                                        <th>Registered</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recent_inactive_users as $user)
                                        <tr>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->region->name }}</td>
                                            <td>{{ $user->station->name }}</td>
                                            <td>{{ $user->created_at->diffForHumans() }}</td>
                                            <td>
                                                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye"></i> View
                                                </a>
                                                <form action="{{ route('admin.users.approve', $user) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="bi bi-check-circle"></i> Approve
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-end mt-3">
                            <a href="{{ route('admin.users.index', ['status' => 'inactive']) }}" class="btn btn-primary">View All Pending</a>
                        </div>
                    @else
                        <div class="alert alert-info mb-0">
                            <i class="bi bi-info-circle me-2"></i> No pending registration requests.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Users by Region</h5>
                </div>
                <div class="card-body">
                    <canvas id="regionChart"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0">Users by Designation</h5>
                </div>
                <div class="card-body">
                    <canvas id="designationChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Region Chart
        const regionCtx = document.getElementById('regionChart').getContext('2d');
        new Chart(regionCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($region_stats->pluck('name')) !!},
                datasets: [{
                    data: {!! json_encode($region_stats->pluck('count')) !!},
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                    ],
                    borderWidth: 1
                }]
            },
        });
        
        // Designation Chart
        const designationCtx = document.getElementById('designationChart').getContext('2d');
        new Chart(designationCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($designation_stats->pluck('designation')) !!},
                datasets: [{
                    label: 'Users',
                    data: {!! json_encode($designation_stats->pluck('count')) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });
    });
</script>
@endpush
@endsection