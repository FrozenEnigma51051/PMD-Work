<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
            <div class="container-fluid">
                @auth
                    <!-- Sidebar toggle button for authenticated users - moved more to the left -->
                    <button class="btn btn-outline-secondary me-2" type="button" id="sidebarToggle">
                        <i class="bi bi-list"></i>
                    </button>
                @endauth

                <!-- Logo and brand name - moved more to the left -->
                <a class="navbar-brand d-flex align-items-center me-auto" href="{{ auth()->check() ? (auth()->user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard')) : url('/') }}">
                    <div class="me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 4px;">
                        <img src="{{ asset('images/pmd-logo.png') }}" alt="PMD Logo" style="width: 38px; height: 38px; object-fit: contain;">
                    </div>
                    <span class="fw-bold">Pakistan Meteorological Department</span>
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <!-- Guest navigation (non-authenticated users) -->
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">Login</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="btn btn-primary ms-2">Signup</a>
                            </li>
                        @else
                            <!-- Authenticated user - only profile dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    @if(auth()->user()->profile_image)
                                        <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profile" class="rounded-circle me-2" style="width: 32px; height: 32px; object-fit: cover;">
                                    @else
                                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                            <i class="bi bi-person-fill text-white"></i>
                                        </div>
                                    @endif
                                    {{ auth()->user()->username }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('user.profile.edit') }}">
                                            <i class="bi bi-person-gear"></i> Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('user.password.change.form') }}">
                                            <i class="bi bi-key"></i> Change Password
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="dropdown-item text-danger" type="submit">
                                                <i class="bi bi-box-arrow-right"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Sidebar for authenticated users -->
        @auth
        <div id="sidebar" class="sidebar">
            <div class="sidebar-header">
                <div class="d-flex align-items-center p-3">
                    @if(auth()->user()->profile_image)
                        <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profile" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                    @else
                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                            <i class="bi bi-person-fill text-white fs-4"></i>
                        </div>
                    @endif
                    <div>
                        <h6 class="mb-0">{{ auth()->user()->username }}</h6>
                        @if(auth()->user()->role !== 'admin')
                            <small class="text-muted">{{ auth()->user()->designation }}</small>
                        @else
                            <small class="text-muted">System Administrator</small>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="sidebar-content">
                @if(auth()->user()->role === 'admin')
                    <!-- Admin Sidebar -->
                    <div class="sidebar-section">
                        <h6 class="sidebar-title">Dashboard</h6>
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2"></i>
                            <span>Overview</span>
                        </a>
                    </div>

                    <div class="sidebar-section">
                        <h6 class="sidebar-title">User Management</h6>
                        <a href="{{ route('admin.users.index') }}" class="sidebar-item {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                            <i class="bi bi-people"></i>
                            <span>All Users</span>
                        </a>
                        <a href="{{ route('admin.users.index', ['status' => 'inactive']) }}" class="sidebar-item {{ request()->routeIs('admin.users.index') && request()->get('status') === 'inactive' ? 'active' : '' }}">
                            <i class="bi bi-person-exclamation"></i>
                            <span>Pending Approvals</span>
                        </a>
                        <a href="{{ route('admin.users.index', ['status' => 'active']) }}" class="sidebar-item {{ request()->routeIs('admin.users.index') && request()->get('status') === 'active' ? 'active' : '' }}">
                            <i class="bi bi-person-check"></i>
                            <span>Active Users</span>
                        </a>
                    </div>

                    <div class="sidebar-section">
                        <h6 class="sidebar-title">Weather Data</h6>
                        <a href="{{ route('admin.weather-observations.index') }}" class="sidebar-item {{ request()->routeIs('admin.weather-observations.index') && !request()->get('status') ? 'active' : '' }}">
                            <i class="bi bi-cloud-rain"></i>
                            <span>All Observations</span>
                        </a>
                        <a href="{{ route('admin.weather-observations.index', ['status' => 'pending']) }}" class="sidebar-item {{ request()->routeIs('admin.weather-observations.index') && request()->get('status') === 'pending' ? 'active' : '' }}">
                            <i class="bi bi-clock"></i>
                            <span>Pending Review</span>
                        </a>
                        <a href="{{ route('admin.weather-observations.index', ['status' => 'approved']) }}" class="sidebar-item {{ request()->routeIs('admin.weather-observations.index') && request()->get('status') === 'approved' ? 'active' : '' }}">
                            <i class="bi bi-check-circle"></i>
                            <span>Approved</span>
                        </a>
                        <a href="{{ route('admin.weather-observations.index', ['status' => 'flagged']) }}" class="sidebar-item {{ request()->routeIs('admin.weather-observations.index') && request()->get('status') === 'flagged' ? 'active' : '' }}">
                            <i class="bi bi-flag"></i>
                            <span>Flagged</span>
                        </a>
                    </div>
                @else
                    <!-- Regular User Sidebar -->
                    <div class="sidebar-section">
                        <h6 class="sidebar-title">Dashboard</h6>
                        <a href="{{ route('user.dashboard') }}" class="sidebar-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2"></i>
                            <span>Overview</span>
                        </a>
                    </div>

                    <div class="sidebar-section">
                        <h6 class="sidebar-title">Weather Data</h6>
                        <a href="{{ route('user.weather.observation.create') }}" class="sidebar-item {{ request()->routeIs('user.weather.observation.create') ? 'active' : '' }}">
                            <i class="bi bi-cloud-plus"></i>
                            <span>Submit Observation</span>
                        </a>
                        <a href="{{ route('weather.observations') }}" class="sidebar-item {{ request()->routeIs('weather.observations') ? 'active' : '' }}">
                            <i class="bi bi-cloud-rain"></i>
                            <span>View Observations</span>
                        </a>
                        <a href="{{ route('weather.observation.create') }}" class="sidebar-item {{ request()->routeIs('weather.observation.create') ? 'active' : '' }}">
                            <i class="bi bi-file-earmark-plus"></i>
                            <span>Quick Entry</span>
                        </a>
                    </div>

                    <div class="sidebar-section">
                        <h6 class="sidebar-title">My Account</h6>
                        <a href="{{ route('user.profile.edit') }}" class="sidebar-item {{ request()->routeIs('user.profile.edit') ? 'active' : '' }}">
                            <i class="bi bi-person-gear"></i>
                            <span>Edit Profile</span>
                        </a>
                        <a href="{{ route('user.password.change.form') }}" class="sidebar-item {{ request()->routeIs('user.password.change.form') ? 'active' : '' }}">
                            <i class="bi bi-key"></i>
                            <span>Change Password</span>
                        </a>
                    </div>
                @endif

                <div class="sidebar-section">
                    <h6 class="sidebar-title">Quick Actions</h6>
                    <a href="#" class="sidebar-item" onclick="window.print()">
                        <i class="bi bi-printer"></i>
                        <span>Print Page</span>
                    </a>
                    @if(auth()->user()->role !== 'admin')
                        <a href="{{ route('public.weather.observation.create') }}" class="sidebar-item" target="_blank">
                            <i class="bi bi-globe"></i>
                            <span>Public Form</span>
                        </a>
                    @endif
                </div>

                <div class="sidebar-footer">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="sidebar-item logout-btn">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar overlay for mobile -->
        <div id="sidebarOverlay" class="sidebar-overlay"></div>
        @endauth

        <!-- Main content wrapper -->
        <div id="content-wrapper" class="content-wrapper">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    @auth
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const contentWrapper = document.getElementById('content-wrapper');
            
            function toggleSidebar() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
                contentWrapper.classList.toggle('sidebar-active');
                
                // Update toggle button icon
                const icon = sidebarToggle.querySelector('i');
                if (sidebar.classList.contains('active')) {
                    icon.className = 'bi bi-x-lg';
                } else {
                    icon.className = 'bi bi-list';
                }
            }
            
            // Toggle sidebar on button click
            sidebarToggle.addEventListener('click', toggleSidebar);
            
            // Close sidebar when clicking overlay
            overlay.addEventListener('click', toggleSidebar);
            
            // Close sidebar when pressing Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && sidebar.classList.contains('active')) {
                    toggleSidebar();
                }
            });
            
            // Auto-close sidebar on mobile when clicking a link
            const sidebarLinks = document.querySelectorAll('.sidebar-item');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768 && sidebar.classList.contains('active')) {
                        setTimeout(toggleSidebar, 100);
                    }
                });
            });
        });
    </script>
    @endauth
    
    @stack('scripts')
</body>
</html>
