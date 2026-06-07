@extends('layouts.app')
@section('title', '$post->title')
@section('content')
    <h1>Edit Post</h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title"
                   class="form-control @error('title') is-invalid @enderror"
                   value="{{ old('title', $post->title) }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Slug</label>
            <input type="text" name="slug"
                   class="form-control @error('slug') is-invalid @enderror"
                   value="{{ old('slug', $post->slug) }}">
            @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Body</label>
            <textarea name="body" rows="5"
                      class="form-control @error('body') is-invalid @enderror">{{ old('body', $post->body) }}</textarea>
            @error('body')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection