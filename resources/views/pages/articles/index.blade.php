@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div  class="col-lg-3">
                @foreach ($settings as $set)
                    <h1 class="text-center">{{ $set->articles_title }}</h1>
                @endforeach
            </div>
            <div class="col-lg-9">
                @forelse ($articles as $article)
                    <div class="row row-cols-1 row-cols-md-2">
                        <div class="col mb-4">
                            <a href="{{ $article->path() }}">
                                <div class="card custom-link-border h-100 mb-3" style="width: 50em">
                                    @if ($article->article_img)
                                        <picture>
                                            <img src="{{ asset($article->article_img) }}" class="img-fluid rounded mb-3">
                                        </picture>
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $article->title }}</h5>
                                        <p class="card-text">{{ substr($article->body, 0, 212) }} {{ strlen($article->body) > 50 ? "..." : "" }}</p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row justify-content-lg-between ml-auto mr-auto">
                                            @auth
                                                @if (Auth::user()->id === $article->user_id)
                                                    <small class="text-muted">By You</small>
                                                @else
                                                    <small class="text-muted">{{ $article->user->username }}</small>
                                                @endif
                                            @endauth

                                            @guest
                                                <small class="text-muted">{{ $article->user->username }}</small>
                                            @endguest
                                            @if ($article->updated_at > $article->created_at)
                                                <small class="text-muted">updated {{ $article->updated_at->diffForHumans() }}</small>
                                            @else
                                                <small class="text-muted">created {{ $article->created_at->diffForHumans() }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="row">
                        <div class="col-lg-8 col-offset-lg-4 text-center">
                            <p>No relevant articles yet.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
