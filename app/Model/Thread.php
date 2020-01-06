<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
     public $table = 'threads';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function forum()
    {
        return $this->belongsTo(Forum::class, 'forum_id');
    }

    public function posts()
    {
        return $this->belongsTo(Post::class, 'thread_id', 'id');
    }
}
