@extends('admin/layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-group">
                                <li class="list-group-item"><a class="text-info shadow-sm font-weight-bold" href="{{ route('admin.manage_users') }}">Manage Users</a></li>
                                <li class="list-group-item"><a class="text-info shadow-sm font-weight-bold" href="{{ route('admin.categories.index') }}">Manage Categories</a></li>
                                <li class="list-group-item"><a class="text-info shadow-sm font-weight-bold" href="{{ route('admin.tags.index') }}">Manage Tags</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-group">
                                <li class="list-group-item">Users: <small id="get_users"></small></li>
                                <li class="list-group-item">Categories: <small id="get_categories"></small></li>
                                <li class="list-group-item">Tags: <small id="get_tags"></small></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between ml-auto mr-auto">
                        <div class="col-">
                            <a class="btn btn-primary" href="{{ route('admin.dashboard') }}">All Articles</a>
                        </div>
                        @if (count($categories) > 0)
                            <div class="col-">
                                <div class="dropdown mr-1">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,20">
                                        Search by categories:
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                                        @foreach ($categories as $category)
                                            <a class="dropdown-item" href="{{ route('admin.dashboard', ['category' => $category->name]) }}">{{ $category->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (count($tags) > 0)
                            <div class="col-">
                                <div class="dropdown mr-1">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,20">
                                        Search by tags:
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                                        @foreach ($tags as $tag)
                                        <a class="dropdown-item" href="{{ route('admin.dashboard', ['tag' => $tag->name]) }}">{{ $tag->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-">
                            <a class="btn btn-primary" href="{{ route('articles.create') }}">Create Article</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (count($articles) > 0)
                        <table class="table">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">By</th>
                                <th scope="col">Title</th>
                                <th scope="col">Body</th>
                                <th scope="col">Date</th>
                                <th scope="col">Category</th>
                                <th scope="col">Tag</th>
                                <th scope="col">Image</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($articles as $article)
                                <tr>
                                    <td scope="row">
                                        @if (Auth::user()->id === $article->user_id)
                                            By You
                                        @else
                                            {{ $article->user->username }}
                                        @endif
                                    </td>
                                    <th>{{ $article->title }}</th>
                                    <td>{{ substr($article->body, 0, 10) }} {{ strlen($article->body) > 50 ? "..." : "" }}</td>
                                    <td>
                                        @if ($article->updated_at > $article->created_at)
                                            <small class="text-muted">updated {{ $article->updated_at->diffForHumans() }}</small>
                                        @else
                                            <small class="text-muted">created {{ $article->created_at->diffForHumans() }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $article->category->name }}</td>
                                    <td>
                                        @foreach ($article->tags as $tag)
                                            {{ $tag->name }}
                                        @endforeach
                                    </td>
                                    <td style="width: 150px">
                                        @if ($article->article_img)
                                            <img src="{{ $article->article_img }}" class="img-fluid">
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('articles.edit', $article) }}"><i class="fas fa-edit"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash-alt"></i></a>
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
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="row justify-content-center">
                            {{ $articles->links() }}
                        </div>
                    @else
                        <div class="row justify-content-center">
                            <div class="col-lg-6 text-center">
                                <p>No articles yet!</p>
                                <a class="btn btn-primary btn-block" href="{{ route('articles.create') }}">Create One!</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
