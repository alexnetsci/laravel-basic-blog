@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <h1 class="display-4">{{ $article->title }}</h1>
                <p>{{ $article->body }}</p>
                @if ($article->article_img)
                    <picture>
                        <img src="{{ asset($article->article_img) }}" class="img-fluid rounded mb-3">
                    </picture>
                @endif
                <p>
                    @foreach ($article->tags as $tag)
                        <a class="p-2 custom-link-border showCat" href="{{ route('articles.index', ['tag' => $tag->name]) }}">{{ $tag->name }}</a>
                    @endforeach
                </p>
            </div>
            <div class="col-lg-3">
                <div class="card p-1">
                    <p class="custom-link-border px-3">updated {{ $article->updated_at->diffForHumans() }}...</p>
                    <p class="custom-link-border px-3">created {{ $article->created_at->diffForHumans() }}...</p>
                    <p class="custom-link-border px-3">
                        Category: <a class="showCat" href="{{ route('articles.index', ['category' => $article->category->name]) }}">{{ $article->category->name }}</a>
                    </p>
                    <div class="card-footer">
                        @auth
                            @if (Auth::user()->id === $article->user_id)
                                <a href="{{ route('articles.edit', $article) }}" class="btn btn-secondary btn-block mb-1">Edit</a>
                                <button type="button" class="btn btn-danger btn-block mb-1" data-toggle="modal" data-target="#exampleModal">Delete</button>
                                <a href="{{ route('articles.index') }}" class="btn btn-primary btn-block">Return to Articles</a>
                            @else
                                <a href="{{ route('articles.index') }}" class="btn btn-primary btn-block">Return to Articles</a>
                            @endif
                            @if (Auth::user()->hasRole('admin'))
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-warning btn-block">Dashboard</a>
                            @endif
                        @endauth
                        @guest
                            <a href="{{ route('articles.index') }}" class="btn btn-primary btn-block">Return to Articles</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="exampleModalLabel">You are about to delete the <mark class="rounded bg-danger border border-light text-light">{{ $article->title }}</mark> article!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <h5 class="text-danger">Please confirm deletion by pressing</h5>
                        <form action="{{ route('articles.destroy', $article) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Confirm, Delete!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
