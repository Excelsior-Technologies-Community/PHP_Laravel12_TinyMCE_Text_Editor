<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return redirect()->route('articles.index');
});

Route::resource('articles', ArticleController::class);

// Optional: Image upload route for TinyMCE
Route::post('/upload-image', function() {
    // Simple image upload handler
    if (request()->hasFile('file')) {
        $file = request()->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);
        
        return response()->json([
            'location' => url('uploads/' . $filename)
        ]);
    }
    
    return response()->json(['error' => 'No file uploaded'], 400);
})->name('upload.image');