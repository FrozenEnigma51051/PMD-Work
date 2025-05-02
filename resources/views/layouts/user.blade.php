@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <div class="d-flex align-items-center">
            <div class="me-2" style="width: 40px; height: 40px; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center; border-radius: 4px;">
                <!-- Logo placeholder -->
                <i class="bi bi-cloud"></i>
            </div>
            <a class="navbar-brand" href="{{ route('user.dashboard') }}">Pakistan Meteorological Department</a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('user.dashboard') }}" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.profile.edit') }}" class="nav-link">Profile</a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn nav-link" type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main>
    @yield('dashboard-content')
</main>
@endsection
