<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function posts(){
      //MODEL::where()->orderBy()->limit()->paginate(20);
      $posts = Post::where('author_id', auth()->user()->id)->paginate(env('PER_PAGE'));
      return view('users.posts', compact('posts'));
  }
    public function favorites(){
        $posts = Post::whereHas('comments', function($q){
            $q->whereHas('likes', function($l){
                $l->where('user_id', auth()->user()->id);
            });
        })->paginate(env('PER_PAGE'));

        return view('users.favorites', compact('posts'));
    }

}
