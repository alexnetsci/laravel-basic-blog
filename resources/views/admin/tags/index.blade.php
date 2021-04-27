@extends('admin/layouts.admin')

@section('content')
    <div class="container">
        @if (count($tags) > 0)
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Name</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($tags as $tag)
                                <tr>
                                    <td>{{ $tag->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.tags.edit', $tag) }}"><i class="fas fa-edit"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a class="btn btn-primary btn-block mb-3" href="{{ route('admin.tags.create') }}">Add New Tag</a>
                    <a class="btn btn-secondary btn-block" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger" id="exampleModalLabel">You are about to delete the <mark class="rounded bg-danger border border-light text-light">{{ $tag->name }}</mark> tag!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <h5 class="text-danger">Please confirm deletion by pressing</h5>
                            <form action="{{ route('admin.tags.destroy', $tag) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Confirm, Delete!</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <p>No tags yet!</p>
                    <a class="btn btn-primary btn-block" href="{{ route('admin.tags.create') }}">Create One!</a>
                    <a class="btn btn-primary btn-block" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
            </div>
        @endif
    </div>
@endsection