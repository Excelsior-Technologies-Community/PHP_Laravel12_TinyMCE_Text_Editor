<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title' => '🚀 Getting Started with Laravel 12 & TinyMCE 7 Rich Text Editor',
                'status' => 'published',
                'content' => '
<div class="p-4 bg-primary text-white rounded-4 shadow-sm mb-4">
    <h1 class="display-5 fw-bold mb-2">Modern Web Development with Laravel 12</h1>
    <p class="lead mb-0">Learn how to build rich content management systems with embedded online images, dynamic templates, and custom media libraries.</p>
</div>

<p class="fs-5">In this comprehensive guide, we demonstrate how to integrate the TinyMCE rich text editor into Laravel 12 applications for seamless article publishing.</p>

<div class="my-4 text-center">
    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1000&q=80" alt="Coding Workstation" class="img-fluid rounded-4 shadow my-3 d-block mx-auto" style="max-height: 400px; object-fit: cover;" />
    <small class="text-muted italic d-block mt-1">Figure 1: High performance coding environment with modern developer tools</small>
</div>

<h3 class="fw-bold mt-4 text-dark"><i class="fa-solid fa-check-double text-success me-2"></i>Key Features Implemented</h3>
<ul class="list-group list-group-flush mb-4">
    <li class="list-group-item"><i class="fa-solid fa-circle-check text-primary me-2"></i><strong>Pre-built HTML Templates:</strong> Insert blog posts, product reviews, and documentation with 1 click.</li>
    <li class="list-group-item"><i class="fa-solid fa-circle-check text-primary me-2"></i><strong>Online Image Embedding:</strong> Support for external image URLs, Unsplash photography, and auto-responsive frames.</li>
    <li class="list-group-item"><i class="fa-solid fa-circle-check text-primary me-2"></i><strong>Orphaned Media Cleanup:</strong> Scan server disk storage and remove unused uploaded files in 1 click.</li>
</ul>

<div class="alert alert-info border-0 rounded-3 p-3 my-4">
    <strong><i class="fa-solid fa-circle-info me-1"></i> Pro Tip:</strong> Use responsive CSS wrapper classes like <code>class="img-fluid rounded shadow"</code> when embedding online photos!
</div>
',
            ],
            [
                'title' => '📸 Top 10 Photography Tips for Digital Content Creators',
                'status' => 'published',
                'content' => '
<div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
    <img src="https://images.unsplash.com/photo-1452587925148-ce544e77e70d?auto=format&fit=crop&w=1200&q=80" class="card-img-top" alt="Camera Photography" style="height: 300px; object-fit: cover;" />
    <div class="card-body p-4">
        <span class="badge bg-warning text-dark font-monospace mb-2">PHOTOGRAPHY GUIDE</span>
        <h2 class="fw-bold text-dark mb-2">Mastering Lighting & Composition</h2>
        <p class="text-muted">High-quality imagery increases user engagement by over 80% on blogs and e-commerce platforms.</p>
    </div>
</div>

<p class="fs-5">Capturing stunning visuals doesn\'t require expensive studio equipment. Here are the core fundamentals every blogger should master:</p>

<div class="row g-3 my-4">
    <div class="col-md-6">
        <div class="card h-100 border-0 shadow-sm bg-light p-3">
            <h5 class="fw-bold text-primary"><i class="fa-solid fa-sun me-2"></i>Natural Golden Hour Light</h5>
            <p class="small text-muted mb-0">Shoot during the hour after sunrise or before sunset for soft, warm, natural lighting tones.</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card h-100 border-0 shadow-sm bg-light p-3">
            <h5 class="fw-bold text-primary"><i class="fa-solid fa-border-all me-2"></i>Rule of Thirds</h5>
            <p class="small text-muted mb-0">Position your key subjects along grid intersection lines to create balanced visual harmony.</p>
        </div>
    </div>
</div>

<div class="my-4 text-center">
    <img src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&w=1000&q=80" alt="Professional Camera Lens" class="img-fluid rounded-4 shadow my-3 d-block mx-auto" style="max-height: 380px; object-fit: cover;" />
</div>
',
            ],
            [
                'title' => '⚡ Tech Review: Next-Gen Developer Workstations 2026',
                'status' => 'published',
                'content' => '
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-dark text-white p-4">
        <span class="badge bg-danger mb-2">HARDWARE BENCHMARK</span>
        <h2 class="fw-bold mb-1">M4 Max Workstation vs Intel Ultra Rig</h2>
        <div class="text-warning">⭐⭐⭐⭐⭐ <span class="text-white fs-6 ms-2">(4.95 / 5.0 Rating)</span></div>
    </div>
    <div class="card-body p-4">
        <p class="lead">Evaluating compilation speeds, multi-docker container performance, and thermal efficiency.</p>
        
        <div class="my-4 text-center">
            <img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&w=1000&q=80" alt="Apple MacBook Pro Workstation" class="img-fluid rounded-4 shadow my-3 d-block mx-auto" style="max-height: 380px; object-fit: cover;" />
        </div>

        <div class="row g-3 my-3">
            <div class="col-md-6">
                <div class="p-3 bg-success bg-opacity-10 border border-success rounded-3 h-100">
                    <h5 class="fw-bold text-success"><i class="fa-solid fa-plus-circle me-2"></i>Pros</h5>
                    <ul class="mb-0 text-dark">
                        <li>Instant compilation times</li>
                        <li>Silent fanless operation under load</li>
                        <li>Over 18 hours real-world battery life</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-3 bg-danger bg-opacity-10 border border-danger rounded-3 h-100">
                    <h5 class="fw-bold text-danger"><i class="fa-solid fa-minus-circle me-2"></i>Cons</h5>
                    <ul class="mb-0 text-dark">
                        <li>High initial investment cost</li>
                        <li>Unified memory non-upgradable after purchase</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
',
            ],
            [
                'title' => '☕ The Art of Specialty Coffee & Roasting Techniques',
                'status' => 'draft',
                'content' => '
<div class="p-4 bg-light rounded-4 border mb-4">
    <h2 class="fw-bold text-dark mb-2"><i class="fa-solid fa-mug-hot text-warning me-2"></i>From Bean to Cup</h2>
    <p class="text-muted">A draft article exploring single-origin espresso beans and pour-over extraction methods.</p>
</div>

<div class="my-4 text-center">
    <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1000&q=80" alt="Specialty Coffee Pour Over" class="img-fluid rounded-4 shadow my-3 d-block mx-auto" style="max-height: 380px; object-fit: cover;" />
</div>

<p>Coffee roasting is both a science and an art. The roast profile determines flavor characteristics such as acidity, body, and aroma notes...</p>
',
            ],
        ];

        foreach ($articles as $art) {
            Article::create($art);
        }
    }
}
