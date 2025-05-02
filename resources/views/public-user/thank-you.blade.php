<!-- thank-you.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You - Weather Observation Submitted</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="card-body text-center p-5">
                        <div class="mb-4">
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                        </div>
                        <h1 class="display-4 mb-4">Thank You!</h1>
                        
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        <p class="lead mb-4">Your weather observation report has been successfully submitted. Your contribution is valuable in helping us monitor and understand weather patterns.</p>
                        
                        <div class="mb-4">
                            <p>Reference ID: <strong>{{ sprintf('WO-%s', date('YmdHis')) }}</strong></p>
                            <p class="text-muted">Please save this reference ID for any future inquiries.</p>
                        </div>
                        
                        <div class="mt-5">
                            <a href="{{ route('public.weather.observation.create') }}" class="btn btn-primary btn-lg">Submit Another Report</a>
                            <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-lg ms-2">Return to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
