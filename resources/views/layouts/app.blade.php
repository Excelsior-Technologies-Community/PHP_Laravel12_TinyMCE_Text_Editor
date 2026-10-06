<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TinyMCE Editor in Laravel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tiny.cloud/1/YOUR_API_KEY_HERE/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    @stack('styles')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('articles.index') }}">
                <i class="fa-solid fa-pen-nib text-primary me-2"></i>TinyMCE Editor
            </a>
            <div class="d-flex gap-2">
                <a href="{{ route('articles.index') }}" class="btn btn-outline-light btn-sm">
                    <i class="fa-solid fa-newspaper me-1"></i> Articles
                </a>
                <a href="{{ route('media.index') }}" class="btn btn-outline-warning btn-sm fw-semibold">
                    <i class="fa-solid fa-photo-film me-1"></i> Media Gallery & Cleanup
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Replace the TinyMCE script in layouts/app.blade.php with: -->
    <script src="https://cdn.jsdelivr.net/npm/tinymce@7/tinymce.min.js"></script>
    @stack('scripts')
</body>

</html>