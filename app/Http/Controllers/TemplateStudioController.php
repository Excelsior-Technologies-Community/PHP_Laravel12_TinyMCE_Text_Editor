<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateStudioController extends Controller
{
    /**
     * Get HTML Templates for TinyMCE Preset Switcher
     */
    public function getTemplates()
    {
        $templates = [
            [
                'id' => 'blog_post',
                'name' => '📰 Standard Blog Post',
                'description' => 'Hero banner, intro text, blockquote, subheadings & conclusion badge',
                'html' => '
<div class="p-4 bg-light rounded-3 border mb-4">
    <h1 class="display-5 fw-bold text-primary">Captivating Blog Article Title</h1>
    <p class="lead text-muted">A compelling subtitle or summary paragraph that hooks your readers right away.</p>
</div>
<p class="fs-5">Welcome to our latest article! In this post, we will explore key insights and best practices for creating engaging digital content.</p>
<blockquote class="blockquote p-3 bg-white border-start border-primary border-4 rounded shadow-sm my-4">
    <p class="mb-1 italic">"Quality content isn\'t just about information; it\'s about creating memorable experiences for your audience."</p>
    <footer class="blockquote-footer mt-1">Industry Expert</footer>
</blockquote>
<h2 class="fw-bold mt-4 text-dark"><i class="fa-solid fa-lightbulb text-warning me-2"></i>Key Takeaways</h2>
<ul class="list-group list-group-flush mb-4">
    <li class="list-group-item"><i class="fa-solid fa-check-circle text-success me-2"></i>Understand your target audience\'s core needs.</li>
    <li class="list-group-item"><i class="fa-solid fa-check-circle text-success me-2"></i>Use rich visual formatting and structured headings.</li>
    <li class="list-group-item"><i class="fa-solid fa-check-circle text-success me-2"></i>Include clear calls-to-action to boost engagement.</li>
</ul>
<div class="alert alert-info border-0 rounded-3 p-3 my-4">
    <strong><i class="fa-solid fa-circle-info me-1"></i> Pro Tip:</strong> Always proofread your content and test all embedded media links before publishing!
</div>
<hr />
<p class="text-muted small">Published by Editorial Team · Updated Today</p>',
            ],
            [
                'id' => 'product_review',
                'name' => '🌟 Product Review Showcase',
                'description' => 'Product badge, rating stars, pros & cons table, CTA button',
                'html' => '
<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
    <div class="card-header bg-dark text-white p-4">
        <span class="badge bg-warning text-dark font-monospace mb-2">PRODUCT REVIEW</span>
        <h2 class="fw-bold mb-1">Ultimate Gadget Pro 2026 Review</h2>
        <div class="text-warning fs-5">⭐⭐⭐⭐⭐ <span class="text-white fs-6 ms-2">(4.9 / 5.0 Rating)</span></div>
    </div>
    <div class="card-body p-4">
        <p class="lead">An in-depth hands-on analysis of the latest flagship device performance and battery efficiency.</p>
        <div class="row g-3 my-3">
            <div class="col-md-6">
                <div class="p-3 bg-success bg-opacity-10 border border-success rounded-3 h-100">
                    <h5 class="fw-bold text-success"><i class="fa-solid fa-thumbs-up me-2"></i>Pros</h5>
                    <ul class="mb-0 text-dark">
                        <li>Ultra-fast processing performance</li>
                        <li>Stunning OLED high-refresh display</li>
                        <li>All-day battery stamina</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-3 bg-danger bg-opacity-10 border border-danger rounded-3 h-100">
                    <h5 class="fw-bold text-danger"><i class="fa-solid fa-thumbs-down me-2"></i>Cons</h5>
                    <ul class="mb-0 text-dark">
                        <li>Premium price tag</li>
                        <li>No expandable SD storage</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="#" class="btn btn-warning btn-lg fw-bold px-4 rounded-pill shadow-sm"><i class="fa-solid fa-cart-shopping me-2"></i>Check Current Price & Offers</a>
        </div>
    </div>
</div>',
            ],
            [
                'id' => 'faq_guide',
                'name' => '❓ FAQ & Help Center Guide',
                'description' => 'Q&A accordion blocks, tip callouts & support contact card',
                'html' => '
<div class="p-4 bg-primary bg-opacity-10 rounded-3 mb-4">
    <h2 class="fw-bold text-primary mb-2"><i class="fa-solid fa-circle-question me-2"></i>Frequently Asked Questions</h2>
    <p class="text-muted mb-0">Find quick answers to common questions about our platform and services.</p>
</div>
<div class="mb-3 p-3 bg-white border rounded-3 shadow-sm">
    <h5 class="fw-bold text-dark"><i class="fa-solid fa-q me-2 text-primary"></i>How do I reset my account password?</h5>
    <p class="text-muted mb-0">Navigate to the login page, click "Forgot Password", and follow the email verification link sent to your inbox.</p>
</div>
<div class="mb-3 p-3 bg-white border rounded-3 shadow-sm">
    <h5 class="fw-bold text-dark"><i class="fa-solid fa-q me-2 text-primary"></i>What payment methods are supported?</h5>
    <p class="text-muted mb-0">We accept major Credit/Debit Cards, PayPal, Apple Pay, Google Pay, and Direct Wire Transfers.</p>
</div>
<div class="p-3 bg-warning bg-opacity-10 border border-warning rounded-3 my-4">
    <h6 class="fw-bold text-dark"><i class="fa-solid fa-headset me-2 text-warning"></i>Still Need Help?</h6>
    <p class="small text-muted mb-0">Our 24/7 technical support team is ready to assist you. Contact us at <a href="mailto:support@example.com">support@example.com</a>.</p>
</div>',
            ],
            [
                'id' => 'tech_doc',
                'name' => '📘 Technical Documentation',
                'description' => 'Code blocks, installation steps list & warning callout box',
                'html' => '
<div class="border-start border-4 border-info ps-3 my-3">
    <h2 class="fw-bold text-dark">Installation & Integration Guide</h2>
    <p class="text-muted">Follow these quick steps to integrate the package into your Laravel application.</p>
</div>
<h4 class="fw-bold mt-4">Step 1: Install Package via Composer</h4>
<div class="p-3 bg-dark text-white rounded-3 font-monospace mb-3">
    <code>composer require vendor/package-name</code>
</div>
<h4 class="fw-bold mt-4">Step 2: Publish Environment Assets</h4>
<div class="p-3 bg-dark text-white rounded-3 font-monospace mb-3">
    <code>php artisan vendor:publish --provider="Vendor\PackageServiceProvider"</code>
</div>
<div class="alert alert-warning border-start border-4 border-warning my-4">
    <strong><i class="fa-solid fa-triangle-exclamation me-1"></i> Warning:</strong> Ensure your PHP version is 8.2 or higher before executing database migrations.
</div>',
            ],
        ];

        $components = [
            [
                'id' => 'hero_card',
                'name' => '⚡ Hero Banner Card',
                'html' => '<div class="p-4 bg-gradient bg-primary text-white rounded-4 shadow-sm my-3"><h2 class="fw-bold">Hero Announcement Banner</h2><p class="lead">Highlight essential announcements with this eye-catching banner card.</p><button class="btn btn-light fw-bold px-4">Learn More</button></div>',
            ],
            [
                'id' => 'alert_box',
                'name' => '📌 Highlights Alert Box',
                'html' => '<div class="alert alert-success border-start border-4 border-success rounded-3 shadow-sm my-3"><strong><i class="fa-solid fa-circle-check me-2"></i> Important Update:</strong> All system services are operating normally with 99.9% uptime.</div>',
            ],
            [
                'id' => 'cta_card',
                'name' => '💡 Call-To-Action Card',
                'html' => '<div class="card bg-light border-start border-4 border-primary shadow-sm p-4 text-center my-3"><h3 class="fw-bold text-dark">Ready to get started?</h3><p class="text-muted">Join thousands of creators building rich articles today.</p><a href="#" class="btn btn-primary btn-lg fw-bold rounded-pill px-4">Get Started Now</a></div>',
            ],
        ];

        return response()->json([
            'templates' => $templates,
            'components' => $components,
        ]);
    }
}
