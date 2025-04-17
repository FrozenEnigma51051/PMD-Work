<!-- resources/views/media-upload.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media Upload Form</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Upload Media</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Title Input -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            
                            <!-- Description Input -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            
                            <!-- Media Type Selection -->
                            <div class="mb-3">
                                <label class="form-label">Media Type</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="media_type" id="image_type" value="image" checked>
                                    <label class="form-check-label" for="image_type">
                                        Image
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="media_type" id="video_type" value="video">
                                    <label class="form-check-label" for="video_type">
                                        Video
                                    </label>
                                </div>
                            </div>
                            
                            <!-- File Upload -->
                            <div class="mb-3">
                                <label for="media" class="form-label">Select File</label>
                                <input class="form-control" type="file" id="media" name="media" accept="image/*,video/*" required>
                                <div class="form-text">Supported formats: Images (JPG, PNG, GIF), Videos (MP4, MOV, AVI)</div>
                            </div>
                            
                            <!-- Tags Input -->
                            <div class="mb-3">
                                <label for="tags" class="form-label">Tags (comma separated)</label>
                                <input type="text" class="form-control" id="tags" name="tags" placeholder="tag1, tag2, tag3">
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>