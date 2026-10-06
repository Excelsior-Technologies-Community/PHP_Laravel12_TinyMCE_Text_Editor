@extends('layouts.app')

@section('title', 'Media Gallery & Storage Cleanup')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Banner -->
    <div class="bg-white p-4 rounded-4 shadow-sm border mb-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center">
        <div>
            <h3 class="fw-bold mb-1 text-dark">
                <i class="fa-solid fa-photo-film text-primary me-2"></i>Advanced Media Gallery & Storage Cleanup Studio
            </h3>
            <p class="text-muted mb-0 small">Manage uploaded TinyMCE images, inspect orphaned files & free up server storage</p>
        </div>
        <div class="d-flex gap-2 mt-3 mt-md-0">
            <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to Articles
            </a>
            <form action="{{ route('media.cleanup') }}" method="POST" onsubmit="return confirm('Clean up all unused/orphaned images from disk?');">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm fw-bold">
                    <i class="fa-solid fa-broom me-1"></i> Clean Orphaned Images ({{ $stats['unused_files'] }})
                </button>
            </form>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm border-0 mb-4" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Storage KPI Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white border-start border-4 border-primary h-100">
                <div class="text-muted small fw-semibold">TOTAL MEDIA FILES</div>
                <div class="h2 fw-bold text-primary mb-0 mt-1">{{ $stats['total_files'] }}</div>
                <small class="text-muted">In <code>public/uploads</code></small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white border-start border-4 border-info h-100">
                <div class="text-muted small fw-semibold">TOTAL STORAGE USED</div>
                <div class="h2 fw-bold text-info mb-0 mt-1">{{ $stats['total_size'] }}</div>
                <small class="text-muted">Server Disk Space</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white border-start border-4 border-success h-100">
                <div class="text-muted small fw-semibold">USED IN ARTICLES</div>
                <div class="h2 fw-bold text-success mb-0 mt-1">{{ $stats['used_files'] }}</div>
                <small class="text-muted">Active Embedded Images</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white border-start border-4 border-warning h-100">
                <div class="text-muted small fw-semibold">ORPHANED UNUSED FILES</div>
                <div class="h2 fw-bold text-warning mb-0 mt-1">{{ $stats['unused_files'] }}</div>
                <small class="text-muted">{{ $stats['unused_size'] }} Freeable</small>
            </div>
        </div>
    </div>

    <!-- Upload Form Section -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-white border-0 pt-3 px-4 pb-0">
            <h6 class="fw-bold mb-0"><i class="fa-solid fa-cloud-arrow-up text-primary me-2"></i>Upload Image to Media Library</h6>
        </div>
        <div class="card-body p-4">
            <form id="mediaUploadForm" action="{{ route('upload.image') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                @csrf
                <div class="col-md-5">
                    <label class="form-label small fw-semibold">Select Image File</label>
                    <input type="file" name="file" class="form-control" accept="image/*" required>
                </div>
                <div class="col-md-5">
                    <label class="form-label small fw-semibold">Image Alt Text (Description)</label>
                    <input type="text" name="alt_text" class="form-control" placeholder="e.g. Company Product Banner">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary fw-bold w-100">
                        <i class="fa-solid fa-upload me-1"></i> Upload
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Media Grid -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
            <h5 class="fw-bold mb-1"><i class="fa-solid fa-images text-dark me-2"></i>Media Library Files</h5>
            <p class="text-muted small mb-0">Images available for TinyMCE editor embedding</p>
        </div>
        <div class="card-body p-4">
            <div class="row g-3">
                @forelse($mediaList as $item)
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="card h-100 border rounded-3 overflow-hidden shadow-sm position-relative">
                            <div class="ratio ratio-4x3 bg-light">
                                <img src="{{ $item['url'] }}" class="card-img-top object-fit-cover" alt="{{ $item['filename'] }}">
                            </div>
                            <div class="card-body p-2">
                                <div class="small fw-semibold text-truncate" title="{{ $item['filename'] }}">{{ $item['filename'] }}</div>
                                <div class="d-flex justify-content-between align-items-center mt-1">
                                    <small class="text-muted extra-small">{{ $item['size_formatted'] }}</small>
                                    @if($item['is_used'])
                                        <span class="badge bg-success-subtle text-success border border-success extra-small">Used</span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning border border-warning extra-small">Orphaned</span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer p-2 bg-white border-top-0 d-flex gap-1">
                                <button onclick="copyMediaUrl('{{ $item['url'] }}')" class="btn btn-light btn-sm flex-fill border text-secondary" title="Copy URL">
                                    <i class="fa-solid fa-copy"></i>
                                </button>
                                <button onclick="deleteMediaFile('{{ $item['filename'] }}', this)" class="btn btn-outline-danger btn-sm border" title="Delete Image">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-5">
                        <i class="fa-solid fa-folder-open fs-1 mb-2 d-block opacity-50"></i>
                        No images uploaded yet in <code>public/uploads/</code>.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function copyMediaUrl(url) {
    navigator.clipboard.writeText(url);
    alert('Image URL copied to clipboard:\n' + url);
}

function deleteMediaFile(filename, btn) {
    if (!confirm('Are you sure you want to delete ' + filename + '?')) return;

    fetch('{{ route("media.delete") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ filename: filename })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            btn.closest('.col-6').remove();
            alert('File deleted successfully.');
        } else {
            alert('Delete failed: ' + (data.error || 'Unknown error'));
        }
    })
    .catch(err => alert('Error deleting file.'));
}
</script>
@endpush
