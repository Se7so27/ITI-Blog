<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::withTrashed()->latest()->paginate(10);
        return Inertia::render('Posts/Index', [
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        return Inertia::render('Posts/Create');
    }

    public function store(StorePostRequest $request)
    {
        Post::create([
            ...$request->validated(),
            'user_id' => auth()->id()
        ]);
        return redirect()->route('posts.index')->with('success', 'Post created!');
    }

    public function show(Post $post)
    {
        $post->load(['comments.user', 'user']);
        return Inertia::render('Posts/Show', [
            'post' => $post,
        ]);
    }

    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        return Inertia::render('Posts/Edit', [
            'post' => $post,
        ]);
    }

    public function update(UpdatePostRequest $request, string $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->validated());
        return redirect()->route('posts.index')->with('success', 'Post updated!');
    }

    public function destroy(string $id)
    {
        Post::findOrFail($id)->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted!');
    }

    public function restore(string $id)
    {
        Post::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('posts.index')->with('success', 'Post restored!');
    }
}
