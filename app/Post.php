<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Post extends Model
{
    protected $fillable = ['title', 'content', 'author_id'];

    public function author(){
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function parent_comments(){
        return $this->hasMany(Comment::class)->where('parent', 0);
    }

    public function getPreviewAttribute(){
        return Str::limit($this->content, 150);
    }
}

