<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Nullable;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('author')->orderBy('id', 'DESC')->paginate(env('PER_PAGE'));

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $request->validate([
            'title'=>'required|string',
            'content'=>'nullable|string'
        ]);
        $post = Post::create([
            'title'=>$request->title,
            'content'=>$request->textcontent,
            'author_id'=>auth()->user()->id
        ]);
        if ($post){
            return redirect('/posts');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('edit',$post);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('edit',$post);
        $request->validate([
            'title'=>'required|string',
            'textcontent'=>'nullable|string',
        ]);

        $post->title = $request->title;
        $post->content = $request->textcontent;

        if ($post->save()){
            return redirect('users/posts');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('edit',$post);
        $post->delete();

        return redirect()->back();
    }
}
