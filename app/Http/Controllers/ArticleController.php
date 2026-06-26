<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

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
        ]);

        Article::create($request->all());

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
        ]);

        $article->update($request->all());

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
}