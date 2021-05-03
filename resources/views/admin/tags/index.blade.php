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
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($tags as $tag)
                                <tr>
                                    <td>{{ $tag->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.tags.edit', $tag) }}"><i class="fas fa-edit"></i></a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.tags.destroy', $tag) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="fas fa-trash-alt" onclick="return confirm('Are you sure to want to delete this record?')"></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a class="btn btn-primary btn-block mb-3" href="{{ route('admin.tags.create') }}">Add New Tag</a>
                    <a class="btn btn-secondary btn-block" href="{{ route('admin.dashboard') }}">Dashboard</a>
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
