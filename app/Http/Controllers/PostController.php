<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = [
            ['id' => 1, 'title' => 'Post One',   'description' => 'Description one'],
            ['id' => 2, 'title' => 'Post Two',   'description' => 'Description two'],
            ['id' => 3, 'title' => 'Post Three', 'description' => 'Description three'],
            ['id' => 4, 'title' => 'Post Four',  'description' => 'Description four'],
        ];

        return view('posts.index', compact('posts'));
    }
        public function show($id)
    {
        $posts = [
            ['id' => 1, 'title' => 'Post One',   'description' => 'Full content of post one'],
            ['id' => 2, 'title' => 'Post Two',   'description' => 'Full content of post two'],
            ['id' => 3, 'title' => 'Post Three', 'description' => 'Full content of post three'],
            ['id' => 4, 'title' => 'Post Four',  'description' => 'Full content of post four'],
        ];

        $post = collect($posts)->firstWhere('id', (int)$id);

        if (!$post) abort(404);

        return view('posts.show', compact('post'));
    }
}
