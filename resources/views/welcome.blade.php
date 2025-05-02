<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pakistan Meteorological Department</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|poppins:400,500,600,700" rel="stylesheet" />
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <style>
            :root {
                --primary: #0056b3;
                --primary-dark: #004494;
                --primary-light: #e6f0ff;
                --accent: #ff9800;
                --text-dark: #2c3e50;
                --text-light: #ecf0f1;
                --bg-gradient-start: #f5f7fa;
                --bg-gradient-end: #c3cfe2;
            }
            
            body {
                font-family: 'Figtree', sans-serif;
                background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
                min-height: 100vh;
                margin: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem 0;
            }
            
            .container {
                max-width: 1100px;
            }
            
            .card {
                border-radius: 20px;
                box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
                overflow: hidden;
                border: none;
                background-color: rgba(255, 255, 255, 0.95);
            }
            
            .card-header {
                background: linear-gradient(120deg, var(--primary) 0%, var(--primary-dark) 100%);
                color: white;
                text-align: center;
                padding: 2.5rem 1.5rem;
                border-bottom: none;
                position: relative;
                overflow: hidden;
            }
            
            .card-header::before {
                content: "";
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
                opacity: 0.6;
                pointer-events: none;
            }
            
            .logo-container {
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 1.5rem;
            }
            
            .logo {
                max-width: 180px;
                height: auto;
                filter: drop-shadow(0 2px 5px rgba(0, 0, 0, 0.2));
                transition: transform 0.3s ease;
            }
            
            .logo:hover {
                transform: scale(1.05);
            }
            
            .department-title {
                font-family: 'Poppins', sans-serif;
                font-weight: 700;
                margin-bottom: 0.5rem;
                font-size: 2.2rem;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            }
            
            .department-subtitle {
                font-size: 1.2rem;
                font-weight: 400;
                opacity: 0.9;
            }
            
            .card-body {
                padding: 3rem 2rem;
            }
            
            .user-section {
                padding: 1.5rem;
                border-radius: 15px;
                height: 100%;
                transition: all 0.3s ease;
                background-color: white;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            }
            
            .user-section:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 25px rgba(0, 86, 179, 0.15);
            }
            
            .user-section .icon {
                font-size: 2.5rem;
                color: var(--primary);
                margin-bottom: 1.2rem;
                background: var(--primary-light);
                width: 80px;
                height: 80px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1.5rem;
            }
            
            .user-section h3 {
                color: var(--text-dark);
                font-weight: 600;
                margin-bottom: 1rem;
                font-size: 1.5rem;
                text-align: center;
            }
            
            .user-section p {
                color: #6c757d;
                margin-bottom: 1.8rem;
                text-align: center;
                font-size: 1rem;
                line-height: 1.6;
            }
            
            .btn-container {
                text-align: center;
            }
            
            .btn-primary {
                background: linear-gradient(to right, var(--primary), var(--primary-dark));
                border: none;
                padding: 0.8rem 1.8rem;
                border-radius: 50px;
                font-weight: 600;
                transition: all 0.3s;
                box-shadow: 0 4px 15px rgba(0, 86, 179, 0.3);
                font-size: 1.1rem;
            }
            
            .btn-primary:hover {
                background: linear-gradient(to right, var(--primary-dark), var(--primary));
                transform: translateY(-3px);
                box-shadow: 0 8px 25px rgba(0, 86, 179, 0.4);
            }
            
            .btn-outline-primary {
                background: transparent;
                border: 2px solid var(--primary);
                color: var(--primary);
                padding: 0.75rem 1.8rem;
                border-radius: 50px;
                font-weight: 600;
                transition: all 0.3s;
                font-size: 1.1rem;
            }
            
            .btn-outline-primary:hover {
                background: var(--primary);
                color: white;
                transform: translateY(-3px);
                box-shadow: 0 8px 25px rgba(0, 86, 179, 0.3);
            }
            
            .divider-container {
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100%;
            }
            
            .divider {
                width: 1px;
                height: 80%;
                background: linear-gradient(to bottom, transparent, #dee2e6, transparent);
            }
            
            .weather-icon {
                position: absolute;
                opacity: 0.1;
                color: white;
            }
            
            .cloud-1 {
                top: 20px;
                left: 10%;
                font-size: 2rem;
            }
            
            .sun {
                top: 30px;
                right: 15%;
                font-size: 2.2rem;
            }
            
            .cloud-2 {
                bottom: 20px;
                right: 25%;
                font-size: 1.8rem;
            }
            
            /* Responsive adjustments */
            @media (max-width: 767.98px) {
                .divider-container {
                    display: none;
                }
                
                .user-section {
                    margin-bottom: 2rem;
                }
                
                .card-body {
                    padding: 2rem 1.5rem;
                }
                
                .department-title {
                    font-size: 1.8rem;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="card">
                <div class="card-header position-relative">
                    <!-- Weather icons background -->
                    <i class="fas fa-cloud weather-icon cloud-1"></i>
                    <i class="fas fa-sun weather-icon sun"></i>
                    <i class="fas fa-cloud-sun weather-icon cloud-2"></i>
                    
                    <div class="logo-container">
                        <img src="{{ asset('images/pmd-logo.jpg') }}" alt="PMD Logo" class="logo" onerror="this.src='https://via.placeholder.com/100x100?text=PMD'; this.onerror=null;">
                    </div>
                    <h1 class="department-title">Pakistan Meteorological Department</h1>
                    <p class="department-subtitle">National Weather Observation System</p>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="user-section">
                                <div class="icon">
                                    <i class="fas fa-building"></i>
                                </div>
                                <h3>Organization Portal</h3>
                                <p>Access your organization dashboard to submit official weather observations, view analytics, and manage your institutional account.</p>
                                <div class="btn-container">
                                    <a href="{{ route('login') }}" class="btn btn-primary">
                                        <i class="fas fa-sign-in-alt me-2"></i>Sign In
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-1">
                            <div class="divider-container">
                                <div class="divider"></div>
                            </div>
                        </div>
                        
                        <div class="col-md-5">
                            <div class="user-section">
                                <div class="icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <h3>Public Observations</h3>
                                <p>Contribute to national weather monitoring by submitting your local weather observations as a citizen scientist.</p>
                                <div class="btn-container">
                                    <a href="{{ route('public.weather.observation.create') }}" class="btn btn-outline-primary">
                                        <i class="fas fa-cloud-upload-alt me-2"></i>Submit Data
                                    </a>
                                </div>
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