@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h2>{{ $article->title }}</h2>
            <div>
                <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('articles.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <small class="text-muted">Created: {{ $article->created_at->format('Y-m-d H:i') }}</small>
            <small class="text-muted ms-3">Updated: {{ $article->updated_at->format('Y-m-d H:i') }}</small>
        </div>
        <hr>
        <div class="article-content">
            {!! $article->content !!}
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .article-content img {
        max-width: 100%;
        height: auto;
    }
    
    .article-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 1rem 0;
    }
    
    .article-content table, 
    .article-content th, 
    .article-content td {
        border: 1px solid #dee2e6;
        padding: 0.5rem;
    }
</style>
@endpush