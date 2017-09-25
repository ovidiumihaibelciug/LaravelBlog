<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Auth;
use App\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Mews\Purifier\Facades\Purifier;

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
        $posts = Post::latest()->filter(request(['month', 'year']))->paginate(10);
        return view('posts.index')->with(['posts' => $posts]);
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
            'slug' => 'required|unique:posts'
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
        $post->content = Purifier::clean($request->input('content'));
        $post->slug = $post->readySlug($request->input('slug'));
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();
        session()->flash('message', 'Post created!');
        return redirect('/posts');
    }
    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
//    public function show(Post $post)
//    {
//        //
//        //$post = Post::find($id);
//        return view('posts.show')->with('post',$post);
//    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        //$post = Post::find($id);
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
            'tags' => 'max:1999',
            'slug' => 'required|unique:posts'
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
        $post->slug = $post->readySlug($request->input('title'));
        $post->content = Purifier::clean($request->input('content'));
        if ($request->hasFile('cover_image')) {
            $post->cover_image = $fileNameToStore;
        }
        $post->save();
        session()->flash('message', 'Post Updated!');
        return redirect('/posts');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        // $post = Post::findOrFail($id);
        if (auth()->user()->id != $post->user_id) {
            return redirect('/posts')->with('error','Unauthorized page');
        }
        if ($post->cover_image != 'noimage.png') {
            Storage::delete('public/cover_images/' . $post->cover_image);
        }
        $post->delete();
        session()->flash('message', 'Post Deleted!');
        return redirect('/posts');
    }

    public function blogShow($slug) {
        $post = Post::where('slug',$slug)->first();

        return view('posts.show')->with('post', $post);
    }
}