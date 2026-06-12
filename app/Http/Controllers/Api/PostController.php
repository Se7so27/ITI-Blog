<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return PostResource::collection($posts);
    }

    public function show(string $id)
    {
        $post = Post::with('user')->findOrFail($id);
        return new PostResource($post);
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->safe()->except('tags', 'image');
        $data['user_id'] = auth()->id();

        $post = Post::create($data);

        if ($request->filled('tags')) {
            $post->attachTags(array_map('trim', explode(',', $request->input('tags'))));
        }

        return new PostResource($post->load('user'));
    }
}
