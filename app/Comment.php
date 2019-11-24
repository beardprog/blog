<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $with = ['children'];
    protected $fillable = ['post_id', 'user_id', 'text', 'parent', 'published'];
    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function author(){
        return $this->belongsTo(User::class);
    }

    public function children(){
        return $this->hasMany(Comment::class, 'parent', 'id');
    }
}
