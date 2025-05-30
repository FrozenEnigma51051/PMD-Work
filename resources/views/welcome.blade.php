<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pakistan Meteorological Department</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        
        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
        
        <!-- AOS Animation Library -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        
        <style>
            :root {
                /* Sunset Storm Color Palette */
                --primary: #FF6B6B;
                --primary-light: #4ECDC4;
                --secondary: #FFE66D;
                --secondary-light: #A8E6CF;
                --accent: #006A6B;
                --accent-dark: #004A4D;
                --neutral-warm: #FFF8E7;
                --neutral-soft: #F7F9FB;
                --text-primary: #2C3E50;
                --text-secondary: #5A6C7D;
                --text-muted: #8B9CAE;
                --gradient-sunset: linear-gradient(135deg, #FF6B6B 0%, #4ECDC4 50%, #A8E6CF 100%);
                --gradient-warm: linear-gradient(135deg, #FFE66D 0%, #A8E6CF 100%);
                --gradient-teal: linear-gradient(135deg, #006A6B 0%, #4ECDC4 100%);
                --gradient-coral: linear-gradient(135deg, #FF6B6B 0%, #FFE66D 100%);
                --shadow-organic: 0 20px 60px rgba(255, 107, 107, 0.15);
                --shadow-teal: 0 15px 40px rgba(0, 106, 107, 0.2);
                --shadow-warm: 0 10px 30px rgba(255, 230, 109, 0.25);
            }
            
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
                line-height: 1.6;
                color: var(--text-primary);
                background: var(--neutral-warm);
                overflow-x: hidden;
                position: relative;
            }
            
            /* Organic Background */
            .organic-bg {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: -2;
                background: linear-gradient(135deg, var(--neutral-warm) 0%, var(--neutral-soft) 50%, #E8F4F8 100%);
            }
            
            .organic-bg::before {
                content: '';
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: 
                    radial-gradient(ellipse 800px 600px at 20% 10%, rgba(255, 107, 107, 0.1) 0%, transparent 50%),
                    radial-gradient(ellipse 600px 800px at 80% 90%, rgba(78, 205, 196, 0.08) 0%, transparent 50%),
                    radial-gradient(ellipse 400px 500px at 60% 30%, rgba(255, 230, 109, 0.06) 0%, transparent 50%);
                animation: organicFloat 25s ease-in-out infinite;
            }
            
            @keyframes organicFloat {
                0%, 100% { transform: translate(0px, 0px) rotate(0deg) scale(1); }
                25% { transform: translate(-30px, -50px) rotate(90deg) scale(1.1); }
                50% { transform: translate(40px, -30px) rotate(180deg) scale(0.9); }
                75% { transform: translate(-20px, 40px) rotate(270deg) scale(1.05); }
            }
            
            /* Floating Organic Elements */
            .floating-elements {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: -1;
                pointer-events: none;
            }
            
            .blob {
                position: absolute;
                border-radius: 50% 40% 60% 30%;
                opacity: 0.1;
                animation: float 20s ease-in-out infinite;
            }
            
            .blob:nth-child(1) {
                width: 200px;
                height: 180px;
                background: var(--gradient-coral);
                top: 10%;
                left: 10%;
                animation-delay: 0s;
                animation-duration: 18s;
            }
            
            .blob:nth-child(2) {
                width: 150px;
                height: 200px;
                background: var(--gradient-teal);
                top: 60%;
                right: 15%;
                animation-delay: 6s;
                animation-duration: 22s;
            }
            
            .blob:nth-child(3) {
                width: 180px;
                height: 160px;
                background: var(--gradient-warm);
                bottom: 20%;
                left: 20%;
                animation-delay: 12s;
                animation-duration: 20s;
            }
            
            @keyframes float {
                0%, 100% { 
                    transform: translateY(0px) rotate(0deg);
                    border-radius: 50% 40% 60% 30%;
                }
                25% { 
                    transform: translateY(-30px) rotate(90deg);
                    border-radius: 40% 60% 30% 50%;
                }
                50% { 
                    transform: translateY(-60px) rotate(180deg);
                    border-radius: 60% 30% 50% 40%;
                }
                75% { 
                    transform: translateY(-30px) rotate(270deg);
                    border-radius: 30% 50% 40% 60%;
                }
            }
            
            /* Hero Section with Organic Shapes */
            .hero-section {
                min-height: 100vh;
                display: flex;
                align-items: center;
                position: relative;
                padding: 2rem 0;
                padding-top: 6rem;
            }
            
            .hero-card {
                background: rgba(255, 248, 231, 0.9);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 107, 107, 0.2);
                border-radius: 60px 40px 80px 30px;
                box-shadow: var(--shadow-organic);
                overflow: hidden;
                position: relative;
                transform: perspective(1000px) rotateX(2deg);
                transition: all 0.4s ease;
            }
            
            .hero-card:hover {
                transform: perspective(1000px) rotateX(0deg) scale(1.02);
                box-shadow: 0 30px 80px rgba(255, 107, 107, 0.2);
            }
            
            .hero-header {
                background: var(--gradient-sunset);
                padding: 4rem 3rem;
                text-align: center;
                position: relative;
                overflow: hidden;
                border-radius: 60px 40px 0 0;
                clip-path: ellipse(100% 100% at 50% 0%);
            }
            
            .hero-header::before {
                content: '';
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: 
                    radial-gradient(circle at 30% 70%, rgba(255,255,255,0.2) 0%, transparent 40%),
                    radial-gradient(circle at 70% 30%, rgba(255,255,255,0.15) 0%, transparent 50%);
                animation: organicPulse 6s ease-in-out infinite;
            }
            
            @keyframes organicPulse {
                0%, 100% { 
                    opacity: 0.6; 
                    transform: scale(1) rotate(0deg); 
                }
                50% { 
                    opacity: 0.9; 
                    transform: scale(1.1) rotate(180deg); 
                }
            }
            
            .logo-container {
                margin-bottom: 2rem;
                position: relative;
                z-index: 2;
            }
            
            .logo {
                width: 120px;
                height: 120px;
                border-radius: 50% 40% 60% 30%;
                background: rgba(255, 248, 231, 0.95);
                padding: 1.5rem;
                box-shadow: var(--shadow-warm);
                transition: all 0.5s ease;
                animation: logoFloat 4s ease-in-out infinite;
            }
            
            @keyframes logoFloat {
                0%, 100% { 
                    transform: translateY(0px) rotate(0deg);
                    border-radius: 50% 40% 60% 30%;
                }
                50% { 
                    transform: translateY(-10px) rotate(180deg);
                    border-radius: 40% 60% 30% 50%;
                }
            }
            
            .logo:hover {
                transform: scale(1.1) rotate(15deg);
                border-radius: 60% 30% 50% 40%;
                box-shadow: var(--shadow-organic);
            }
            
            .hero-title {
                font-family: 'Space Grotesk', sans-serif;
                font-weight: 800;
                font-size: clamp(2.5rem, 5vw, 4rem);
                color: white;
                margin-bottom: 1rem;
                text-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                position: relative;
                z-index: 2;
            }
            
            .hero-subtitle {
                font-size: clamp(1.1rem, 2vw, 1.4rem);
                color: rgba(255, 255, 255, 0.9);
                font-weight: 400;
                margin-bottom: 0;
                position: relative;
                z-index: 2;
            }
            
            /* Organic Weather Icons */
            .weather-icons {
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                pointer-events: none;
            }
            
            .weather-icon {
                position: absolute;
                color: rgba(255, 255, 255, 0.15);
                animation: organicIconFloat 8s ease-in-out infinite;
                filter: blur(0.5px);
            }
            
            .weather-icon:nth-child(1) { 
                top: 15%; left: 15%; font-size: 2rem; 
                animation-delay: 0s; 
            }
            .weather-icon:nth-child(2) { 
                top: 25%; right: 20%; font-size: 2.5rem; 
                animation-delay: 2s; 
            }
            .weather-icon:nth-child(3) { 
                bottom: 25%; left: 20%; font-size: 1.8rem; 
                animation-delay: 4s; 
            }
            .weather-icon:nth-child(4) { 
                bottom: 20%; right: 25%; font-size: 2.2rem; 
                animation-delay: 6s; 
            }
            
            @keyframes organicIconFloat {
                0%, 100% { 
                    transform: translateY(0px) rotate(0deg) scale(1); 
                    opacity: 0.15; 
                }
                25% { 
                    transform: translateY(-20px) rotate(90deg) scale(1.1); 
                    opacity: 0.25; 
                }
                50% { 
                    transform: translateY(-40px) rotate(180deg) scale(0.9); 
                    opacity: 0.2; 
                }
                75% { 
                    transform: translateY(-20px) rotate(270deg) scale(1.05); 
                    opacity: 0.3; 
                }
            }
            
            /* Wave Divider */
            .wave-divider {
                position: absolute;
                bottom: -2px;
                left: 0;
                width: 100%;
                height: 60px;
                background: var(--neutral-warm);
                clip-path: polygon(0 20px, 100% 0, 100% 100%, 0 100%);
            }
            
            /* Main Content with Organic Design */
            .hero-body {
                padding: 6rem 3rem 4rem;
                position: relative;
            }
            
            .hero-body::before {
                content: '';
                position: absolute;
                top: -30px;
                left: 0;
                width: 100%;
                height: 60px;
                background: var(--neutral-warm);
                clip-path: ellipse(100% 100% at 50% 100%);
            }
            
            .service-card {
                background: rgba(255, 248, 231, 0.8);
                backdrop-filter: blur(10px);
                border-radius: 40px 20px 60px 30px;
                padding: 3rem 2rem;
                height: 100%;
                box-shadow: var(--shadow-warm);
                border: 2px solid rgba(255, 230, 109, 0.3);
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
                transform: perspective(800px) rotateY(0deg);
            }
            
            .service-card::before {
                content: '';
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: var(--gradient-warm);
                opacity: 0;
                transition: opacity 0.5s ease;
                border-radius: 50%;
                transform: scale(0);
            }
            
            .service-card:hover {
                transform: perspective(800px) rotateY(5deg) translateY(-15px);
                box-shadow: var(--shadow-organic);
                border-color: var(--primary);
                border-radius: 30px 50px 40px 60px;
            }
            
            .service-card:hover::before {
                opacity: 0.1;
                transform: scale(1);
            }
            
            .service-icon {
                width: 80px;
                height: 80px;
                border-radius: 40% 60% 30% 50%;
                background: var(--gradient-sunset);
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 2rem;
                font-size: 2rem;
                color: white;
                box-shadow: var(--shadow-teal);
                transition: all 0.4s ease;
                animation: iconBreathe 3s ease-in-out infinite;
            }
            
            @keyframes iconBreathe {
                0%, 100% { 
                    transform: scale(1);
                    border-radius: 40% 60% 30% 50%;
                }
                50% { 
                    transform: scale(1.05);
                    border-radius: 60% 30% 50% 40%;
                }
            }
            
            .service-card:hover .service-icon {
                transform: scale(1.2) rotate(15deg);
                border-radius: 50% 30% 60% 40%;
                box-shadow: var(--shadow-organic);
            }
            
            .service-title {
                font-family: 'Space Grotesk', sans-serif;
                font-weight: 700;
                font-size: 1.75rem;
                color: var(--text-primary);
                margin-bottom: 1.5rem;
                text-align: center;
            }
            
            .service-description {
                color: var(--text-secondary);
                font-size: 1.1rem;
                line-height: 1.7;
                text-align: center;
                margin-bottom: 2.5rem;
            }
            
            /* Organic Buttons */
            .btn-primary-custom {
                background: var(--gradient-sunset);
                border: none;
                padding: 1rem 2.5rem;
                border-radius: 50px 30px 50px 30px;
                font-weight: 600;
                font-size: 1.1rem;
                color: white;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                transition: all 0.4s ease;
                box-shadow: var(--shadow-warm);
                position: relative;
                overflow: hidden;
            }
            
            .btn-primary-custom::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
                transition: left 0.6s ease;
            }
            
            .btn-primary-custom:hover {
                transform: translateY(-3px) scale(1.05);
                box-shadow: var(--shadow-organic);
                color: white;
                border-radius: 30px 50px 30px 50px;
            }
            
            .btn-primary-custom:hover::before {
                left: 100%;
            }
            
            .btn-outline-custom {
                background: transparent;
                border: 2px solid var(--primary);
                color: var(--primary);
                padding: 1rem 2.5rem;
                border-radius: 30px 50px 30px 50px;
                font-weight: 600;
                font-size: 1.1rem;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                transition: all 0.4s ease;
                position: relative;
                overflow: hidden;
            }
            
            .btn-outline-custom::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 0;
                height: 100%;
                background: var(--gradient-sunset);
                transition: width 0.4s ease;
                z-index: -1;
                border-radius: 30px 50px 30px 50px;
            }
            
            .btn-outline-custom:hover {
                color: white;
                border-color: var(--primary);
                transform: translateY(-3px) scale(1.05);
                border-radius: 50px 30px 50px 30px;
                box-shadow: var(--shadow-warm);
            }
            
            .btn-outline-custom:hover::before {
                width: 100%;
            }
            
            /* Organic Divider */
            .divider-container {
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100%;
                position: relative;
            }
            
            .divider {
                width: 3px;
                height: 200px;
                background: linear-gradient(to bottom, transparent, var(--primary-light), var(--primary), var(--primary-light), transparent);
                position: relative;
                border-radius: 50px;
                animation: dividerPulse 4s ease-in-out infinite;
            }
            
            @keyframes dividerPulse {
                0%, 100% { transform: scaleY(1); opacity: 0.7; }
                50% { transform: scaleY(1.1); opacity: 1; }
            }
            
            .divider::before {
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 20px;
                height: 20px;
                background: var(--gradient-sunset);
                border-radius: 50% 30% 60% 40%;
                box-shadow: 0 0 0 6px rgba(255, 248, 231, 0.8), 0 0 0 10px rgba(255, 107, 107, 0.2);
                animation: float 3s ease-in-out infinite;
            }
            
            /* Reports Section with Organic Design */
            .reports-section {
                margin-top: 6rem;
                padding: 6rem 0;
                background: rgba(247, 249, 251, 0.9);
                border-radius: 80px 40px 100px 60px;
                box-shadow: var(--shadow-organic);
                position: relative;
                overflow: hidden;
                backdrop-filter: blur(10px);
            }
            
            .reports-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: 
                    radial-gradient(ellipse 600px 400px at 70% 20%, rgba(78, 205, 196, 0.08) 0%, transparent 60%),
                    radial-gradient(ellipse 400px 600px at 30% 80%, rgba(255, 230, 109, 0.06) 0%, transparent 60%);
                pointer-events: none;
                animation: organicFloat 20s ease-in-out infinite reverse;
            }
            
            .section-title {
                font-family: 'Space Grotesk', sans-serif;
                font-weight: 800;
                font-size: clamp(2.5rem, 4vw, 3.5rem);
                color: var(--text-primary);
                text-align: center;
                margin-bottom: 1rem;
                position: relative;
                z-index: 2;
            }
            
            .section-subtitle {
                color: var(--text-secondary);
                font-size: 1.2rem;
                text-align: center;
                margin-bottom: 4rem;
                max-width: 600px;
                margin-left: auto;
                margin-right: auto;
                position: relative;
                z-index: 2;
            }
            
            .section-title::after {
                content: '';
                position: absolute;
                bottom: -15px;
                left: 50%;
                transform: translateX(-50%);
                width: 120px;
                height: 6px;
                background: var(--gradient-coral);
                border-radius: 50px;
                box-shadow: var(--shadow-warm);
            }
            
            /* Organic Report Cards */
            .report-card {
                background: rgba(255, 248, 231, 0.9);
                backdrop-filter: blur(15px);
                border-radius: 40px 20px 50px 30px;
                padding: 2rem;
                height: 100%;
                box-shadow: var(--shadow-warm);
                border: 2px solid rgba(78, 205, 196, 0.2);
                transition: all 0.4s ease;
                cursor: pointer;
                position: relative;
                overflow: hidden;
                transform: perspective(600px) rotateX(0deg);
            }
            
            .report-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 4px;
                background: var(--gradient-coral);
                transform: scaleX(0);
                transition: transform 0.4s ease;
                border-radius: 50px;
            }
            
            .report-card::after {
                content: '';
                position: absolute;
                top: -50%;
                right: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle, rgba(255, 107, 107, 0.05) 0%, transparent 70%);
                opacity: 0;
                transition: opacity 0.4s ease;
                border-radius: 50%;
                transform: scale(0);
            }
            
            .report-card:hover {
                transform: perspective(600px) rotateX(5deg) translateY(-10px);
                box-shadow: var(--shadow-organic);
                border-color: var(--primary);
                border-radius: 30px 40px 60px 20px;
            }
            
            .report-card:hover::before {
                transform: scaleX(1);
            }
            
            .report-card:hover::after {
                opacity: 1;
                transform: scale(1);
            }
            
            .report-header {
                display: flex;
                align-items: center;
                margin-bottom: 1.5rem;
                position: relative;
                z-index: 2;
            }
            
            .report-icon {
                width: 60px;
                height: 60px;
                background: var(--gradient-teal);
                border-radius: 50% 30% 60% 40%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 1rem;
                color: white;
                font-size: 1.5rem;
                box-shadow: var(--shadow-teal);
                transition: all 0.3s ease;
                animation: iconBreathe 4s ease-in-out infinite;
            }
            
            .report-card:hover .report-icon {
                transform: scale(1.1) rotate(10deg);
                border-radius: 40% 60% 30% 50%;
                box-shadow: var(--shadow-organic);
            }
            
            .report-meta {
                flex: 1;
            }
            
            .report-location {
                font-weight: 700;
                color: var(--text-primary);
                margin-bottom: 0.25rem;
                font-size: 1.2rem;
            }
            
            .report-date {
                color: var(--text-muted);
                font-size: 0.95rem;
                font-weight: 500;
            }
            
            .weather-types {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
                margin-bottom: 1rem;
                position: relative;
                z-index: 2;
            }
            
            .weather-badge {
                background: rgba(78, 205, 196, 0.15);
                color: var(--accent);
                padding: 0.4rem 1rem;
                border-radius: 50px 20px 50px 20px;
                font-size: 0.85rem;
                font-weight: 600;
                border: 1px solid rgba(78, 205, 196, 0.3);
                transition: all 0.3s ease;
            }
            
            .weather-badge:hover {
                background: rgba(78, 205, 196, 0.25);
                transform: scale(1.05);
                border-radius: 20px 50px 20px 50px;
            }
            
            .report-description {
                color: var(--text-secondary);
                font-size: 1rem;
                line-height: 1.6;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
                margin-bottom: 1rem;
                position: relative;
                z-index: 2;
            }
            
            .view-details {
                color: var(--primary);
                font-weight: 600;
                font-size: 0.95rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                transition: all 0.3s ease;
                position: relative;
                z-index: 2;
            }
            
            .report-card:hover .view-details {
                gap: 1rem;
                color: var(--accent);
            }
            
            /* No Reports State */
            .no-reports {
                text-align: center;
                padding: 6rem 2rem;
                color: var(--text-muted);
                position: relative;
                z-index: 2;
            }
            
            .no-reports i {
                font-size: 5rem;
                margin-bottom: 2rem;
                opacity: 0.4;
                background: var(--gradient-sunset);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                animation: iconBreathe 3s ease-in-out infinite;
            }
            
            .no-reports h4 {
                font-family: 'Space Grotesk', sans-serif;
                font-weight: 700;
                color: var(--text-primary);
                margin-bottom: 1rem;
                font-size: 2rem;
            }
            
            /* Organic Modal Styles */
            .modal-dialog {
                max-width: 800px;
            }
            
            .modal-content {
                border-radius: 40px 20px 60px 30px;
                border: none;
                box-shadow: var(--shadow-organic);
                overflow: hidden;
                backdrop-filter: blur(20px);
            }
            
            .modal-header {
                background: var(--gradient-sunset);
                color: white;
                border-bottom: none;
                padding: 2rem;
                border-radius: 40px 20px 0 0;
                position: relative;
                overflow: hidden;
            }
            
            .modal-header::before {
                content: '';
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
                animation: organicPulse 4s ease-in-out infinite;
            }
            
            .modal-title {
                font-family: 'Space Grotesk', sans-serif;
                font-weight: 700;
                font-size: 1.5rem;
                position: relative;
                z-index: 2;
            }
            
            .modal-body {
                padding: 2rem;
                background: var(--neutral-warm);
            }
            
            .detail-item {
                margin-bottom: 2rem;
                padding-bottom: 1.5rem;
                border-bottom: 2px solid rgba(78, 205, 196, 0.1);
                border-radius: 50px;
                transition: all 0.3s ease;
            }
            
            .detail-item:last-child {
                border-bottom: none;
                margin-bottom: 0;
            }
            
            .detail-item:hover {
                background: rgba(255, 230, 109, 0.05);
                padding: 1rem;
                border-radius: 20px;
                border-bottom-color: rgba(78, 205, 196, 0.2);
            }
            
            .detail-label {
                font-weight: 700;
                color: var(--text-primary);
                margin-bottom: 0.75rem;
                display: block;
                font-size: 1.1rem;
            }
            
            .detail-value {
                color: var(--text-secondary);
                font-size: 1rem;
                line-height: 1.6;
            }
            
            .media-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                gap: 1rem;
                margin-top: 1rem;
            }
            
            .media-item {
                border-radius: 30% 70% 60% 40%;
                overflow: hidden;
                aspect-ratio: 1;
                background: var(--neutral-soft);
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.4s ease;
                box-shadow: var(--shadow-warm);
            }
            
            .media-item:hover {
                transform: scale(1.05) rotate(5deg);
                border-radius: 40% 60% 30% 70%;
                box-shadow: var(--shadow-organic);
            }
            
            .media-item img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
            
            /* Responsive Design with Organic Adjustments */
            @media (max-width: 991.98px) {
                .divider-container {
                    display: none;
                }
                
                .hero-header {
                    padding: 3rem 2rem;
                    border-radius: 40px 30px 0 0;
                }
                
                .hero-body {
                    padding: 4rem 2rem 3rem;
                }
                
                .service-card {
                    margin-bottom: 2rem;
                    border-radius: 30px 40px 50px 20px;
                }
                
                .hero-card {
                    border-radius: 40px 30px 60px 20px;
                }
            }
            
            @media (max-width: 767.98px) {
                .hero-header {
                    padding: 2rem 1.5rem;
                    clip-path: ellipse(100% 90% at 50% 0%);
                }
                
                .hero-body {
                    padding: 3rem 1.5rem 2rem;
                }
                
                .reports-section {
                    padding: 4rem 1.5rem;
                    margin-top: 4rem;
                    border-radius: 40px 30px 60px 20px;
                }
                
                .service-card, .report-card {
                    border-radius: 25px 35px 40px 15px;
                }
                
                .modal-content {
                    border-radius: 30px 20px 40px 25px;
                }
                
                .blob {
                    width: 120px !important;
                    height: 140px !important;
                }
            }
            
            /* Utility Classes */
            .text-gradient {
                background: var(--gradient-sunset);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            
            .btn-container {
                text-align: center;
            }
            
            /* Custom Scrollbar with Organic Design */
            ::-webkit-scrollbar {
                width: 10px;
            }
            
            ::-webkit-scrollbar-track {
                background: var(--neutral-soft);
                border-radius: 50px;
            }
            
            ::-webkit-scrollbar-thumb {
                background: var(--gradient-coral);
                border-radius: 50px;
                box-shadow: inset 0 0 5px rgba(0,0,0,0.1);
            }
            
            ::-webkit-scrollbar-thumb:hover {
                background: var(--gradient-sunset);
            }
            
            /* Additional Organic Animations */
            @keyframes morphing {
                0%, 100% { border-radius: 40% 60% 30% 70%; }
                25% { border-radius: 60% 40% 70% 30%; }
                50% { border-radius: 30% 70% 40% 60%; }
                75% { border-radius: 70% 30% 60% 40%; }
            }
            
            .morphing {
                animation: morphing 8s ease-in-out infinite;
            }
            
            /* Selection styling */
            ::selection {
                background: rgba(255, 107, 107, 0.3);
                color: var(--text-primary);
            }
            
            ::-moz-selection {
                background: rgba(255, 107, 107, 0.3);
                color: var(--text-primary);
            }
        </style>
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
            <div class="container-fluid">
                <!-- Logo and brand name -->
                <a class="navbar-brand d-flex align-items-center me-auto" href="{{ url('/') }}">
                    <div class="me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 4px;">
                        <img src="{{ asset('images/pmd-logo.png') }}" alt="PMD Logo" style="width: 38px; height: 38px; object-fit: contain;" onerror="this.src='https://via.placeholder.com/38x38/FF6B6B/ffffff?text=PMD'; this.onerror=null;">
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

        <div class="organic-bg"></div>
        <div class="floating-elements">
            <div class="blob"></div>
            <div class="blob"></div>
            <div class="blob"></div>
        </div>
        
        <div class="container-fluid px-4">
            <!-- Hero Section -->
            <div class="hero-section">
                <div class="container">
                    <div class="hero-card" data-aos="fade-up" data-aos-duration="1000">
                        <div class="hero-header">
                            <div class="weather-icons">
                                <i class="fas fa-cloud weather-icon"></i>
                                <i class="fas fa-sun weather-icon"></i>
                                <i class="fas fa-cloud-rain weather-icon"></i>
                                <i class="fas fa-bolt weather-icon"></i>
                            </div>
                            
                            <div class="logo-container" data-aos="zoom-in" data-aos-delay="200">
                                <img src="{{ asset('images/pmd-logo.png') }}" alt="PMD Logo" class="logo morphing" onerror="this.src='https://via.placeholder.com/120x120/FF6B6B/ffffff?text=PMD'; this.onerror=null;">
                            </div>
                            
                            <h1 class="hero-title" data-aos="fade-up" data-aos-delay="300">
                                Pakistan Meteorological Department
                            </h1>
                            <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="400">
                                Advanced Weather Monitoring & Forecasting System
                            </p>
                            <div class="wave-divider"></div>
                        </div>
                        
                        <div class="hero-body">
                            <div class="row g-4 align-items-center">
                                <div class="col-lg-5" data-aos="fade-right" data-aos-delay="500">
                                    <div class="service-card">
                                        <div class="service-icon">
                                            <i class="fas fa-building"></i>
                                        </div>
                                        <h3 class="service-title">Organization Portal</h3>
                                        <p class="service-description">
                                            Access comprehensive weather data analytics, submit official meteorological observations, and manage your institutional dashboard with advanced reporting tools.
                                        </p>
                                        <div class="btn-container">
                                            <a href="{{ route('login') }}" class="btn-primary-custom">
                                                <i class="fas fa-sign-in-alt"></i>
                                                Access Portal
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-2" data-aos="fade-up" data-aos-delay="600">
                                    <div class="divider-container">
                                        <div class="divider"></div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-5" data-aos="fade-left" data-aos-delay="700">
                                    <div class="service-card">
                                        <div class="service-icon">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <h3 class="service-title">Citizen Science</h3>
                                        <p class="service-description">
                                            Contribute to Pakistan's weather monitoring network by submitting local observations. Help create a comprehensive national weather database through community participation.
                                        </p>
                                        <div class="btn-container">
                                            <a href="{{ route('public.weather.observation.create') }}" class="btn-outline-custom">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                                Submit Observation
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Latest Reports Section -->
            <div class="container">
                <div class="reports-section" data-aos="fade-up" data-aos-delay="800">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="section-title">Latest Weather Reports</h2>
                            <p class="section-subtitle">
                                Real-time weather observations from across Pakistan, contributed by our network of meteorological stations and citizen scientists.
                            </p>
                        </div>
                    </div>
                    
                    @if($latestReports && $latestReports->count() > 0)
                        <div class="row g-4">
                            @foreach($latestReports as $index => $report)
                                <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="{{ 900 + ($index * 100) }}">
                                    <div class="report-card" data-bs-toggle="modal" data-bs-target="#reportModal" data-report-id="{{ $report->id }}">
                                        <div class="report-header">
                                            <div class="report-icon">
                                                <i class="fas fa-cloud-sun"></i>
                                            </div>
                                            <div class="report-meta">
                                                <div class="report-location">
                                                    <i class="fas fa-map-marker-alt me-2"></i>
                                                    {{ $report->location_city }}, {{ $report->location_state }}
                                                </div>
                                                <div class="report-date">
                                                    {{ $report->event_date ? $report->event_date->format('M d, Y') : 'N/A' }}
                                                    @if($report->event_time)
                                                        • {{ $report->event_time }}
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
                                            
                                            <div class="view-details">
                                                <span>View Full Report</span>
                                                <i class="fas fa-arrow-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="no-reports" data-aos="fade-up" data-aos-delay="900">
                            <i class="fas fa-cloud-rain"></i>
                            <h4>No Reports Available</h4>
                            <p>Weather observation reports will appear here once they are submitted and approved by our meteorological team.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Report Details Modal -->
        <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reportModalLabel">
                            <i class="fas fa-cloud-sun me-2"></i>Weather Observation Details
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modalContent">
                        <div class="text-center py-5">
                            <div class="spinner-border" style="color: var(--primary); width: 3rem; height: 3rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-3 text-muted">Loading weather report details...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        
        <script>
            // Initialize AOS with organic easing
            AOS.init({
                duration: 1000,
                easing: 'ease-out-cubic',
                once: true,
                offset: 50,
                delay: 100
            });

            // Smooth scrolling for internal links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Handle modal display
            document.addEventListener('DOMContentLoaded', function() {
                const reportModal = document.getElementById('reportModal');
                
                reportModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const reportId = button.getAttribute('data-report-id');
                    
                    // Show loading state
                    const modalContent = document.getElementById('modalContent');
                    modalContent.innerHTML = `
                        <div class="text-center py-5">
                            <div class="spinner-border" style="color: var(--primary); width: 3rem; height: 3rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-3 text-muted">Loading weather report details...</p>
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
                            `<span class="weather-badge me-2 mb-2">${type}</span>`
                        ).join('');
                    }
                    
                    let damagesHtml = '';
                    if (report.damages && Array.isArray(report.damages)) {
                        damagesHtml = report.damages.map(damage => 
                            `<span class="weather-badge me-2 mb-2">${damage}</span>`
                        ).join('');
                    }
                    
                    let mediaHtml = '';
                    if (report.media_files && Array.isArray(report.media_files) && report.media_files.length > 0) {
                        mediaHtml = `
                            <div class="detail-item">
                                <span class="detail-label"><i class="fas fa-images me-2"></i>Media Files</span>
                                <div class="media-grid">
                                    ${report.media_files.map(file => `
                                        <div class="media-item">
                                            <img src="/storage/${file}" alt="Weather observation" onclick="window.open('/storage/${file}', '_blank')" loading="lazy">
                                        </div>
                                    `).join('')}
                                </div>
                            </div>
                        `;
                    }
                    
                    modalContent.innerHTML = `
                        <div class="detail-item">
                            <span class="detail-label"><i class="fas fa-user me-2"></i>Observer Information</span>
                            <div class="detail-value">
                                <strong>Name:</strong> ${report.user_name || 'N/A'}<br>
                                <strong>Designation:</strong> ${report.designation || 'N/A'}
                            </div>
                        </div>
                        
                        <div class="detail-item">
                            <span class="detail-label"><i class="fas fa-map-marker-alt me-2"></i>Location Details</span>
                            <div class="detail-value">
                                <strong>City:</strong> ${report.location_city}<br>
                                <strong>State/Province:</strong> ${report.location_state}
                                ${report.latitude && report.longitude ? `<br><strong>Coordinates:</strong> ${report.latitude}, ${report.longitude}` : ''}
                            </div>
                        </div>
                        
                        <div class="detail-item">
                            <span class="detail-label"><i class="fas fa-calendar-alt me-2"></i>Date & Time</span>
                            <div class="detail-value">
                                <strong>Date:</strong> ${report.event_date || 'N/A'}<br>
                                <strong>Time:</strong> ${report.event_time || 'N/A'}
                                ${report.time_zone ? `<br><strong>Timezone:</strong> ${report.time_zone}` : ''}
                            </div>
                        </div>
                        
                        ${weatherTypesHtml ? `
                            <div class="detail-item">
                                <span class="detail-label"><i class="fas fa-cloud me-2"></i>Weather Phenomena</span>
                                <div class="detail-value">${weatherTypesHtml}</div>
                            </div>
                        ` : ''}
                        
                        ${damagesHtml ? `
                            <div class="detail-item">
                                <span class="detail-label"><i class="fas fa-exclamation-triangle me-2"></i>Reported Damages</span>
                                <div class="detail-value">${damagesHtml}</div>
                            </div>
                        ` : ''}
                        
                        ${report.event_description ? `
                            <div class="detail-item">
                                <span class="detail-label"><i class="fas fa-file-alt me-2"></i>Detailed Description</span>
                                <div class="detail-value">${report.event_description}</div>
                            </div>
                        ` : ''}
                        
                        ${mediaHtml}
                    `;
                }
                
                function showError(message) {
                    const modalContent = document.getElementById('modalContent');
                    modalContent.innerHTML = `
                        <div class="alert d-flex align-items-center" style="background: rgba(255, 107, 107, 0.1); border: 2px solid rgba(255, 107, 107, 0.3); border-radius: 20px;">
                            <i class="fas fa-exclamation-triangle me-2" style="color: var(--primary);"></i>
                            <div style="color: var(--text-primary);">${message}</div>
                        </div>
                    `;
                }
            });

            // Enhanced organic particle system
            function createOrganicParticle() {
                const particle = document.createElement('div');
                const size = Math.random() * 6 + 2;
                
                particle.style.cssText = `
                    position: fixed;
                    width: ${size}px;
                    height: ${size}px;
                    background: linear-gradient(45deg, 
                        rgba(255, 107, 107, 0.3), 
                        rgba(78, 205, 196, 0.2), 
                        rgba(255, 230, 109, 0.2)
                    );
                    border-radius: ${50 + Math.random() * 50}% ${30 + Math.random() * 40}% ${60 + Math.random() * 40}% ${40 + Math.random() * 30}%;
                    pointer-events: none;
                    z-index: -1;
                    left: ${Math.random() * 100}vw;
                    top: -20px;
                    opacity: 0;
                `;
                
                document.body.appendChild(particle);
                
                const duration = Math.random() * 15000 + 10000;
                const endX = (Math.random() - 0.5) * 200;
                
                const animation = particle.animate([
                    { 
                        transform: 'translateY(-20px) translateX(0px) rotate(0deg) scale(0)',
                        opacity: 0,
                        borderRadius: '50% 40% 60% 30%'
                    },
                    { 
                        transform: `translateY(50vh) translateX(${endX/2}px) rotate(180deg) scale(1)`,
                        opacity: 0.6,
                        borderRadius: '40% 60% 30% 50%'
                    },
                    { 
                        transform: `translateY(100vh) translateX(${endX}px) rotate(360deg) scale(0.5)`,
                        opacity: 0,
                        borderRadius: '60% 30% 50% 40%'
                    }
                ], {
                    duration: duration,
                    easing: 'cubic-bezier(0.25, 0.46, 0.45, 0.94)'
                });
                
                animation.onfinish = () => particle.remove();
            }

            // Create organic particles periodically
            setInterval(createOrganicParticle, 3000);
            
            // Create initial burst of particles
            for(let i = 0; i < 5; i++) {
                setTimeout(() => createOrganicParticle(), i * 600);
            }
        </script>
    </body>
</html>