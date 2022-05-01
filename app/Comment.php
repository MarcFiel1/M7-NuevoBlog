<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=['comment'];
    function user(){
       return $this->belongsTo(User::class);
    }
    function post(){
        return $this->belongsTo(Post::class);
    }
}
