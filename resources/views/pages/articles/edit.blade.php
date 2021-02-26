@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-2">
                <h3 class="text-center">Edit Article</h3>
                <h1 class="text-center">{{ $article->title }}</h1>
            </div>
            <div class="col-lg-6">
                <div class="card mb-3 p-3">
                    <form action="{{ route('articles.update', $article) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for='title'>Title</label>
                            <input id="title" type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $article->title }}" autocomplete="title" autofocus>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for='body'>Body</label>
                            <textarea id="body" name="body" rows="3" class="form-control @error('body') is-invalid @enderror" autocomplete="body" autofocus>{{ $article->body }}</textarea>
                            @error('body')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for='category_id'>Category</label>
                            <select id="category" class="custom-select showCat @error('category') is-invalid @enderror" autocomplete="category" autofocus name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id?'selected':''}}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for='tags'>Tags</label>
                            <select id="tags" class="custom-select select2-multi @error('tags') is-invalid @enderror" autocomplete="tags" autofocus name="tags[]" multiple>
                                @foreach ($tags as $tag)
                                    <option value="{{$tag->id}}" {{ in_array($tag->id,$selected_tags)?'selected':''}}> {{$tag->name}}</option>
                                @endforeach
                            </select>
                            @error('tags')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="custom-file mb-5" style="width: auto; height: auto">
                            <input type="file" name="article_img" class="custom-file-input @error('article_img') is-invalid @enderror" id="validatedCustomFile">
                            <label class="custom-file-label" for="validatedCustomFile">Change file{{ $article->article_img }}</label>
                            <img id="hide_article_img" src="{{ $article->article_img }}" class="img-fluid img-thumbnail">
                            <img id="show_article_img" class="img-fluid img-thumbnail">
                            <div class="invalid-feedback"><strong>{{ $errors->first('article_img') }}</strong></div>
                        </div>
                        <button type="submit" class="btn btn-success btn-block mb-3">Submit</button>
                    </form>
                </div>
                <a href="{{ $article->path() }}" class="btn btn-outline-primary btn-block">Return</a>
                @if (Auth::user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-warning btn-block">Dashboard</a>
                @endif
            </div>
        </div>
    </div>
@endsection
