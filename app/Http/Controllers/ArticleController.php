<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ArticleController extends Controller
{
    /**
     * Display a listing of the articles.
     */
    public function index(Request $request)
    {
        $query = Article::query();

        // Search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Statistics
        $totalArticles = Article::count();
        $todayArticles = Article::whereDate('created_at', today())->count();
        $latestArticle = Article::latest()->first();

        // Pagination
        $articles = $query->oldest()->paginate(5);

        return view('articles.index', compact(
            'articles',
            'totalArticles',
            'todayArticles',
            'latestArticle'
        ));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created article in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
        ]);


        return redirect()->route('articles.index')
            ->with('success', 'Article created successfully.');
    }

    /**
     * Display the specified article.
     */
    public function show(Article $article)
    {
        // Reading Time
        $readingTime = max(1, ceil(str_word_count(strip_tags($article->content)) / 200));

        return view('articles.show', compact('article', 'readingTime'));
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified article.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        $article->update([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
        ]);


        return redirect()->route('articles.index')
            ->with('success', 'Article updated successfully.');
    }

    /**
     * Remove the specified article.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Article deleted successfully.');
    }

    /**
     * Export Articles CSV
     */
    public function export()
    {
        $articles = Article::all();

        $fileName = 'articles_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Cache-Control" => "no-cache, no-store, must-revalidate",
            "Pragma" => "no-cache",
            "Expires" => "0"
        ];

        $callback = function () use ($articles) {

            $file = fopen('php://output', 'w');

            // CSV Header
            fputcsv($file, [
                'ID',
                'Title',
                'Status',
                'Created At'
            ]);

            foreach ($articles as $article) {

                fputcsv($file, [
                    $article->id,
                    $article->title,
                    $article->status,
                    $article->created_at->format('d M Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
