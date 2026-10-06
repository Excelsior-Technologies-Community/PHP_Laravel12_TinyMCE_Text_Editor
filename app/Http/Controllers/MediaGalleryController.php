<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MediaGalleryController extends Controller
{
    /**
     * Display Media Gallery & Storage Cleanup Studio
     */
    public function index()
    {
        $uploadPath = public_path('uploads');
        
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        $files = File::files($uploadPath);
        $articlesContent = Article::pluck('content')->implode(' ');

        $mediaList = [];
        $totalBytes = 0;
        $usedCount = 0;
        $unusedCount = 0;
        $unusedBytes = 0;

        foreach ($files as $file) {
            $filename = $file->getFilename();
            $size = $file->getSize();
            $url = asset('uploads/' . $filename);
            
            // Check if file URL or filename is referenced in any article HTML content
            $isUsed = str_contains($articlesContent, $filename) || str_contains($articlesContent, $url);
            
            if ($isUsed) {
                $usedCount++;
            } else {
                $unusedCount++;
                $unusedBytes += $size;
            }

            $totalBytes += $size;

            $mediaList[] = [
                'filename' => $filename,
                'url' => $url,
                'size_formatted' => $this->formatBytes($size),
                'size_bytes' => $size,
                'updated_at' => date('Y-m-d H:i', $file->getMTime()),
                'is_used' => $isUsed,
            ];
        }

        $stats = [
            'total_files' => count($mediaList),
            'total_size' => $this->formatBytes($totalBytes),
            'used_files' => $usedCount,
            'unused_files' => $unusedCount,
            'unused_size' => $this->formatBytes($unusedBytes),
        ];

        return view('media.index', compact('mediaList', 'stats'));
    }

    /**
     * Ajax API Endpoint for Media Library Modal inside TinyMCE
     */
    public function getMediaList()
    {
        $uploadPath = public_path('uploads');
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        $files = File::files($uploadPath);
        $articlesContent = Article::pluck('content')->implode(' ');

        $media = [];
        foreach ($files as $file) {
            $filename = $file->getFilename();
            $url = asset('uploads/' . $filename);
            $isUsed = str_contains($articlesContent, $filename);

            $media[] = [
                'filename' => $filename,
                'url' => $url,
                'size' => $this->formatBytes($file->getSize()),
                'is_used' => $isUsed,
            ];
        }

        return response()->json(['media' => $media]);
    }

    /**
     * Upload Image with Alt Text & Custom Responsive HTML Tag
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:10240',
            'alt_text' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $altText = $request->input('alt_text', 'Uploaded Image');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9_.-]/', '_', $file->getClientOriginalName());

            $uploadPath = public_path('uploads');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $filename);
            $url = asset('uploads/' . $filename);

            // Responsive Image Tag HTML Wrapper
            $htmlWrapper = '<img src="' . $url . '" alt="' . e($altText) . '" class="img-fluid rounded shadow my-3 d-block mx-auto" />';

            return response()->json([
                'location' => $url,
                'html' => $htmlWrapper,
                'alt' => $altText,
                'filename' => $filename,
            ]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

    /**
     * Delete Single Media File
     */
    public function destroyFile(Request $request)
    {
        $filename = basename($request->input('filename'));
        $filePath = public_path('uploads/' . $filename);

        if (File::exists($filePath)) {
            File::delete($filePath);
            return response()->json(['success' => true, 'message' => "File {$filename} deleted successfully."]);
        }

        return response()->json(['error' => 'File not found.'], 404);
    }

    /**
     * 1-Click Unused Storage Cleanup Studio
     */
    public function cleanupUnused(Request $request)
    {
        $uploadPath = public_path('uploads');
        if (!File::exists($uploadPath)) {
            return redirect()->back()->with('success', 'Upload directory is empty.');
        }

        $files = File::files($uploadPath);
        $articlesContent = Article::pluck('content')->implode(' ');

        $deletedCount = 0;
        $freedBytes = 0;

        foreach ($files as $file) {
            $filename = $file->getFilename();
            $url = asset('uploads/' . $filename);

            $isUsed = str_contains($articlesContent, $filename) || str_contains($articlesContent, $url);

            if (!$isUsed) {
                $freedBytes += $file->getSize();
                File::delete($file->getPathname());
                $deletedCount++;
            }
        }

        $freedFormatted = $this->formatBytes($freedBytes);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'deleted_count' => $deletedCount,
                'freed_space' => $freedFormatted,
                'message' => "Cleaned up {$deletedCount} unused images ({$freedFormatted} freed).",
            ]);
        }

        return redirect()->back()->with('success', "Storage Cleanup Complete! Deleted {$deletedCount} orphaned images and freed {$freedFormatted} of storage.");
    }

    /**
     * Format Bytes to Human Readable (KB, MB, GB)
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
