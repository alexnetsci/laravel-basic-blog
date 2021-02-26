@extends('admin/layouts.admin')

@section('content')
    <div class="container">
        <h1>Settings</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('admin.settings.update') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for='articles_title'>Articles Title</label>
                        <input id="articles_title" type="text" name="articles_title" class="form-control @error('articles_title') is-invalid @enderror"
                            @foreach ($settings as $set)
                                value="{{ $set->articles_title }}"
                            @endforeach
                        autocomplete="new-articles_title" autofocus>
                        @error('articles_title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success btn-block mb-3">Submit</button>
                    <a class="btn btn-secondary btn-block" href="{{ route('admin.dashboard') }}">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
