<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentLike;
use App\Mail\CommentWasLikedMail;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post, Comment $comment)
    {
        return view('comments.create', compact('post','comment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'post_id'=>'nullable|integer',
            'comment_id'=>'nullable|integer',
            'comment'=>'required|string'
        ]);

        $comment = Comment::create([
            'post_id'=>$post->id,
            'user_id'=>auth()->user()->id,
            'text'=>$request->comment,
            'parent'=>$request->comment_id ? $request->comment_id : 0,
            'published'=>'1'
        ]);

        if($comment){
            Session::flash('success',__('Comment saved'));
        }else{
            Session::flash('danger',__('Oooops....Comment was not saved.'));
        }
        if($request->comment_id){
            return redirect('/posts/' . $post->id);
        }
        return redirect()->back();
    }

    public function like(Comment $comment){
        $like = CommentLike::firstOrCreate([
            'comment_id'=>$comment->id,
            'user_id'=>auth()->user()->id
        ]);

        if($like){
            $this->notify_post_owner($comment);

            return redirect()->back();
        }
    }

    private function notify_post_owner(Comment $comment){
        $post_name = $comment->post->title;
        $post_owner = $comment->post->author->name;
        $post_liker = auth()->user()->name;

        Mail::to($comment->post->author->email)->send(new CommentWasLikedMail($post_name, $post_owner, $post_liker));
    }

    public function unlike(Comment $comment){
        $like = $comment->likes()->where('user_id', auth()->user()->id)->first();
        $like->delete();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
