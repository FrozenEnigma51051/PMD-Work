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
                padding: 2rem 0;
            }
            
            .container {
                max-width: 1200px;
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

            /* Latest Reports Section Styles */
            .reports-section {
                margin-top: 4rem;
                padding: 3rem 2rem;
                background: rgba(255, 255, 255, 0.95);
                border-radius: 20px;
                box-shadow: 0 15px 50px rgba(0, 0, 0, 0.10);
            }

            .section-title {
                text-align: center;
                margin-bottom: 3rem;
                color: var(--text-dark);
                font-family: 'Poppins', sans-serif;
                font-weight: 700;
                font-size: 2.5rem;
                position: relative;
            }

            .section-title::after {
                content: '';
                position: absolute;
                bottom: -10px;
                left: 50%;
                transform: translateX(-50%);
                width: 80px;
                height: 4px;
                background: linear-gradient(to right, var(--primary), var(--accent));
                border-radius: 2px;
            }

            .report-card {
                background: white;
                border-radius: 15px;
                padding: 1.5rem;
                height: 100%;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
                transition: all 0.3s ease;
                border: 1px solid rgba(0, 86, 179, 0.1);
                cursor: pointer;
            }

            .report-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 30px rgba(0, 86, 179, 0.15);
                border-color: var(--primary);
            }

            .report-header {
                display: flex;
                align-items: center;
                margin-bottom: 1rem;
            }

            .report-icon {
                width: 50px;
                height: 50px;
                background: var(--primary-light);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 1rem;
                color: var(--primary);
                font-size: 1.2rem;
            }

            .report-meta {
                flex: 1;
            }

            .report-location {
                font-weight: 600;
                color: var(--text-dark);
                margin-bottom: 0.2rem;
                font-size: 1.1rem;
            }

            .report-date {
                color: #6c757d;
                font-size: 0.9rem;
            }

            .report-content {
                margin-bottom: 1rem;
            }

            .weather-types {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
                margin-bottom: 0.8rem;
            }

            .weather-badge {
                background: var(--primary-light);
                color: var(--primary);
                padding: 0.3rem 0.8rem;
                border-radius: 20px;
                font-size: 0.8rem;
                font-weight: 500;
            }

            .report-description {
                color: #6c757d;
                font-size: 0.95rem;
                line-height: 1.5;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .no-reports {
                text-align: center;
                padding: 3rem;
                color: #6c757d;
            }

            .no-reports i {
                font-size: 4rem;
                margin-bottom: 1rem;
                opacity: 0.5;
            }

            /* Modal Styles */
            .modal-dialog {
                max-width: 700px;
            }

            .modal-header {
                background: var(--primary);
                color: white;
                border-bottom: none;
            }

            .modal-title {
                font-weight: 600;
            }

            .detail-item {
                margin-bottom: 1rem;
                padding-bottom: 1rem;
                border-bottom: 1px solid #f0f0f0;
            }

            .detail-item:last-child {
                border-bottom: none;
                margin-bottom: 0;
            }

            .detail-label {
                font-weight: 600;
                color: var(--text-dark);
                margin-bottom: 0.5rem;
                display: block;
            }

            .detail-value {
                color: #6c757d;
            }

            .media-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
                gap: 1rem;
                margin-top: 1rem;
            }

            .media-item {
                border-radius: 8px;
                overflow: hidden;
                aspect-ratio: 1;
                background: #f8f9fa;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .media-item img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
            
            /* Responsive adjustments */
            @media (max-width: 767.98px) {
                .divider-container {
                    display: none;
                }
                
                .user-section {
                    margin-bottom: 2rem;
                }
                
                .card-body, .reports-section {
                    padding: 2rem 1.5rem;
                }
                
                .department-title {
                    font-size: 1.8rem;
                }

                .section-title {
                    font-size: 2rem;
                }

                .report-card {
                    margin-bottom: 1.5rem;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <!-- Main Card -->
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

            <!-- Latest Reports Section -->
            <div class="reports-section">
                <h2 class="section-title">Latest Weather Reports</h2>
                
                @if($latestReports && $latestReports->count() > 0)
                    <div class="row g-4">
                        @foreach($latestReports as $report)
                            <div class="col-lg-4 col-md-6">
                                <div class="report-card" data-bs-toggle="modal" data-bs-target="#reportModal" data-report-id="{{ $report->id }}">
                                    <div class="report-header">
                                        <div class="report-icon">
                                            <i class="fas fa-cloud-sun"></i>
                                        </div>
                                        <div class="report-meta">
                                            <div class="report-location">
                                                <i class="fas fa-map-marker-alt me-1"></i>
                                                {{ $report->location_city }}, {{ $report->location_state }}
                                            </div>
                                            <div class="report-date">
                                                {{ $report->event_date ? $report->event_date->format('M d, Y') : 'N/A' }}
                                                @if($report->event_time)
                                                    at {{ $report->event_time }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="report-content">
                                        @if($report->weather_types && is_array($report->weather_types))
                                            <div class="weather-types">
                                                @foreach(array_slice($report->weather_types, 0, 3) as $type)
                                                    <span class="weather-badge">{{ $type }}</span>
                                                @endforeach
                                                @if(count($report->weather_types) > 3)
                                                    <span class="weather-badge">+{{ count($report->weather_types) - 3 }} more</span>
                                                @endif
                                            </div>
                                        @endif
                                        
                                        @if($report->event_description)
                                            <p class="report-description">{{ $report->event_description }}</p>
                                        @endif
                                    </div>
                                    
                                    <div class="text-end">
                                        <small class="text-primary">
                                            <i class="fas fa-eye me-1"></i>View Details
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="no-reports">
                        <i class="fas fa-cloud-rain"></i>
                        <h4>No Reports Available</h4>
                        <p>There are currently no approved weather reports to display.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Report Details Modal -->
        <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reportModalLabel">
                            <i class="fas fa-cloud-sun me-2"></i>Weather Report Details
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modalContent">
                        <div class="text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
        <script>
            // Handle modal display
            document.addEventListener('DOMContentLoaded', function() {
                const reportModal = document.getElementById('reportModal');
                
                reportModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const reportId = button.getAttribute('data-report-id');
                    
                    // Show loading state
                    const modalContent = document.getElementById('modalContent');
                    modalContent.innerHTML = `
                        <div class="text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    `;
                    
                    // Fetch report details
                    fetch(`/observation/${reportId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                displayReportDetails(data.observation);
                            } else {
                                showError('Failed to load report details.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showError('An error occurred while loading the report.');
                        });
                });
                
                function displayReportDetails(report) {
                    const modalContent = document.getElementById('modalContent');
                    
                    let weatherTypesHtml = '';
                    if (report.weather_types && Array.isArray(report.weather_types)) {
                        weatherTypesHtml = report.weather_types.map(type => 
                            `<span class="weather-badge">${type}</span>`
                        ).join(' ');
                    }
                    
                    let damagesHtml = '';
                    if (report.damages && Array.isArray(report.damages)) {
                        damagesHtml = report.damages.map(damage => 
                            `<span class="weather-badge">${damage}</span>`
                        ).join(' ');
                    }
                    
                    let mediaHtml = '';
                    if (report.media_files && Array.isArray(report.media_files) && report.media_files.length > 0) {
                        mediaHtml = `
                            <div class="detail-item">
                                <span class="detail-label">Media Files</span>
                                <div class="media-grid">
                                    ${report.media_files.map(file => `
                                        <div class="media-item">
                                            <img src="/storage/${file}" alt="Weather observation" onclick="window.open('/storage/${file}', '_blank')">
                                        </div>
                                    `).join('')}
                                </div>
                            </div>
                        `;
                    }
                    
                    modalContent.innerHTML = `
                        <div class="detail-item">
                            <span class="detail-label">Observer</span>
                            <div class="detail-value">${report.user_name || 'N/A'}</div>
                        </div>
                        
                        <div class="detail-item">
                            <span class="detail-label">Designation</span>
                            <div class="detail-value">${report.designation || 'N/A'}</div>
                        </div>
                        
                        <div class="detail-item">
                            <span class="detail-label">Location</span>
                            <div class="detail-value">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                ${report.location_city}, ${report.location_state}
                                ${report.latitude && report.longitude ? `<br><small class="text-muted">Coordinates: ${report.latitude}, ${report.longitude}</small>` : ''}
                            </div>
                        </div>
                        
                        <div class="detail-item">
                            <span class="detail-label">Date & Time</span>
                            <div class="detail-value">
                                ${report.event_date || 'N/A'}
                                ${report.event_time ? ` at ${report.event_time}` : ''}
                                ${report.time_zone ? ` (${report.time_zone})` : ''}
                            </div>
                        </div>
                        
                        ${weatherTypesHtml ? `
                            <div class="detail-item">
                                <span class="detail-label">Weather Types</span>
                                <div class="detail-value">${weatherTypesHtml}</div>
                            </div>
                        ` : ''}
                        
                        ${damagesHtml ? `
                            <div class="detail-item">
                                <span class="detail-label">Damages Reported</span>
                                <div class="detail-value">${damagesHtml}</div>
                            </div>
                        ` : ''}
                        
                        ${report.event_description ? `
                            <div class="detail-item">
                                <span class="detail-label">Description</span>
                                <div class="detail-value">${report.event_description}</div>
                            </div>
                        ` : ''}
                        
                        ${mediaHtml}
                    `;
                }
                
                function showError(message) {
                    const modalContent = document.getElementById('modalContent');
                    modalContent.innerHTML = `
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            ${message}
                        </div>
                    `;
                }
            });
        </script>
    </body>
</html>