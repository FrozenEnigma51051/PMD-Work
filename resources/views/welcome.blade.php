<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pakistan Meteorological Department</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <style>
            body {
                font-family: 'Instrument Sans', sans-serif;
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                height: 100vh;
                margin: 0;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .container {
                max-width: 900px;
            }
            .card {
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                border: none;
            }
            .card-header {
                background-color: #0056b3;
                color: white;
                text-align: center;
                padding: 2rem 1rem;
                border-bottom: none;
            }
            .logo {
                max-width: 120px;
                margin-bottom: 1rem;
            }
            .btn-primary {
                background-color: #0056b3;
                border-color: #0056b3;
                padding: 12px 25px;
                border-radius: 50px;
                font-weight: 500;
                transition: all 0.3s;
            }
            .btn-primary:hover {
                background-color: #003d7a;
                border-color: #003d7a;
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0, 86, 179, 0.3);
            }
            .btn-outline-primary {
                border-color: #0056b3;
                color: #0056b3;
                padding: 12px 25px;
                border-radius: 50px;
                font-weight: 500;
                transition: all 0.3s;
            }
            .btn-outline-primary:hover {
                background-color: #0056b3;
                color: white;
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0, 86, 179, 0.3);
            }
            .card-body {
                padding: 3rem;
            }
            .user-type {
                text-align: center;
                padding: 2rem;
                transition: all 0.3s;
                border-radius: 10px;
            }
            .user-type:hover {
                background-color: rgba(0, 86, 179, 0.05);
            }
            .user-type h3 {
                margin-bottom: 1.5rem;
                color: #333;
            }
            .user-type p {
                color: #666;
                margin-bottom: 1.5rem;
            }
            .divider {
                width: 1px;
                background-color: #dee2e6;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <img src="{{ asset('images/pmd-logo.png') }}" alt="PMD Logo" class="logo" onerror="this.src='https://via.placeholder.com/120x120?text=PMD'; this.onerror=null;">
                    <h1 class="mb-0">Pakistan Meteorological Department</h1>
                    <p class="mb-0">Weather Observation System</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="user-type">
                                <h3>Organization User</h3>
                                <p>Login to access your dashboard, submit weather observations, and manage your account.</p>
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login</a>
                            </div>
                        </div>
                        <div class="d-none d-md-block col-md-1">
                            <div class="divider h-100 mx-auto"></div>
                        </div>
                        <div class="col-md-5">
                            <div class="user-type">
                                <h3>Public User</h3>
                                <p>Submit weather observations as a member of the public.</p>
                                <a href="{{ route('public.weather.observation.create') }}" class="btn btn-outline-primary btn-lg">Submit Observation</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
