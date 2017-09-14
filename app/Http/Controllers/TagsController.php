<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Config;

class TagsController extends Controller
{
    //
    public function index(Tag $tag) {
        $posts = $tag->posts;

        $links = 0;
        return view('posts.index')->with([
            'posts' => $posts,
            'links' => $links,
        ]);
    }
}

