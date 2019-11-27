<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use App\Mail\CommentWasLikedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class LikeController extends Controller
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
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function like(Comment $comment)
    {


        $like = Like::firstOrCreate([
            'comment_id'=>$comment->id,
            'user_id'=>auth()->user()->id,

        ]);

if ($like){
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

    public function unlike(Comment $comment)
    {


        $request->validate([
            'user_id'=> 'nullable|integer',
            'comment_id'=> 'nullable|integer'
        ]);

        $like = Like::create([
            'comment_id'=>$comment->id,
            'user_id'=>auth()->user()->id,

        ]);


        return redirect()->back();
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
    }
}
