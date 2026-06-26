<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return redirect()->route('articles.index');
});

Route::resource('articles', ArticleController::class);

// Export Articles to CSV
Route::get('/articles-export', [ArticleController::class, 'export'])
    ->name('articles.export');

// TinyMCE Image Upload
Route::post('/upload-image', function () {

    if (request()->hasFile('file')) {

        $file = request()->file('file');

        $filename = time() . '_' . $file->getClientOriginalName();

        $file->move(public_path('uploads'), $filename);

        return response()->json([
            'location' => asset('uploads/' . $filename)
        ]);
    }

    return response()->json([
        'error' => 'No file uploaded'
    ], 400);

})->name('upload.image');