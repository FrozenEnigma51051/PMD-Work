@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>User Management</h1>
        </div>
        <div class="col-md-4 text-end">
            <div class="btn-group" role="group">
                <a href="{{ route('admin.users.index') }}" class="btn {{ request()->input('status') === null ? 'btn-primary' : 'btn-outline-primary' }}">
                    All Users
                </a>
                <a href="{{ route('admin.users.index', ['status' => 'active']) }}" class="btn {{ request()->input('status') === 'active' ? 'btn-primary' : 'btn-outline-primary' }}">
                    Active
                </a>
                <a href="{{ route('admin.users.index', ['status' => 'inactive']) }}" class="btn {{ request()->input('status') === 'inactive' ? 'btn-primary' : 'btn-outline-primary' }}">
                    Pending
                </a>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-white p-3">
            <div class="row">
                <div class="col-md-8">
                    <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex">
                        <input type="hidden" name="status" value="{{ request()->input('status') }}">
                        <input type="text" name="search" class="form-control me-2" placeholder="Search by username, email or personal number" value="{{ request()->input('search') }}">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Filter
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                                <li><h6 class="dropdown-header">Region</h6></li>
                                @foreach($regions as $region)
                                    <li>
                                        <a class="dropdown-item {{ request()->input('region_id') == $region->id ? 'active' : '' }}" href="{{ route('admin.users.index', array_merge(request()->except('page'), ['region_id' => $region->id])) }}">
                                            {{ $region->name }}
                                        </a>
                                    </li>
                                @endforeach
                                <li><hr class="dropdown-divider"></li>
                                <li><h6 class="dropdown-header">Designation</h6></li>
                                <li>
                                    <a class="dropdown-item {{ request()->input('designation') == 'Observer' ? 'active' : '' }}" href="{{ route('admin.users.index', array_merge(request()->except('page'), ['designation' => 'Observer'])) }}">
                                        Observer
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->input('designation') == 'Senior Observer' ? 'active' : '' }}" href="{{ route('admin.users.index', array_merge(request()->except('page'), ['designation' => 'Senior Observer'])) }}">
                                        Senior Observer
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.users.index', ['status' => request()->input('status')]) }}">
                                        Clear Filters
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Personal Number</th>
                            <th>Region</th>
                            <th>Station</th>
                            <th>Designation</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->personal_number }}</td>
                                <td>{{ $user->region->name }}</td>
                                <td>{{ $user->station->name }}</td>
                                <td>{{ $user->designation }}</td>
                                <td>
                                    @if($user->status === 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        
                                        @if($user->status === 'inactive')
                                            <form action="{{ route('admin.users.approve', $user) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    <i class="bi bi-check-lg"></i>
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-4">
                                    <div class="alert alert-info mb-0">
                                        No users found matching your criteria.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($users->hasPages())
            <div class="card-footer bg-white">
                {{ $users->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // For Bootstrap 5 tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endpush
@endsection