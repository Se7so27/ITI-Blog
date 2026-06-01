@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
    <h1 class="mb-4">All Posts</h1>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post['title'] }}</td>
                    <td>{{ $post['description'] }}</td>
                    <td>
                        <a href="{{ route('posts.show', $post['id']) }}" class="btn btn-primary btn-sm">Show</a>
                    </td>
                    <td>
                        <a href="#" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                    <td>
                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection