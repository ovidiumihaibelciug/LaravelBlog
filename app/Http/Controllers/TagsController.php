<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Config;

class TagsController extends Controller
{
    public function index(Tag $tag) {

        return view('posts.index')->with([
            'posts' => $tag->posts,
            'links' => 0,
        ]);
    }
}

