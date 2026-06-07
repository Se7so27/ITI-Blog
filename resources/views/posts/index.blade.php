@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h1>All Posts</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-success">+ New Post</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Title</th>
                <th>Slug</th>
                <th>Body</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr class="{{ $post->trashed() ? 'table-danger' : '' }}">
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->slug }}</td>

                    <td>{{ $post->created_at->format('d M Y') }}</td>
                    <td>
                        @if(!$post->trashed())
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-sm">Show</a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this post?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @else
                            <form action="{{ route('posts.restore', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-success btn-sm">Restore</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">No posts found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination links --}}
    {{ $posts->links() }}
@endsection