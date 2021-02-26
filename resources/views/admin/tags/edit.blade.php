@extends('admin/layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('admin.tags.update', $tag) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for='name'>Name</label>
                        <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $tag->name }}" autocomplete="new-name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success btn-block mb-3">Submit</button>
                    <a class="btn btn-secondary btn-block" href="{{ route('admin.tags.index') }}">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
