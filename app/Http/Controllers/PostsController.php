<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth;
use App\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $posts = Post::orderBy('created_at','DESC')->paginate(10);

        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'cover_image' => 'nullable|image|max:1999',
        ]);

        if($request->hasFile('cover_image')) {

            $filenameWithExtension = $request->file('cover_image')->getClientOriginalName();

            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            $fileNameToStore = $filename . time() . '.' . $extension;
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.png';
        }

        $post = new Post;

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;

        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::find($id);

        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::find($id);

        if (auth()->user()->id != $post->user_id) {
            return redirect('/posts')->with('error','Unauthorized page');
        }

        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
           'title' => 'required',
            'content' => 'required',
            'cover_image' => 'nullable|image|max:1999',
        ]);

        if($request->hasFile('cover_image')) {

            $filenameWithExtension = $request->file('cover_image')->getClientOriginalName();

            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            $fileNameToStore = $filename . time() . '.' . $extension;
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }

        $post = Post::findOrFail($id);

        if (auth()->user()->id != $post->user_id) {
            return redirect('/posts')->with('error','Unauthorized page');
        }

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        if ($request->hasFile('cover_image')) {
            $post->cover_image = $fileNameToStore;
        }

        $post->save();

        return redirect('/posts')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);

        if (auth()->user()->id != $post->user_id) {
            return redirect('/posts')->with('error','Unauthorized page');
        }

        if ($post->cover_image != 'noimage.png') {
            Storage::delete('public/cover/' . $post->cover_image);
        }

        $post->delete();

        return redirect('/posts')->with('success','Post Deleted');

    }
}
