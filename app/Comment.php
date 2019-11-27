<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $with = ['children','likes'];

    protected $fillable = ['post_id','user_id','text','parent','published'];

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function author(){
        return $this->belongsTo(User::class);
    }

    public function children(){
        return $this->hasMany(Comment::class, 'parent','id');
    }

    public function likes(){
        return $this->hasMany(CommentLike::class);
    }

    public function getCommentWasLikedAttribute(){
        if(auth()->check()){
            return $this->likes->where('user_id',auth()->user()->id)->count();
        }

        return false;
    }
}
