@extends('layouts.app')

@section('title', 'Articles List')

@section('content')

    <div class="container">

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Articles Management</h2>

            <a href="{{ route('articles.create') }}" class="btn btn-primary">
                + Create New Article
            </a>
        </div>

        {{-- Dashboard Statistics --}}
        <div class="row mb-4">

            <div class="col-md-4">
                <div class="card bg-primary text-white shadow">
                    <div class="card-body">
                        <h3>{{ $totalArticles }}</h3>
                        <p class="mb-0">Total Articles</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                        <h3>{{ $todayArticles }}</h3>
                        <p class="mb-0">Today's Articles</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-dark text-white shadow">
                    <div class="card-body">
                        <h6>Latest Article</h6>

                        @if($latestArticle)
                            <strong>{{ $latestArticle->title }}</strong>
                        @else
                            <span>No Article Found</span>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        {{-- Search --}}
        <form method="GET" action="{{ route('articles.index') }}" class="mb-4">

            <div class="row">

                <div class="col-md-8">

                    <input type="text" name="search" class="form-control" placeholder="Search by article title..."
                        value="{{ request('search') }}">

                </div>

                <div class="col-md-4">

                    <button class="btn btn-primary">
                        Search
                    </button>

                    <a href="{{ route('articles.index') }}" class="btn btn-secondary">
                        Reset
                    </a>

                </div>

            </div>

        </form>

        {{-- Articles Table --}}
        @if($articles->count())

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th width="70">ID</th>

                            <th>Title</th>

                            <th width="180">Created At</th>

                            <th width="220">Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($articles as $article)

                            <tr>

                                <td>{{ $article->id }}</td>

                                <td>{{ $article->title }}</td>

                                <td>{{ $article->created_at->format('d M Y H:i') }}</td>

                                <td>

                                    <a href="{{ route('articles.show', $article) }}" class="btn btn-info btn-sm">
                                        View
                                    </a>

                                    <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this article?')">

                                            Delete

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            @if ($articles->hasPages())
                <div class="d-flex justify-content-center mt-4">

                    <nav>

                        <ul class="pagination">

                            @foreach ($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)

                                <li class="page-item {{ $page == $articles->currentPage() ? 'active' : '' }}">

                                    <a class="page-link" href="{{ $url }}">
                                        {{ $page }}
                                    </a>

                                </li>

                            @endforeach

                        </ul>

                    </nav>

                </div>
            @endif

        @else

            <div class="alert alert-warning">

                No articles found.

            </div>

        @endif

    </div>

@endsection