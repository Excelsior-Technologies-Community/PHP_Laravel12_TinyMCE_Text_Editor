<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MediaGalleryController;
use App\Http\Controllers\TemplateStudioController;

Route::get('/', function () {
    return redirect()->route('articles.index');
});

Route::resource('articles', ArticleController::class);

// Export Articles to CSV
Route::get('/articles-export', [ArticleController::class, 'export'])
    ->name('articles.export');

// Template Studio Presets
Route::get('/templates/get', [TemplateStudioController::class, 'getTemplates'])->name('templates.get');

// Advanced Media Gallery & Storage Cleanup Routes
Route::get('/media', [MediaGalleryController::class, 'index'])->name('media.index');
Route::get('/media/list', [MediaGalleryController::class, 'getMediaList'])->name('media.list');
Route::post('/upload-image', [MediaGalleryController::class, 'upload'])->name('upload.image');
Route::post('/media/delete', [MediaGalleryController::class, 'destroyFile'])->name('media.delete');
Route::post('/media/cleanup', [MediaGalleryController::class, 'cleanupUnused'])->name('media.cleanup');