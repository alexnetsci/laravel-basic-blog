@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron custom-jumbo"></div>
        @if (count($categories) > 0 || count($tags) > 0)
            <div id="flip" class="border rounded btn btn-block">Get articles by categories or tags!</div>
            <div id="panel" class="border rounded">
            <div class="row row-cols-1 row-cols-md-2">
                @if (count($categories) > 0)
                    <div class="col-lg-6 text-center mb-5">
                        <p class="lead">Get all articles based on categories:</p>
                        <div class="row">
                            @foreach ($categories as $category)
                                <div class="col-lg-5 mb-4">
                                    <a class="p-2 custom-link-border showCat" href="{{ route('articles.index', ['category' => $category->name]) }}">{{ $category->name }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if (count($tags) > 0)
                    <div class="col-lg-6 text-center">
                        <p class="lead">Get all articles based on tags:</p>
                        <div class="row">
                            @foreach ($tags as $tag)
                                <div class="col-lg-3 mb-4">
                                    <a class="p-2 custom-link-border showCat" href="{{ route('articles.index', ['tag' => $tag->name]) }}">{{ $tag->name }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>
@endsection
