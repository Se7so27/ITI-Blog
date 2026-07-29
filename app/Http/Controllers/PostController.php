<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
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
        $data = $request->safe()->except('tags', 'image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $data['user_id'] = auth()->id();

        $post = Post::create($data);

        if ($request->filled('tags')) {
            $post->attachTags(array_map('trim', explode(',', $request->input('tags'))));
        }

        return redirect()->route('posts.index')->with('success', 'Post created!');
    }

    public function show(Post $post)
    {
        $post->load(['comments.user', 'user', 'tags']);
        $post->tags->transform(fn ($tag) => ['id' => $tag->id, 'name' => $tag->name]);
        return Inertia::render('Posts/Show', [
            'post' => $post,
        ]);
    }

    public function edit(string $id)
    {
        $post = Post::with('tags')->findOrFail($id);
        $post->tags->transform(fn ($tag) => ['id' => $tag->id, 'name' => $tag->name]);
        return Inertia::render('Posts/Edit', [
            'post' => $post,
        ]);
    }

    public function update(UpdatePostRequest $request, string $id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('update', $post);

        $data = $request->safe()->except('tags', 'image');

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $post->update($data);

        if ($request->filled('tags')) {
            $post->syncTags(array_map('trim', explode(',', $request->input('tags'))));
        } else {
            $post->detachTags($post->tags);
        }

        return redirect()->route('posts.index')->with('success', 'Post updated!');
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('delete', $post);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted!');
    }

    public function restore(string $id)
    {
        Post::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('posts.index')->with('success', 'Post restored!');
    }
}
