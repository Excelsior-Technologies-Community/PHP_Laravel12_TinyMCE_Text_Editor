@extends('layouts.app')

@section('title', 'Create Article')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-1"><i class="fa-solid fa-pen-nib text-primary me-2"></i>Create New Article</h2>
            <p class="text-muted small mb-0">Use TinyMCE rich editor with pre-built templates, media library & dynamic toolbars</p>
        </div>
        <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fa-solid fa-arrow-left me-1"></i> Cancel
        </a>
    </div>
    <div class="card-body p-4">
        
        <!-- Template & Toolbar Preset Bar -->
        <div class="p-3 bg-light rounded-3 border mb-4">
            <div class="row g-2 align-items-center">
                <div class="col-md-5">
                    <label class="form-label small fw-bold mb-1"><i class="fa-solid fa-wand-magic-sparkles text-warning me-1"></i>1-Click Article Templates</label>
                    <select id="templateSelector" class="form-select form-select-sm">
                        <option value="">-- Choose Pre-Built Article Template --</option>
                        <option value="blog_post">📰 Standard Blog Post</option>
                        <option value="product_review">🌟 Product Review Showcase</option>
                        <option value="faq_guide">❓ FAQ & Help Center Guide</option>
                        <option value="tech_doc">📘 Technical Documentation</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold mb-1"><i class="fa-solid fa-sliders text-info me-1"></i>Editor Toolbar Mode</label>
                    <select id="toolbarModeSelector" class="form-select form-select-sm">
                        <option value="full" selected>🎨 Full Advanced Toolbar</option>
                        <option value="minimal">☀️ Minimal Light Toolbar</option>
                        <option value="dark">🌙 Dark Code Mode</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end gap-1 mt-3 mt-md-0">
                    <button type="button" class="btn btn-primary btn-sm fw-bold w-100" data-bs-toggle="modal" data-bs-target="#mediaModal">
                        <i class="fa-solid fa-photo-film me-1"></i> Media Library
                    </button>
                </div>
            </div>
            
            <!-- Quick Component Injectors -->
            <div class="d-flex flex-wrap gap-2 mt-3 pt-2 border-top">
                <span class="small text-muted fw-semibold align-self-center">Insert Component:</span>
                <button type="button" class="btn btn-outline-primary btn-sm py-0 px-2" onclick="insertComponent('hero_card')">+ Hero Banner</button>
                <button type="button" class="btn btn-outline-success btn-sm py-0 px-2" onclick="insertComponent('alert_box')">+ Alert Box</button>
                <button type="button" class="btn btn-outline-warning btn-sm py-0 px-2 text-dark" onclick="insertComponent('cta_card')">+ Call To Action</button>
            </div>
        </div>

        <form action="{{ route('articles.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label fw-semibold">Article Title</label>
                <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror"
                    id="title" name="title" value="{{ old('title') }}" placeholder="Enter article title..." required>
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label fw-semibold">Article Content (TinyMCE Editor)</label>
                <textarea class="form-control @error('content') is-invalid @enderror"
                    id="content" name="content" rows="12">{{ old('content') }}</textarea>
                @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="status" class="form-label fw-semibold">Publication Status</label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                </select>
                @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center border-top pt-3">
                <a href="{{ route('articles.index') }}" class="btn btn-secondary px-4">Cancel</a>
                <button type="submit" class="btn btn-primary btn-lg fw-bold px-5">
                    <i class="fa-solid fa-floppy-disk me-2"></i>Save Article
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Media Library Chooser -->
<div class="modal fade" id="mediaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header border-0 bg-dark text-white rounded-top-4">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-photo-film text-warning me-2"></i>Select Image from Media Library</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <div id="mediaModalGrid" class="row g-3">
                    <div class="text-center py-4">
                        <span class="spinner-border text-primary" role="status"></span>
                        <p class="small text-muted mt-2">Loading Media Library...</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 p-3 bg-white rounded-bottom-4">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="{{ route('media.index') }}" target="_blank" class="btn btn-outline-primary">
                    <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Open Media Manager
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let templatesData = [];
let componentsData = [];

function initTinyMCE(mode = 'full') {
    if (tinymce.get('content')) {
        tinymce.get('content').remove();
    }

    let toolbarConfig = 'undo redo | blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | removeformat | code fullscreen help';
    let pluginsConfig = ['advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media', 'table', 'help', 'wordcount'];
    let contentStyle = 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }';

    if (mode === 'minimal') {
        toolbarConfig = 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link image';
    } else if (mode === 'dark') {
        contentStyle = 'body { font-family:monospace; font-size:15px; background-color:#1e1e1e; color:#00ffcc; }';
    }

    tinymce.init({
        selector: '#content',
        height: 480,
        menubar: mode === 'full',
        plugins: pluginsConfig,
        toolbar: toolbarConfig,
        content_style: contentStyle,
        images_upload_url: '{{ route("upload.image") }}',
        images_upload_handler: function(blobInfo, progress) {
            return new Promise((resolve, reject) => {
                var xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '{{ route("upload.image") }}');
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                xhr.onload = function() {
                    if (xhr.status != 200) {
                        reject('HTTP Error: ' + xhr.status);
                        return;
                    }
                    var json = JSON.parse(xhr.responseText);
                    if (!json || typeof json.location != 'string') {
                        reject('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    resolve(json.location);
                };

                var formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            });
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    initTinyMCE('full');

    // Fetch Template Presets
    fetch('{{ route("templates.get") }}')
        .then(res => res.json())
        .then(data => {
            templatesData = data.templates;
            componentsData = data.components;
        });

    // Template Selector Change Event
    document.getElementById('templateSelector').addEventListener('change', function () {
        const selectedId = this.value;
        if (!selectedId) return;

        const tmpl = templatesData.find(t => t.id === selectedId);
        if (tmpl && confirm('Replace current editor content with ' + tmpl.name + '?')) {
            tinymce.get('content').setContent(tmpl.html);
        }
    });

    // Toolbar Mode Selector
    document.getElementById('toolbarModeSelector').addEventListener('change', function () {
        initTinyMCE(this.value);
    });

    // Load Media Library Modal Data
    const mediaModal = document.getElementById('mediaModal');
    if (mediaModal) {
        mediaModal.addEventListener('show.bs.modal', function () {
            const grid = document.getElementById('mediaModalGrid');
            grid.innerHTML = '<div class="text-center py-4"><span class="spinner-border text-primary"></span></div>';

            fetch('{{ route("media.list") }}')
                .then(res => res.json())
                .then(data => {
                    if (!data.media || data.media.length === 0) {
                        grid.innerHTML = '<div class="col-12 text-center text-muted py-4">No images uploaded yet.</div>';
                        return;
                    }

                    let html = '';
                    data.media.forEach(item => {
                        html += `
                            <div class="col-4 col-md-3">
                                <div class="card h-100 border shadow-sm">
                                    <img src="${item.url}" class="card-img-top object-fit-cover" style="height: 100px;">
                                    <div class="card-body p-2 text-center">
                                        <button type="button" onclick="embedImageFromModal('${item.url}')" class="btn btn-primary btn-sm w-100 fw-bold">
                                            + Embed Image
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    grid.innerHTML = html;
                });
        });
    }
});

function insertComponent(compId) {
    const comp = componentsData.find(c => c.id === compId);
    if (comp) {
        tinymce.get('content').insertContent(comp.html);
    }
}

function embedImageFromModal(url) {
    const imgHtml = `<img src="${url}" class="img-fluid rounded shadow my-3 d-block mx-auto" alt="Embedded Image" />`;
    tinymce.get('content').insertContent(imgHtml);
    const modalEl = document.getElementById('mediaModal');
    const modal = bootstrap.Modal.getInstance(modalEl);
    if (modal) modal.hide();
}
</script>
@endpush