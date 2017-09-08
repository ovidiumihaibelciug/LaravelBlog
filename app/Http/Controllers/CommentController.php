<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth;
use App\Post;
use App\Comment;

class CommentController extends Controller
{
    //

    public function store(Post $post, Request $request) {

        $this->validate($request, [
            'body' => 'required|min:2'
        ]);

        Comment::create([
            'post_id' => $post->id,
            'user_id' => auth()->user()->id,
            'body' => request('body'),
        ]);

        return back();
    }
}
