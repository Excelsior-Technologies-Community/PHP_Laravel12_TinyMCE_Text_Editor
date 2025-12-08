@extends('layouts.app')

@section('title', 'Articles List')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Articles</h1>
    <a href="{{ route('articles.create') }}" class="btn btn-primary">Create New Article</a>
</div>

@if($articles->isEmpty())
    <div class="alert alert-info">No articles found. Create your first article!</div>
@else
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('articles.show', $article) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('articles.edit', $article) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection