@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('user.dashboard') }}">{{ config('app.name', 'Laravel') }}</a>
        <div class="collapse navbar-collapse justify-content-end">
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
    @yield('content')
</main>
@endsection
