@extends('layouts.app')

@section('title', $article->title)

@section('content')

<div class="container">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>{{ $article->title }}</h2>

        <div>
            <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning">
                Edit
            </a>

            <a href="{{ route('articles.index') }}" class="btn btn-secondary">
                Back
            </a>
        </div>

    </div>

    {{-- Article Information --}}
    <div class="row mb-4">

        <div class="col-md-3">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <h6>Created</h6>
                    <strong>{{ $article->created_at->format('d M Y') }}</strong>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-success shadow-sm">
                <div class="card-body text-center">
                    <h6>Updated</h6>
                    <strong>{{ $article->updated_at->format('d M Y') }}</strong>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-warning shadow-sm">
                <div class="card-body text-center">
                    <h6>Reading Time</h6>
                    <strong>{{ $readingTime }} Min</strong>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-dark shadow-sm">
                <div class="card-body text-center">
                    <h6>Total Words</h6>
                    <strong>{{ str_word_count(strip_tags($article->content)) }}</strong>
                </div>
            </div>
        </div>

    </div>

    {{-- Article Content --}}
    <div class="card shadow">

        <div class="card-header">
            <h4 class="mb-0">Article Content</h4>
        </div>

        <div class="card-body">

            {!! $article->content !!}

        </div>

    </div>

</div>

@endsection

@push('styles')

<style>

.article-content img{
    max-width:100%;
    height:auto;
}

.card-body img{
    max-width:100%;
    height:auto;
}

.card-body table{
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
}

.card-body table,
.card-body td,
.card-body th{
    border:1px solid #ddd;
    padding:8px;
}

.card{
    border-radius:10px;
}

</style>

@endpush