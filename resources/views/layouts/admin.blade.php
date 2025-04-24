@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Panel</a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link">Users</a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn nav-link text-white" type="submit">Logout</button>
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
