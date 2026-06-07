<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // withTrashed() includes soft-deleted records so they show in the list
        $posts = Post::withTrashed()->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'body'  => 'required|min:10',
        ], [
            'title.required' => 'The post title is required.',
            'title.min'      => 'Title must be at least 3 characters.',
            'slug.required'=> 'The post slug is required.',
            'slug.min'      => 'Slug must be at least 3 characters.',
            'body.required'  => 'The post body is required.',
            'body.min'       => 'Body must be at least 10 characters.',
        ]);

        Post::create($request->only(['title', 'body', 'slug']));

        return redirect()->route('posts.index')->with('success', 'Post created!');
    }

    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|min:3',
            'slug'  => 'required|min:3',
            'body'  => 'required|min:10',
        ]);

        $post->update($request->only(['title', 'body']));

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