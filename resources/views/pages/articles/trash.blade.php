@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Temporary Deleted Articles</h1>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Article Title</th>
                            <th>Body</th>
                            <th>Created At</th>
                            <th>Last Update</th>
                            <th>Deleted At</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($articles as $article)
                            <tr>
                                <th scope="row">{{ $article->title }}</th>
                                <th>{{ $article->body }}</th>
                                <th>{{ $article->created_at }}</th>
                                <th>{{ $article->updated_at }}</th>
                                <th>{{ $article->deleted_at }}</th>
                                <td>
                                    <a href="{{ route('restore_articles', $article) }}" class="btn btn-success">Restore</a>
                                </td>
                                <td>
                                    <a href="{{ route('permanently_delete_articles', $article) }}" onclick="return confirm('Are you sure to want to delete this record?')" class="btn btn-danger">Permanently Delete Attribute</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row m-auto">
            <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>
@endsection
