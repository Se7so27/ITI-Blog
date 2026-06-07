<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        Comment::create([
            ...$request->validated(),
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Comment added!');
    }
}
