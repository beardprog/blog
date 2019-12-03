<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable =['name'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}